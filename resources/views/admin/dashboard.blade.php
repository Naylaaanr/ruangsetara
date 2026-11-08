@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Dashboard Admin</h1>

    <div class="alert alert-primary" role="alert">
        Kamu masuk sebagai <strong>admin</strong>. Area ini hanya bisa dibuka oleh akun dengan peran admin.
    </div>

    <div class="card">
        <div class="card-header">Area Pengelola</div>
        <div class="card-body">
            <p class="mb-3">Pengelola: {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
            <a href="{{ route('admin.places.index') }}" class="btn btn-primary">Kelola Data Tempat</a>
            <a href="{{ route('admin.places.create') }}" class="btn btn-outline-primary">Tambah Tempat Baru</a>
            <p class="text-muted mt-3 mb-0">
                Statistik tempat dan status verifikasi akan ditampilkan di sini pada sub-tahap 4E.
            </p>
        </div>
    </div>
</div>
@endsection
