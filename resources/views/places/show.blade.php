@extends('layouts.app')

@section('content')
<a href="{{ route('places.index') }}" class="btn btn-link px-0">&larr; Kembali ke daftar tempat</a>

<div class="d-flex flex-wrap align-items-center gap-2 mb-2">
    <h1 class="h3 mb-0">{{ $place->name }}</h1>
    <span class="badge text-bg-primary">{{ $place->category->name }}</span>
    <span class="badge text-bg-success">Sudah Diverifikasi</span>
</div>

<p class="text-muted">{{ $place->address }} — Kecamatan {{ $place->district }}, Kabupaten Kuningan</p>
@if ($place->photo)
    <img src="{{ asset('storage/' . $place->photo) }}" class="img-fluid rounded mb-3" alt="Foto {{ $place->name }}">
@endif


@if ($place->description)
    <p>{{ $place->description }}</p>
@endif

<div class="row g-3 mb-4">
    @if ($place->opening_hours)
        <div class="col-md-6">
            <div class="card card-body h-100">
                <strong>Jam buka</strong>
                <span>{{ $place->opening_hours }}</span>
            </div>
        </div>
    @endif
    @if ($place->phone)
        <div class="col-md-6">
            <div class="card card-body h-100">
                <strong>Telepon</strong>
                <span>{{ $place->phone }}</span>
            </div>
        </div>
    @endif
</div>

<h2 class="h5">Fasilitas Aksesibilitas</h2>
@foreach ($place->facilities->groupBy('need') as $need => $facilities)
    <h3 class="h6 mt-3">{{ ['fisik' => 'Kebutuhan Fisik', 'penglihatan' => 'Kebutuhan Penglihatan', 'pendengaran' => 'Kebutuhan Pendengaran'][$need] ?? $need }}</h3>
    <ul class="list-group mb-2">
        @foreach ($facilities as $facility)
            <li class="list-group-item">&#10003; {{ $facility->name }}</li>
        @endforeach
    </ul>
@endforeach

@if ($place->maps_url)
    <a href="{{ $place->maps_url }}" target="_blank" rel="noopener" class="btn btn-primary mt-3">Buka di Google Maps</a>
@endif
@endsection
