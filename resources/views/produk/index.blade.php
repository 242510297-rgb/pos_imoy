@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4">
{{-- Header --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Produk
        </h2>

        <p class="text-muted mb-0">
            Kelola daftar produk, harga, stok, dan informasi produk.
        </p>
    </div>

    @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Produk
        </a>
    @endcan

</div>


{{-- Search & Filter --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-3">

        <form action="{{ route('produk.index') }}" method="GET">

            <div class="row g-2">

                <div class="col-md-10">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request()->search }}"
                            class="form-control border-start-0"
                            placeholder="Cari nama produk..."
                        >

                    </div>

                </div>

                <div class="col-md-2">

                    <button
                        class="btn btn-dark w-100"
                        type="submit">

                        <i class="bi bi-search me-1"></i>
                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- Product Table --}}
<div class="card border-0 shadow-sm">

    {{-- Card Header --}}
    <div class="card-header bg-white border-0 p-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="fw-bold mb-1">
                    Daftar Produk
                </h5>

                <small class="text-muted">
                    Menampilkan {{ $products->total() }} produk
                </small>
            </div>

            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                <i class="bi bi-box-seam me-1"></i>
                Produk
            </span>

        </div>

    </div>


    {{-- Table --}}
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="ps-4" style="width: 60px;">
                            #
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Foto
                        </th>

                        <th>
                            Nama Produk
                        </th>

                        <th>
                            Harga Beli
                        </th>

                        <th>
                            Harga Jual
                        </th>

                        <th class="text-center">
                            Stok
                        </th>

                        <th class="text-center pe-4">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($products as $product)

                        <tr>

                            {{-- Number --}}
                            <td class="ps-4 text-muted">
                                {{ $products->firstItem() + $loop->index }}
                            </td>


                            {{-- User --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle bg-primary bg-opacity-10
                                               text-primary d-flex align-items-center
                                               justify-content-center me-2"
                                        style="width: 36px; height: 36px;">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <span class="fw-semibold">
                                        {{ $product->user->name ?? '-' }}
                                    </span>

                                </div>

                            </td>


                            {{-- Foto --}}
                            <td>

                                @if($product->foto)

                                    <img
                                        src="{{ asset('storage/' . $product->foto) }}"
                                        alt="{{ $product->nama }}"
                                        width="65"
                                        height="65"
                                        class="rounded-3 border"
                                        style="object-fit: cover;"
                                    >

                                @else

                                    <div
                                        class="bg-light border rounded-3
                                               d-flex align-items-center
                                               justify-content-center"
                                        style="width: 65px; height: 65px;">

                                        <i class="bi bi-image text-muted fs-4"></i>

                                    </div>

                                @endif

                            </td>


                            {{-- Nama --}}
                            <td>

                                <span class="fw-semibold">
                                    {{ $product->nama }}
                                </span>

                            </td>


                            {{-- Harga Beli --}}
                            <td>

                                <span class="text-muted">
                                    Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- Harga Jual --}}
                            <td>

                                <span class="fw-semibold text-success">
                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- Stok --}}
                            <td class="text-center">

                                @if($product->stok <= 0)

                                    <span class="badge bg-danger px-3 py-2">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Habis
                                    </span>

                                @elseif($product->stok <= 5)

                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        {{ $product->stok }}
                                    </span>

                                @else

                                    <span class="badge bg-success px-3 py-2">
                                        {{ $product->stok }}
                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}
                            <td class="text-center pe-4">

                                <div class="d-flex justify-content-center gap-1">

                                    @can('update', $product)

                                        <a
                                            href="{{ route('produk.edit', $product) }}"
                                            class="btn btn-outline-warning btn-sm"
                                            title="Edit produk">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    @endcan


                                    @can('delete', $product)

                                        <form
                                            action="{{ route('produk.destroy', $product) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus produk"
                                                onclick="return confirm('Yakin hapus produk ini?')">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    @endcan

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-box-seam fs-1 d-block mb-3"></i>

                                    <h6 class="fw-bold">
                                        Data tidak tersedia
                                    </h6>

                                    <p class="mb-0">
                                        Belum ada produk yang ditemukan.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if ($products->hasPages())

        <div class="card-footer bg-white border-0 p-4">

            <div class="d-flex justify-content-center">
            </div>

        </div>

    @endif

</div>

</div>

@endsection