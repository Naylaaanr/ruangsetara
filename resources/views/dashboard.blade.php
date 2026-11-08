@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Dashboard</h1>

    <div class="alert alert-success" role="alert">
        Kamu berhasil masuk. Halaman ini <strong>terlindungi</strong>: hanya pengguna yang sudah login yang bisa membukanya.
    </div>

    <div class="card">
        <div class="card-header">Informasi Akun</div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

                <dt class="col-sm-3">Peran</dt>
                <dd class="col-sm-9">
                    <span class="badge {{ Auth::user()->isAdmin() ? 'text-bg-primary' : 'text-bg-secondary' }}">
                        {{ Auth::user()->role }}
                    </span>
                </dd>

                <dt class="col-sm-3">Terdaftar sejak</dt>
                <dd class="col-sm-9">{{ Auth::user()->created_at->format('d M Y, H:i') }}</dd>
            </dl>
        </div>
    </div>

    <p class="text-muted mt-3">
        Menu pencarian tempat ramah disabilitas akan tampil di sini pada tahap berikutnya.
    </p>
</div>
@endsection
