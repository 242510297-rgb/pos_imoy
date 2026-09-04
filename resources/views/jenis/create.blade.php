@extends('layouts.app')

@section('title', 'Tambah Jenis Barang')

@section('content')
@include('layouts.navbar')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <!-- Breadcrumb / Tombol Kembali -->
            <div class="mb-3">
                <a href="{{ route('jenis.index') }}" class="text-decoration-none text-secondary small">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Jenis
                </a>
            </div>

            <!-- Card Form Create -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-primary bg-opacity-10 border-0 rounded-top-4 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="bi bi-tags fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Tambah Jenis Barang</h5>
                            <small class="text-muted">Masukkan informasi jenis barang baru</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('jenis.store') }}" method="POST">
                        @csrf

                        <!-- Input Nama Jenis -->
                        <div class="mb-4">
                            <label for="nama_jenis" class="form-label fw-semibold text-dark">
                                Nama Jenis <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control rounded-3 @error('nama_jenis') is-invalid @enderror" 
                                   id="nama_jenis" 
                                   name="nama_jenis" 
                                   value="{{ old('nama_jenis') }}" 
                                   placeholder="Contoh: Makanan / Minuman / Pakaian" 
                                   required>
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('jenis.index') }}" class="btn btn-light rounded-3 px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4">
                                <i class="bi bi-save me-1"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection