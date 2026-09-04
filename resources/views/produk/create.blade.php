@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-primary text-white p-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold">Tambah Produk</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('produk._form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection