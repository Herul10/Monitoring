<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MonitoringKehadiranController extends Controller
{
    public function index(Request $request)
    {
        // Koordinat SMKS Pasundan Cianjur
        $latitudeSekolah = -6.813200;
        $longitudeSekolah = 107.152700;

        $query = Kehadiran::with(['siswa', 'kelas'])
            ->latest('tanggal')
            ->latest('jam');

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter kelas
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $kehadirans = $query->get();

        /*
        |--------------------------------------------------------------------------
        | HITUNG JARAK SETIAP ABSENSI
        |--------------------------------------------------------------------------
        */

        foreach ($kehadirans as $kehadiran) {

            if (
                $kehadiran->latitude !== null &&
                $kehadiran->longitude !== null
            ) {
                $kehadiran->jarak = $this->hitungJarak(
                    $kehadiran->latitude,
                    $kehadiran->longitude,
                    $latitudeSekolah,
                    $longitudeSekolah
                );

                $kehadiran->dalam_radius =
                    $kehadiran->jarak <= 100;
            } else {
                $kehadiran->jarak = null;
                $kehadiran->dalam_radius = false;
            }
        }

        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('monitoring.kehadiran', compact(
            'kehadirans',
            'kelas',
            'latitudeSekolah',
            'longitudeSekolah'
        ));
    }

    private function hitungJarak(
        $latitudeSiswa,
        $longitudeSiswa,
        $latitudeSekolah,
        $longitudeSekolah
    ) {
        $earthRadius = 6371000;

        $lat1 = deg2rad($latitudeSiswa);
        $lat2 = deg2rad($latitudeSekolah);

        $deltaLat = deg2rad(
            $latitudeSekolah - $latitudeSiswa
        );

        $deltaLon = deg2rad(
            $longitudeSekolah - $longitudeSiswa
        );

        $a = sin($deltaLat / 2) ** 2
            + cos($lat1)
            * cos($lat2)
            * sin($deltaLon / 2) ** 2;

        $c = 2 * atan2(
            sqrt($a),
            sqrt(1 - $a)
        );

        return $earthRadius * $c;
    }
}