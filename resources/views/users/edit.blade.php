@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold text-dark mb-0">Edit User</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @method('PUT')
                        @include('users._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection