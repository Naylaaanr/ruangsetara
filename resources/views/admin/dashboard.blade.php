@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Dashboard Admin</h1>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center h-100">
            <div class="card-body">
                <p class="display-6 mb-0">{{ $stats['total_places'] }}</p>
                <p class="text-muted mb-0">Total Tempat</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center h-100 border-success">
            <div class="card-body">
                <p class="display-6 mb-0 text-success">{{ $stats['verified'] }}</p>
                <p class="text-muted mb-0">Sudah Diverifikasi</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center h-100 border-warning">
            <div class="card-body">
                <p class="display-6 mb-0 text-warning">{{ $stats['unverified'] }}</p>
                <p class="text-muted mb-0">Belum Diverifikasi</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center h-100 border-danger">
            <div class="card-body">
                <p class="display-6 mb-0 text-danger">{{ $stats['needs_review'] }}</p>
                <p class="text-muted mb-0">Perlu Diperiksa</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <p class="h4 mb-0">{{ $stats['total_categories'] }}</p>
                <p class="text-muted mb-0">Kategori</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <p class="h4 mb-0">{{ $stats['total_facilities'] }}</p>
                <p class="text-muted mb-0">Fasilitas pada Checklist</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <p class="h4 mb-0">{{ $stats['total_users'] }}</p>
                <p class="text-muted mb-0">Pengguna Terdaftar</p>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mb-4">
    <a href="{{ route('admin.places.index') }}" class="btn btn-primary">Kelola Data Tempat</a>
    <a href="{{ route('admin.places.create') }}" class="btn btn-outline-primary">Tambah Tempat Baru</a>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">Tempat per Kategori</div>
            <ul class="list-group list-group-flush">
                @forelse ($placesPerCategory as $category)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $category->name }}</span>
                        <span class="badge text-bg-secondary">{{ $category->places_count }}</span>
                    </li>
                @empty
                    <li class="list-group-item">Belum ada kategori.</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">Tempat Terbaru</div>
            <ul class="list-group list-group-flush">
                @forelse ($latestPlaces as $place)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $place->name }} <span class="text-muted small">({{ $place->category->name }})</span></span>
                        <span class="badge {{ $place->statusBadgeClass() }}">{{ $place->statusLabel() }}</span>
                    </li>
                @empty
                    <li class="list-group-item">Belum ada data tempat.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
