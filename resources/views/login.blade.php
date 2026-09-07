@extends('layouts.app')

@section('title', 'Login - POS System')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="width: 100%; max-width: 400px;">
        <!-- Header Card -->
        <div class="card-header bg-primary text-white text-center py-4 border-0">
            <div class="mb-2">
                <i class="bi bi-cart-check-fill display-5"></i>
            </div>
            <h4 class="fw-bold mb-0"> POS Step Up Shoes Store</h4>
            <small class="text-white-50">Silakan masuk ke akun Anda</small>
        </div>

        <!-- Body Card -->
        <div class="card-body p-4">
            
            {{-- Alert Notifikasi Success / Error --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 fs-7" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 fs-7" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                               placeholder="nama@email.com"
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                        @error('email')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Input Password -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold text-secondary">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                               placeholder="••••••••"
                               required>
                        @error('password')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm">
                    Masuk Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
            </form>
        </div>

        <div class="card-footer bg-light text-center py-3 border-0">
            <small class="text-muted">&copy; {{ date('Y') }} POS Application</small>
        </div>
    </div>
</div>
@endsection