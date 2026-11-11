@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <span class="icon-circle fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
    <div>
        <h1 class="h3 fw-bold mb-0">Halo, {{ Auth::user()->name }}!</h1>
        <p class="text-muted mb-0">Ini dashboardmu di RuangSetara.</p>
    </div>
</div>

<div class="alert alert-success d-flex align-items-center gap-2 rounded-4 border-0 shadow-sm" role="alert">
    <i class="bi bi-shield-check"></i>
    <span>Kamu berhasil masuk. Halaman ini <strong>terlindungi</strong>: hanya pengguna yang sudah login yang bisa membukanya.</span>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <h2 class="h5 fw-bold mb-3"><i class="bi bi-person-circle text-primary"></i> Informasi Akun</h2>
        <dl class="row mb-0">
            <dt class="col-sm-3 text-muted">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

            <dt class="col-sm-3 text-muted">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

            <dt class="col-sm-3 text-muted">Peran</dt>
            <dd class="col-sm-9">
                <span class="badge rounded-pill {{ Auth::user()->isAdmin() ? 'text-bg-primary' : 'text-bg-secondary' }}">
                    {{ Auth::user()->role }}
                </span>
            </dd>

            <dt class="col-sm-3 text-muted">Terdaftar sejak</dt>
            <dd class="col-sm-9">{{ Auth::user()->created_at->format('d M Y, H:i') }}</dd>
        </dl>
    </div>
</div>

<div class="d-flex flex-wrap gap-2">
    <a href="{{ route('places.index') }}" class="btn btn-primary rounded-pill px-4"><i class="bi bi-search"></i> Cari Tempat</a>
    <a href="{{ route('recommendations.index') }}" class="btn btn-outline-primary rounded-pill px-4"><i class="bi bi-stars"></i> Rekomendasi</a>
    @if (Auth::user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dark rounded-pill px-4"><i class="bi bi-speedometer2"></i> Panel Admin</a>
    @endif
</div>
@endsection
