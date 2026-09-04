@extends('layouts.app')

@section('title', 'Manajemen Jenis Produk')

@section('content')
@include('layouts.navbar')

<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Manajemen Jenis Produk</h2>
            <p class="text-muted small mb-0">Kelola kategori/jenis produk yang tersedia di sistem.</p>
        </div>
        <a href="{{ route('jenis.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Jenis</span>
        </a>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('jenis.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0 ps-0"
                        placeholder="Cari nama jenis produk..."
                    >
                    <button class="btn btn-primary px-4" type="submit">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('jenis.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 10%;">#</th>
                            <th scope="col">Nama Jenis</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col" class="text-end pe-4" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jenis as $item)
                        <tr>
                            <td class="ps-4 fw-medium text-muted">
                                {{ method_exists($jenis, 'firstItem') ? $jenis->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $item->nama_jenis }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">
                                    <i class="bi bi-person-fill text-muted me-1"></i>
                                    {{ $item->user->name ?? 'Admin' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('jenis.edit', $item) }}" class="btn btn-sm btn-outline-warning d-flex align-items-center gap-1">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('jenis.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1" onclick="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')">
                                            <i class="bi bi-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Data jenis produk belum ada atau tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination Footer -->
        @if(method_exists($jenis, 'hasPages') && $jenis->hasPages())
        <div class="card-footer bg-white border-0 py-3 d-flex justify-content-end">
            {{ $jenis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection