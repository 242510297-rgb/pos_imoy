@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
@include('layouts.navbar')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Tambah User Baru</h2>
                    <p class="text-muted small mb-0">Isi formulir di bawah untuk menambahkan pengguna baru ke sistem.</p>
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('users.store') }}" method="POST">
                        @include('users._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection