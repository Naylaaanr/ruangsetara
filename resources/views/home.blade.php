@extends('layouts.app')

@section('title', 'Beranda - RuangSetara')

@section('content')
@php
    $heroPlace = $latestPlaces->first(fn ($place) => $place->photo);
@endphp

<section class="hero-rs p-4 p-md-5 mb-5 shadow-sm" @if ($heroPlace) style="background-image: linear-gradient(120deg, rgba(4, 63, 53, .93), rgba(4, 120, 87, .78)), url('{{ asset('storage/' . $heroPlace->photo) }}'); background-size: cover; background-position: center;" @endif>
    <span class="badge rounded-pill text-bg-light mb-3"><i class="bi bi-geo-alt"></i> Kabupaten Kuningan, Jawa Barat</span>
    <h1 class="display-5 fw-bold col-lg-9">Temukan Tempat Ramah Disabilitas di Kabupaten Kuningan</h1>
    <p class="lead col-lg-8">Cari tempat sesuai kebutuhan aksesibilitasmu, lalu bandingkan Skor Aksesibilitasnya — semua tempat yang tampil sudah diverifikasi.</p>
    <div class="d-flex flex-wrap gap-2 mb-5">
        <a href="{{ route('places.index') }}" class="btn btn-light btn-lg rounded-pill px-4"><i class="bi bi-search"></i> Cari Tempat</a>
        <a href="{{ route('recommendations.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-4"><i class="bi bi-stars"></i> Lihat Rekomendasi</a>
    </div>
    <div class="row g-3 col-lg-8">
        <div class="col-4">
            <p class="display-6 fw-bold mb-0">{{ $stats['places'] }}</p>
            <p class="small mb-0 opacity-75">Tempat Terverifikasi</p>
        </div>
        <div class="col-4">
            <p class="display-6 fw-bold mb-0">{{ $stats['categories'] }}</p>
            <p class="small mb-0 opacity-75">Kategori Tempat</p>
        </div>
        <div class="col-4">
            <p class="display-6 fw-bold mb-0">{{ $stats['facilities'] }}</p>
            <p class="small mb-0 opacity-75">Fasilitas Aksesibilitas</p>
        </div>
    </div>
</section>

<p class="text-uppercase fw-bold small text-primary mb-1">Tiga kebutuhan, satu platform</p>
<h2 class="h4 fw-bold mb-3">Dirancang untuk Kebutuhanmu</h2>
<div class="row g-3 mb-5">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <span class="icon-circle mb-3"><i class="bi bi-person-wheelchair"></i></span>
                <h3 class="h5 fw-bold">Disabilitas Fisik</h3>
                <p class="text-muted small">Untuk pengguna kursi roda dan keterbatasan gerak.</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Jalur landai (ramp)</li>
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Toilet aksesibel</li>
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Parkir khusus disabilitas</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-1"></i> Lift aksesibel</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <span class="icon-circle mb-3"><i class="bi bi-eye"></i></span>
                <h3 class="h5 fw-bold">Tunanetra</h3>
                <p class="text-muted small">Untuk keterbatasan penglihatan.</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Guiding block (jalur pemandu)</li>
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Informasi braille</li>
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Pengumuman audio</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-1"></i> Kontras warna dan pencahayaan jelas</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <span class="icon-circle mb-3"><i class="bi bi-ear"></i></span>
                <h3 class="h5 fw-bold">Tunarungu</h3>
                <p class="text-muted small">Untuk keterbatasan pendengaran.</p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Informasi visual (layar dan papan teks)</li>
                    <li class="mb-1"><i class="bi bi-check-circle-fill text-primary me-1"></i> Komunikasi tertulis atau bahasa isyarat</li>
                    <li><i class="bi bi-check-circle-fill text-primary me-1"></i> Alarm visual (lampu peringatan)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-end mb-3">
    <h2 class="h4 fw-bold mb-0">Tempat Terverifikasi Terbaru</h2>
    <a href="{{ route('places.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat Semua <i class="bi bi-arrow-right"></i></a>
</div>
@if ($latestPlaces->isEmpty())
    <div class="alert alert-info rounded-4 border-0">Belum ada tempat terverifikasi untuk ditampilkan.</div>
@else
    <div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
        @foreach ($latestPlaces as $place)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                    @if ($place->photo)
                        <img src="{{ asset('storage/' . $place->photo) }}" class="card-img-top" alt="Foto {{ $place->name }}" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height: 180px; background-color: #e7f4ef;">
                            <i class="bi bi-image" style="font-size: 3rem; color: #047857;"></i>
                        </div>
                    @endif
                    <div class="card-body p-4">
                        <span class="badge text-bg-primary rounded-pill mb-2">{{ $place->category->name }}</span>
                        <h3 class="h5 fw-bold card-title">{{ $place->name }}</h3>
                        <p class="card-text text-muted mb-2"><i class="bi bi-geo-alt"></i> Kecamatan {{ $place->district }}</p>
                        <div class="mb-3">
                            @foreach ($place->facilities->take(4) as $facility)
                                <span class="badge text-bg-light border rounded-pill"><i class="bi bi-check-lg"></i> {{ $facility->name }}</span>
                            @endforeach
                            @if ($place->facilities->count() > 4)
                                <span class="badge text-bg-light border rounded-pill">+{{ $place->facilities->count() - 4 }} lagi</span>
                            @endif
                        </div>
                        <a href="{{ route('places.show', $place) }}" class="btn btn-outline-primary btn-sm rounded-pill w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<h2 class="h4 fw-bold mb-3">Cara Kerjanya</h2>
<div class="row g-3 mb-2 text-center">
    <div class="col-md-4">
        <span class="step-number mb-2">1</span>
        <h3 class="h6 fw-bold">Cari &amp; Saring</h3>
        <p class="text-muted small mb-0">Temukan tempat berdasarkan kategori dan fasilitas yang kamu butuhkan.</p>
    </div>
    <div class="col-md-4">
        <span class="step-number mb-2">2</span>
        <h3 class="h6 fw-bold">Bandingkan Skor</h3>
        <p class="text-muted small mb-0">Lihat Skor Aksesibilitas tiap tempat untuk kebutuhanmu.</p>
    </div>
    <div class="col-md-4">
        <span class="step-number mb-2">3</span>
        <h3 class="h6 fw-bold">Kunjungi Tempat</h3>
        <p class="text-muted small mb-0">Semua tempat yang tampil sudah diverifikasi admin.</p>
    </div>
</div>
@endsection
