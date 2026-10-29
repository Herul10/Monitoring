<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa', 'mataPelajaran'])
            ->latest()
            ->get();

        return view('nilai.index', compact('nilais'));
    }

    public function siswa()
    {
        $user = auth()->user();

        if (!$user->siswa) {
            return back()->withErrors([
                'nilai' => 'Data siswa belum terhubung dengan akun ini.',
            ]);
        }

        $siswa = $user->siswa;

        $nilais = Nilai::with('mataPelajaran')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();

        return view('nilai.siswa', compact('siswa', 'nilais'));
    }

    public function create()
    {
        $siswas = Siswa::orderBy('nama')->get();

        $mataPelajarans = MataPelajaran::orderBy('nama')->get();

        return view('nilai.create', compact(
            'siswas',
            'mataPelajarans'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',

            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',

            'semester' => 'required|in:Ganjil,Genap',

            'tahun_ajaran' => [
                'required',
                'string',
                'max:20',
            ],
        ]);

        // Hitung nilai akhir
        $nilaiAkhir =
            ($validated['nilai_tugas'] * 0.30) +
            ($validated['nilai_uts'] * 0.30) +
            ($validated['nilai_uas'] * 0.40);

        // Cek apakah nilai untuk siswa + mapel + semester + tahun ajaran sudah ada
        $sudahAda = Nilai::where('siswa_id', $validated['siswa_id'])
            ->where(
                'mata_pelajaran_id',
                $validated['mata_pelajaran_id']
            )
            ->where(
                'semester',
                $validated['semester']
            )
            ->where(
                'tahun_ajaran',
                $validated['tahun_ajaran']
            )
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->withErrors([
                    'nilai' =>
                        'Nilai untuk siswa, mata pelajaran, semester, dan tahun ajaran tersebut sudah ada.',
                ]);
        }

        Nilai::create([
            'siswa_id' => $validated['siswa_id'],

            'mata_pelajaran_id' =>
                $validated['mata_pelajaran_id'],

            'nilai_tugas' =>
                $validated['nilai_tugas'],

            'nilai_uts' =>
                $validated['nilai_uts'],

            'nilai_uas' =>
                $validated['nilai_uas'],

            'nilai_akhir' =>
                round($nilaiAkhir, 2),

            'semester' =>
                $validated['semester'],

            'tahun_ajaran' =>
                $validated['tahun_ajaran'],
        ]);

        return redirect()
            ->route('nilai.index')
            ->with(
                'success',
                'Nilai akademik berhasil ditambahkan.'
            );
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);

        $siswas = Siswa::orderBy('nama')->get();

        $mataPelajarans =
            MataPelajaran::orderBy('nama')->get();

        return view(
            'nilai.edit',
            compact(
                'nilai',
                'siswas',
                'mataPelajarans'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',

            'mata_pelajaran_id' =>
                'required|exists:mata_pelajarans,id',

            'nilai_tugas' =>
                'required|numeric|min:0|max:100',

            'nilai_uts' =>
                'required|numeric|min:0|max:100',

            'nilai_uas' =>
                'required|numeric|min:0|max:100',

            'semester' =>
                'required|in:Ganjil,Genap',

            'tahun_ajaran' =>
                'required|string|max:20',
        ]);

        // Hitung ulang nilai akhir
        $nilaiAkhir =
            ($validated['nilai_tugas'] * 0.30) +
            ($validated['nilai_uts'] * 0.30) +
            ($validated['nilai_uas'] * 0.40);

        // Cek duplikasi kecuali data yang sedang diedit
        $sudahAda = Nilai::where('siswa_id', $validated['siswa_id'])
            ->where(
                'mata_pelajaran_id',
                $validated['mata_pelajaran_id']
            )
            ->where(
                'semester',
                $validated['semester']
            )
            ->where(
                'tahun_ajaran',
                $validated['tahun_ajaran']
            )
            ->where('id', '!=', $nilai->id)
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->withErrors([
                    'nilai' =>
                        'Nilai untuk kombinasi tersebut sudah ada.',
                ]);
        }

        $nilai->update([
            'siswa_id' =>
                $validated['siswa_id'],

            'mata_pelajaran_id' =>
                $validated['mata_pelajaran_id'],

            'nilai_tugas' =>
                $validated['nilai_tugas'],

            'nilai_uts' =>
                $validated['nilai_uts'],

            'nilai_uas' =>
                $validated['nilai_uas'],

            'nilai_akhir' =>
                round($nilaiAkhir, 2),

            'semester' =>
                $validated['semester'],

            'tahun_ajaran' =>
                $validated['tahun_ajaran'],
        ]);

        return redirect()
            ->route('nilai.index')
            ->with(
                'success',
                'Nilai akademik berhasil diperbarui.'
            );
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);

        $nilai->delete();

        return redirect()
            ->route('nilai.index')
            ->with(
                'success',
                'Nilai akademik berhasil dihapus.'
            );
    }
}