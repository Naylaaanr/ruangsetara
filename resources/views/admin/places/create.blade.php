@extends('layouts.app')

@section('title', 'Tambah Tempat')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Tambah Tempat Baru</h1>

    <form action="{{ route('admin.places.store') }}" method="POST">
        @csrf
        @include('admin.places._form')
    </form>
</div>
@endsection
