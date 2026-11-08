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
            <p class="mb-1">Pengelola: {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
            <p class="text-muted mb-0">
                Menu pengelolaan data tempat, fasilitas, dan statistik verifikasi akan dibangun di area ini pada tahap berikutnya.
            </p>
        </div>
    </div>
</div>
@endsection
