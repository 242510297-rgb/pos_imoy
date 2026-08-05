@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<<<<<<< HEAD

<h4>Edit Produk</h4>

<form action="{{ route('admin.produk.update', $produk) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('produk._form')
</form>

=======
<h4>Edit Produk</h4>

<form action="{{ route('produk.update', $produk) }}"
      method="POST"
      enctype="multipart/form-data">
    @method('PUT')
    @include('Produk._form')
</form>
>>>>>>> 5416f579df75a9e2876c6b243c75f303f353fc36
@endsection