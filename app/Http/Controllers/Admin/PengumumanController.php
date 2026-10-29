<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman.
     */
    public function index()
    {
        $pengumumans = Pengumuman::with('user')
            ->latest()
            ->paginate(10);

        return view(
            'admin.pengumuman.index',
            compact('pengumumans')
        );
    }

    /**
     * Menampilkan form tambah pengumuman.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Menyimpan pengumuman baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_publikasi' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        Pengumuman::create([
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal_publikasi' =>
                $validated['tanggal_publikasi'] ?? null,
            'is_published' =>
                $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan form edit pengumuman.
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        return view(
            'admin.pengumuman.edit',
            compact('pengumuman')
        );
    }

    /**
     * Memperbarui pengumuman.
     */
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_publikasi' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        $pengumuman->update([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal_publikasi' =>
                $validated['tanggal_publikasi'] ?? null,
            'is_published' =>
                $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil diperbarui.'
            );
    }

    /**
     * Menghapus pengumuman.
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil dihapus.'
            );
    }
}
