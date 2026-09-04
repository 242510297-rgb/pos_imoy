<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisController extends Controller
{
    /**
     * Tampilkan daftar jenis produk + fitur pencarian.
     */
    public function index(Request $request)
    {
        // 🔍 Filter data hanya milik user yang sedang login
        $query = Jenis::where('user_id', Auth::id());

        // Fitur Search
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_jenis', 'like', '%' . $request->search . '%');
        }

        // Ambil data dengan paginasi 10 baris per halaman
        $jenis = $query->latest()->paginate(10);

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Tampilkan form tambah jenis baru.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Simpan jenis baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,NULL,id,user_id,' . Auth::id(),
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'nama_jenis.unique' => 'Nama jenis ini sudah ada.',
        ]);

        Jenis::create([
            'user_id'    => Auth::id(),
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit jenis.
     */
    public function edit(Jenis $jeni)
    {
        if ($jeni->user_id !== Auth::id()) {
            abort(403);
        }

        return view('jenis.edit', ['jenis' => $jeni]);
    }

    /**
     * Update jenis di database.
     */
    public function update(Request $request, Jenis $jeni)
    {
        if ($jeni->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,' . $jeni->id . ',id,user_id,' . Auth::id(),
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'nama_jenis.unique' => 'Nama jenis ini sudah digunakan.',
        ]);

        $jeni->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil diperbarui!');
    }

    /**
     * Hapus jenis dari database.
     */
    public function destroy(Jenis $jeni)
    {
        if ($jeni->user_id !== Auth::id()) {
            abort(403);
        }

        $jeni->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus!');
    }
}