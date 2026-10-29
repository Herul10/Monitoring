<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\AktivitasSistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    public function siswa()
    {
        $user = Auth::user();

        if (!$user->siswa) {
            return back()->withErrors([
                'absensi' => 'Data siswa belum terhubung dengan akun ini.',
            ]);
        }

        $siswa = $user->siswa;

        $hariIni = Carbon::today();

        $kehadiranHariIni = Kehadiran::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', $hariIni)
            ->first();

        $riwayat = Kehadiran::where('siswa_id', $siswa->id)
            ->latest('tanggal')
            ->latest('jam')
            ->get();

        return view('kehadiran.siswa', compact(
            'siswa',
            'kehadiranHariIni',
            'riwayat'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->siswa) {
            return back()->withErrors([
                'absensi' => 'Data siswa belum terhubung dengan akun ini.',
            ]);
        }

        $siswa = $user->siswa;

        // Cek apakah siswa sudah absen hari ini
        $sudahAbsen = Kehadiran::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', Carbon::today())
            ->exists();

        if ($sudahAbsen) {
            return back()->withErrors([
                'absensi' => 'Anda sudah melakukan absensi hari ini.',
            ]);
        }

        // Validasi koordinat GPS
        $validated = $request->validate([
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | KOORDINAT SEKOLAH
        |--------------------------------------------------------------------------
        */

        $latitudeSekolah = -6.813200;
        $longitudeSekolah = 107.152700;

        // Radius maksimal dalam meter
        $radiusSekolah = 100;

        /*
        |--------------------------------------------------------------------------
        | HITUNG JARAK GPS
        |--------------------------------------------------------------------------
        */

        $jarak = $this->hitungJarak(
            $validated['latitude'],
            $validated['longitude'],
            $latitudeSekolah,
            $longitudeSekolah
        );

        /*
        |--------------------------------------------------------------------------
        | CEK RADIUS
        |--------------------------------------------------------------------------
        */

        if ($jarak > $radiusSekolah) {
            return back()->withErrors([
                'absensi' => 'Absensi ditolak. Anda berada di luar radius sekolah. Jarak Anda sekitar '
                    . round($jarak)
                    . ' meter dari lokasi sekolah.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN ABSENSI
        |--------------------------------------------------------------------------
        */

        Kehadiran::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $siswa->kelas_id,
            'tanggal' => Carbon::today(),
            'jam' => Carbon::now()->format('H:i:s'),
            'status' => 'Hadir',
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'keterangan' => 'Absensi melalui sistem GPS dalam radius sekolah',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS SISTEM
        |--------------------------------------------------------------------------
        */

        AktivitasSistem::create([
            'user_id' => $user->id,
            'nama_pengguna' => $siswa->nama ?? $user->name,
            'aktivitas' => 'Melakukan absensi GPS',
            'keterangan' => 'Siswa berhasil melakukan absensi pada '
                . Carbon::now()->format('H:i')
                . '. Status: Hadir. Jarak dari sekolah: '
                . round($jarak)
                . ' meter.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT SETELAH ABSENSI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('kehadiran.siswa')
            ->with(
                'success',
                'Absensi berhasil dicatat. Jarak Anda dari sekolah sekitar '
                . round($jarak)
                . ' meter.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | RUMUS HAVERSINE
    |--------------------------------------------------------------------------
    |
    | Menghitung jarak antara dua titik koordinat GPS
    | dan menghasilkan jarak dalam satuan meter.
    |
    */

    private function hitungJarak(
        $latitudeSiswa,
        $longitudeSiswa,
        $latitudeSekolah,
        $longitudeSekolah
    ) {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $lat1 = deg2rad($latitudeSiswa);
        $lat2 = deg2rad($latitudeSekolah);

        $deltaLat = deg2rad(
            $latitudeSekolah - $latitudeSiswa
        );

        $deltaLon = deg2rad(
            $longitudeSekolah - $longitudeSiswa
        );

        $a = sin($deltaLat / 2) * sin($deltaLat / 2)
            + cos($lat1)
            * cos($lat2)
            * sin($deltaLon / 2)
            * sin($deltaLon / 2);

        $c = 2 * atan2(
            sqrt($a),
            sqrt(1 - $a)
        );

        return $earthRadius * $c;
    }
}
