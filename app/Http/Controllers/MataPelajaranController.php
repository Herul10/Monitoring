<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajarans = MataPelajaran::latest()->get();

        return view('mata-pelajaran.index', compact('mataPelajarans'));
    }

    public function create()
    {
        return view('mata-pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        MataPelajaran::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm,
        ]);

        return redirect()
            ->route('mata-pelajaran.index')
            ->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        return view('mata-pelajaran.edit', compact('mataPelajaran'));
    }

    public function update(Request $request, $id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $mataPelajaran->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm,
        ]);

        return redirect()
            ->route('mata-pelajaran.index')
            ->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        $mataPelajaran->delete();

        return redirect()
            ->route('mata-pelajaran.index')
            ->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}