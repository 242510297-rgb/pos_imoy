@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4">
{{-- Header --}}
<div class="mb-4">
    <h2 class="fw-bold mb-1">
        Ringkasan Hari Ini
    </h2>
    <p class="text-muted mb-0">
        {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
    </p>
</div>

{{-- =========================
    SALES SUMMARY
========================== --}}
@can('viewAny', App\Models\User::class)

<div class="d-flex align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">Today's Sales</h4>
        <small class="text-muted">
            Ringkasan penjualan hari ini
        </small>
    </div>
</div>

<div class="row g-4 mb-5">

    {{-- Total Penjualan --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Total Nilai Penjualan Hari Ini
                        </p>

                        <h3 class="fw-bold mb-0">
                            Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Total Transaksi --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Jumlah Transaksi Hari Ini
                        </p>

                        <h3 class="fw-bold mb-0">
                            {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <i class="bi bi-receipt fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

{{-- =========================
    PAYMENT STATUS
========================== --}}

<div class="d-flex align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">Cash & Payment Status</h4>
        <small class="text-muted">
            Ringkasan metode pembayaran
        </small>
    </div>
</div>

<div class="row g-4 mb-5">

    {{-- Cash --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Total Pembayaran Tunai
                        </p>

                        <h3 class="fw-bold mb-0">
                            Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Non Tunai --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Total Pembayaran Non-Tunai
                        </p>

                        <h3 class="fw-bold mb-0">
                            Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                        <i class="bi bi-credit-card fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

@endcan


{{-- =========================
    INVENTORY STATUS
========================== --}}

<div class="d-flex align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">
            Critical Inventory Status
        </h4>

        <small class="text-muted">
            Pantau produk yang membutuhkan perhatian
        </small>
    </div>
</div>

<div class="row g-4 mb-5">

    {{-- Stok Rendah --}}
    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 p-4 pb-2">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Produk Stok Rendah
                        </h5>

                        <small class="text-muted">
                            Produk yang perlu segera diperhatikan
                        </small>
                    </div>

                    <span class="badge bg-warning text-dark px-3 py-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Stok Rendah
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama Produk</th>
                                <th class="text-center pe-4">Stok</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($produkStokRendah as $index => $produk)

                                <tr>
                                    <td class="ps-4 text-muted">
                                        {{ $produkStokRendah->firstItem() + $index }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $produk->nama }}
                                    </td>

                                    <td class="text-center pe-4">
                                        <span class="badge bg-warning text-dark">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle text-success fs-4 d-block mb-2"></i>
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            @if ($produkStokRendah->hasPages())
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    {{ $produkStokRendah->links() }}
                </div>
            @endif

        </div>

    </div>


    {{-- Stok Habis --}}
    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 p-4 pb-2">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Produk Habis Stok
                        </h5>

                        <small class="text-muted">
                            Produk yang perlu segera direstock
                        </small>
                    </div>

                    <span class="badge bg-danger px-3 py-2">
                        <i class="bi bi-x-circle me-1"></i>
                        Habis
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama Produk</th>
                                <th class="text-center pe-4">Stok</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($produkStokHabis as $index => $produk)

                                <tr>
                                    <td class="ps-4 text-muted">
                                        {{ $produkStokHabis->firstItem() + $index }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $produk->nama }}
                                    </td>

                                    <td class="text-center pe-4">
                                        <span class="badge bg-danger">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle text-success fs-4 d-block mb-2"></i>
                                        Tidak ada produk yang habis stok.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            @if ($produkStokHabis->hasPages())
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    {{ $produkStokHabis->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


{{-- =========================
    BEST SELLER
========================== --}}

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h4 class="fw-bold mb-0">
            Best Seller Products
        </h4>

        <small class="text-muted">
            Produk dengan penjualan terbanyak
        </small>
    </div>

    <span class="badge bg-primary px-3 py-2">
        <i class="bi bi-trophy me-1"></i>
        Top Products
    </span>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Nama Produk</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center pe-4">Unit Terjual</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($produkTerlaris as $produk)

                        <tr>

                            <td class="ps-4">
                                <div class="d-flex align-items-center">

                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                        <i class="bi bi-box-seam"></i>
                                    </div>

                                    <span class="fw-semibold">
                                        {{ $produk->nama }}
                                    </span>

                                </div>
                            </td>

                            <td class="text-center">

                                @if ($produk->stok <= 0)

                                    <span class="badge bg-danger">
                                        Habis
                                    </span>

                                @elseif ($produk->stok <= 5)

                                    <span class="badge bg-warning text-dark">
                                        {{ $produk->stok }}
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        {{ $produk->stok }}
                                    </span>

                                @endif

                            </td>

                            <td class="text-center pe-4">

                                <span class="fw-bold text-primary">
                                    {{ number_format($produk->total_terjual, 0, ',', '.') }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center py-5 text-muted">

                                <i class="bi bi-bar-chart fs-1 d-block mb-2"></i>

                                Belum ada data produk terlaris.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@endsection