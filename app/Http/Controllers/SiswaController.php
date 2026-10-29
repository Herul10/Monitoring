<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')
            ->latest()
            ->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}