<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Kehadiran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // =====================================================
        // DATA UMUM
        // =====================================================

        $totalSiswa = Siswa::count();

        $totalGuru = Guru::count();

        $totalKelas = Kelas::count();

        $totalMataPelajaran = MataPelajaran::count();

        // Alias untuk dashboard versi lama
        $totalMapel = $totalMataPelajaran;

        $totalNilai = Nilai::count();

        $rataRataNilai = Nilai::avg('nilai_akhir') ?? 0;

        // =====================================================
        // KEHADIRAN HARI INI
        // =====================================================

        $kehadiranHariIni = Kehadiran::whereDate(
            'tanggal',
            Carbon::today()
        )->count();

        // Alias untuk dashboard versi lama
        $totalKehadiranHariIni = $kehadiranHariIni;

        // =====================================================
        // TAHUN AJARAN
        // =====================================================

        $tahunAjaran = Nilai::latest('created_at')
            ->value('tahun_ajaran') ?? '2026/2027';

        // =====================================================
        // DATA KHUSUS SISWA
        // =====================================================

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

            $rataRataNilaiSiswa =
                $nilaiSiswa->avg('nilai_akhir') ?? 0;

            $totalKehadiranSiswa = Kehadiran::where(
                'siswa_id',
                $siswa->id
            )->count();
        }

        // =====================================================
        // DATA GURU
        // =====================================================

        $totalNilaiGuru = $totalNilai;

        $rataRataNilaiGuru = $rataRataNilai;

        // =====================================================
        // KIRIM SEMUA DATA KE DASHBOARD
        // =====================================================

        return view('dashboard', compact(

            // User
            'user',

            // Data umum
            'totalSiswa',
            'totalGuru',
            'totalKelas',

            // Mata pelajaran
            'totalMataPelajaran',
            'totalMapel',

            // Nilai
            'totalNilai',
            'rataRataNilai',

            // Kehadiran
            'kehadiranHariIni',
            'totalKehadiranHariIni',

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
            'rataRataNilaiGuru'
        ));
    }
}