<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis; // Tambahkan namespace model Jenis
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                    $query->where('nama', 'like', "%" . $keyword . "%");
                })
                ->orderBy('nama')
                ->paginate(10)
                ->withQueryString();
        } else {
            $products = Produk::latest()->paginate(10)->withQueryString();
        }

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenis = Jenis::all(); // Ambil data jenis untuk dikirim ke view

        return view('produk.create', compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        // Ambil data yang sudah tervalidasi dari StoreRequest
        $data = $request->validated();
        
        // Tambahkan ID user yang sedang login
        $data['user_id'] = Auth::id();

        // Simpan file foto jika diunggah
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenis = Jenis::all(); // Ambil data jenis untuk form edit

        return view('produk.edit', compact('produk', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        // Ambil data yang sudah tervalidasi dari UpdateRequest
        $data = $request->validated();

        // Ganti foto jika ada upload file baru
        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        // Cek apakah produk sudah pernah digunakan dalam transaksi penjualan
        if ($produk->itemPenjualan()->exists()) {
            return redirect()->back()->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi penjualan.');
        }

        // Hapus foto dari storage jika ada
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}