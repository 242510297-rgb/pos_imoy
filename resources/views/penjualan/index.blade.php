@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4">

    {{-- Alert Error --}}
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="bi bi-cart-check-fill me-2"></i>
                Halaman Penjualan
            </h2>
            <p class="text-muted mb-0">
                Kelola seluruh transaksi penjualan.
            </p>
        </div>

        <a href="{{ route('penjualan.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="bi bi-plus-circle me-1"></i>
            Transaksi Baru
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control border-start-0"
                           placeholder="Cari transaksi berdasarkan ID..."
                           onkeyup="this.form.submit()">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table Data Penjualan --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>ID Transaksi</th>
                            <th>Kasir / User</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualan as $key => $item)
                            <tr>
                                <td class="ps-4">{{ $penjualan->firstItem() + $key }}</td>
                                <td class="fw-bold text-primary">#{{ $item->id }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $item->payment_method ?? 'Belum Dipilih' }}
                                    </span>
                                </td>
                                <td class="fw-semibold">
                                    Rp {{ number_format($item->total_pembayaran ?? 0, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if ($item->status === 'COMPLETED')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($item->status === 'OPEN')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    @else
                                        <span class="badge bg-danger">Batal</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('penjualan.show', $item->id) }}" class="btn btn-sm btn-outline-info me-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @can('delete', $item)
                                        <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada data transaksi penjualan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Pagination --}}
        @if ($penjualan->hasPages())
            <div class="card-footer bg-white border-0 py-3">
            </div>
        @endif
    </div>

</div>

@endsection