<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::latest()->get();

        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
            'mata_pelajaran' => 'nullable',
        ]);

        Guru::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip,' . $guru->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable',
            'no_hp' => 'nullable',
            'mata_pelajaran' => 'nullable',
        ]);

        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}