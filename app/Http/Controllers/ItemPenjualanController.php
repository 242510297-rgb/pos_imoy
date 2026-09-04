<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Produk::findOrFail($request->product_id);

        if ($product->stok < $request->quantity) {
            return redirect()
                ->route('admin.penjualan.create')
                ->with('errors', 'Produk stok tidak mencukupi');
        }

        DB::transaction(function () use ($request, $product) {
            $sale = Penjualan::where('user_id', Auth::id())
                ->where('status', 'OPEN')
                ->firstOrFail();

            $product->lockForUpdate();

            // Cek stok ulang di dalam transaksi
            if ($product->stok < $request->quantity) {
                throw new \Exception('Stok tidak mencukupi');
            }

            $product->decrement('stok', $request->quantity);

            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                $item->kuantitas += $request->quantity;
            } else {
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id'    => $product->id,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back()->with('success', 'Produk berhasil ditambahkan.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $produk = $itempenjualan->produk;
        $selisih = $request->quantity - $itempenjualan->kuantitas;

        if ($selisih > 0 && $produk->stok < $selisih) {
            return redirect()
                ->route('admin.penjualan.create')
                ->with('errors', 'Stok tidak mencukupi');
        }

        DB::transaction(function () use ($request, $itempenjualan, $produk, $selisih) {
            $produk = $produk->fresh();
            $produk->lockForUpdate();

            if ($selisih > 0) {
                $produk->decrement('stok', $selisih);
            } elseif ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal'  => $request->quantity * $itempenjualan->harga_satuan,
            ]);

            $sale = $itempenjualan->penjualan;

            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back()->with('success', 'Item berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {
            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;

            $produk->increment('stok', $itempenjualan->kuantitas);

            $itempenjualan->delete();

            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back()->with('success', 'Item berhasil dihapus.');
    }
}