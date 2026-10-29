<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru')
            ->latest()
            ->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama')->get();

        return view('kelas.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'jurusan' => 'nullable',
            'guru_id' => 'nullable|exists:gurus,id',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
        {
            $kelas = Kelas::findOrFail($id);

            $gurus = Guru::orderBy('nama')->get();

            return view('kelas.edit', compact('kelas', 'gurus'));
        }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'jurusan' => 'nullable',
            'guru_id' => 'nullable|exists:gurus,id',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

   public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}