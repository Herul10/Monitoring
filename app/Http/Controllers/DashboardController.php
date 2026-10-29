<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Kehadiran;
use App\Models\AktivitasSistem;
use App\Models\Pengumuman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | DATA UMUM
        |--------------------------------------------------------------------------
        */

        $totalSiswa = Siswa::count();

        $totalGuru = Guru::count();

        $totalKelas = Kelas::count();

        $totalMataPelajaran = MataPelajaran::count();

        // Alias untuk dashboard versi lama
        $totalMapel = $totalMataPelajaran;

        $totalNilai = Nilai::count();

        $rataRataNilai = Nilai::avg('nilai_akhir') ?? 0;


        /*
        |--------------------------------------------------------------------------
        | PENGUMUMAN SEKOLAH
        |--------------------------------------------------------------------------
        */

        // Mengambil pengumuman yang sudah dipublikasikan
        // dan tanggal publikasinya sudah tiba.
        $pengumumanTerbaru = Pengumuman::where('is_published', true)
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere(
                    'tanggal_publikasi',
                    '<=',
                    now()
                );
        })
        ->orderByDesc('created_at')
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | KEHADIRAN HARI INI
        |--------------------------------------------------------------------------
        */

        // Jumlah siswa yang memiliki catatan absensi hari ini
        $kehadiranHariIni = Kehadiran::whereDate(
            'tanggal',
            Carbon::today()
        )->count();

        // Jumlah siswa yang hadir hari ini
        $jumlahHadirHariIni = Kehadiran::whereDate(
            'tanggal',
            Carbon::today()
        )
            ->where('status', 'hadir')
            ->count();

        // Alias untuk dashboard versi lama
        $totalKehadiranHariIni = $kehadiranHariIni;

        // Jumlah seluruh siswa terdaftar
        $totalSiswaTerdaftar = Siswa::count();

        // Persentase kehadiran siswa
        $persentaseKehadiran = $totalSiswaTerdaftar > 0
            ? round(
                ($jumlahHadirHariIni / $totalSiswaTerdaftar) * 100,
                1
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | GRAFIK KEHADIRAN 7 HARI TERAKHIR
        |--------------------------------------------------------------------------
        */

        $tanggalGrafik = [];

        $dataHadir = [];

        $dataIzin = [];

        $dataSakit = [];

        $dataAlpha = [];

        for ($i = 6; $i >= 0; $i--) {

            $tanggal = Carbon::today()->subDays($i);

            // Label tanggal untuk grafik
            $tanggalGrafik[] = $tanggal->format('d/m');

            // Jumlah siswa hadir
            $dataHadir[] = Kehadiran::whereDate(
                'tanggal',
                $tanggal
            )
                ->where('status', 'hadir')
                ->count();

            // Jumlah siswa izin
            $dataIzin[] = Kehadiran::whereDate(
                'tanggal',
                $tanggal
            )
                ->where('status', 'izin')
                ->count();

            // Jumlah siswa sakit
            $dataSakit[] = Kehadiran::whereDate(
                'tanggal',
                $tanggal
            )
                ->where('status', 'sakit')
                ->count();

            // Jumlah siswa alpha
            $dataAlpha[] = Kehadiran::whereDate(
                'tanggal',
                $tanggal
            )
                ->where('status', 'alpha')
                ->count();
        }


        /*
        |--------------------------------------------------------------------------
        | TAHUN AJARAN
        |--------------------------------------------------------------------------
        */

        $tahunAjaran = Nilai::latest('created_at')
            ->value('tahun_ajaran') ?? '2026/2027';


        /*
        |--------------------------------------------------------------------------
        | DATA KHUSUS SISWA
        |--------------------------------------------------------------------------
        */

        $siswa = null;

        $nilaiSiswa = collect();

        $totalNilaiSiswa = 0;

        $rataRataNilaiSiswa = 0;

        $totalKehadiranSiswa = 0;

        if ($user->role === 'siswa' && $user->siswa) {

            $siswa = $user->siswa;

            $nilaiSiswa = Nilai::with('mataPelajaran')
                ->where('siswa_id', $siswa->id)
                ->latest('created_at')
                ->get();

            $totalNilaiSiswa = $nilaiSiswa->count();

            $rataRataNilaiSiswa = $nilaiSiswa->avg(
                'nilai_akhir'
            ) ?? 0;

            $totalKehadiranSiswa = Kehadiran::where(
                'siswa_id',
                $siswa->id
            )->count();
        }


        /*
        |--------------------------------------------------------------------------
        | DATA GURU
        |--------------------------------------------------------------------------
        */

        $totalNilaiGuru = $totalNilai;

        $rataRataNilaiGuru = $rataRataNilai;


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS SISTEM TERBARU
        |--------------------------------------------------------------------------
        */

        // Mengambil 8 aktivitas terbaru dari database
        $aktivitasTerbaru = AktivitasSistem::latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(

            // Data pengguna
            'user',

            // Pengumuman sekolah
            'pengumumanTerbaru',

            // Data umum
            'totalSiswa',
            'totalGuru',
            'totalKelas',
            'totalMataPelajaran',
            'totalMapel',
            'totalNilai',
            'rataRataNilai',

            // Kehadiran
            'kehadiranHariIni',
            'totalKehadiranHariIni',
            'jumlahHadirHariIni',
            'totalSiswaTerdaftar',
            'persentaseKehadiran',

            // Grafik
            'tanggalGrafik',
            'dataHadir',
            'dataIzin',
            'dataSakit',
            'dataAlpha',

            // Tahun ajaran
            'tahunAjaran',

            // Data siswa
            'siswa',
            'nilaiSiswa',
            'totalNilaiSiswa',
            'rataRataNilaiSiswa',
            'totalKehadiranSiswa',

            // Data guru
            'totalNilaiGuru',
            'rataRataNilaiGuru',

            // Aktivitas sistem
            'aktivitasTerbaru'

        ));
    }
}
