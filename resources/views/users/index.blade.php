@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')
@include('layouts.navbar')

<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Manajemen Users</h2>
            <p class="text-muted small mb-0">Kelola data pengguna, role, dan hak akses sistem.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            <i class="bi bi-person-plus-fill"></i>
            <span>Tambah User</span>
        </a>
    </div>

    <!-- Filter & Search Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('users.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0 ps-0"
                        placeholder="Cari berdasarkan username atau email..."
                    >
                    <button class="btn btn-primary px-4" type="submit">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                            <th scope="col" class="ps-4" style="width: 5%;">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end pe-4" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td class="ps-4 fw-medium text-muted">{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-placeholder rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="fw-semibold text-dark d-block">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-secondary">{{ $user->email }}</td>
                            <td>
                                <span class="badge rounded-pill bg-info bg-opacity-10 text-info fw-semibold px-3 py-2 text-capitalize">
                                    {{ $user->role->name }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning d-flex align-items-center gap-1">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            <i class="bi bi-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                Data user tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination Footer -->
        @if($users->hasPages())
        <div class="card-footer bg-white border-0 py-3 d-flex justify-content-end">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection