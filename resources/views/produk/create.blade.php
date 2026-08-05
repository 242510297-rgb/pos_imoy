@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h4>Tambah Produk</h4>

<<<<<<< HEAD
<form action="{{ route('admin.produk.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @include('produk._form')
=======
<form action="{{ route('produk.store') }}"
      method="POST"
      enctype="multipart/form-data">
@include('produk._form')
>>>>>>> 5416f579df75a9e2876c6b243c75f303f353fc36
</form>
@endsection