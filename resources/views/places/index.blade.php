@extends('layouts.app')

@section('content')
<h1 class="h3 mb-1">Cari Tempat Ramah Disabilitas</h1>
<p class="text-muted">Tempat terverifikasi di Kabupaten Kuningan, sesuai kebutuhan aksesibilitasmu.</p>

<form method="GET" action="{{ route('places.index') }}" class="card card-body mb-4">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="q" class="form-label">Kata kunci</label>
            <input type="text" id="q" name="q" class="form-control" value="{{ request('q') }}" placeholder="Nama tempat, kecamatan, atau alamat">
        </div>
        <div class="col-md-6">
            <label for="category_id" class="form-label">Kategori</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <fieldset class="mt-3">
        <legend class="fs-6 fw-bold">Fasilitas yang dibutuhkan</legend>
        <div class="row">
            @foreach ($facilitiesByNeed as $need => $facilities)
                <div class="col-md-4">
                    <p class="fw-semibold mb-1">{{ ['fisik' => 'Kebutuhan Fisik', 'penglihatan' => 'Kebutuhan Penglihatan', 'pendengaran' => 'Kebutuhan Pendengaran'][$need] ?? $need }}</p>
                    @foreach ($facilities as $facility)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $facility->id }}" id="facility-{{ $facility->id }}" @checked(in_array($facility->id, request('facilities', [])))>
                            <label class="form-check-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </fieldset>

    <div class="mt-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="{{ route('places.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

@if ($places->isEmpty())
    <div class="alert alert-info">Belum ada tempat terverifikasi yang cocok dengan pencarian ini. Coba kurangi filter atau ganti kata kunci.</div>
@else
    <div class="row row-cols-1 row-cols-md-3 g-3">
        @foreach ($places as $place)
            <div class="col">
                <div class="card h-100">
                    @if ($place->photo)
                        <img src="{{ asset('storage/' . $place->photo) }}" class="card-img-top" alt="Foto {{ $place->name }}" style="height: 180px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <span class="badge text-bg-primary mb-2">{{ $place->category->name }}</span>
                        <h2 class="h5 card-title">{{ $place->name }}</h2>
                        <p class="card-text text-muted mb-1">Kecamatan {{ $place->district }}</p>
                        <p class="card-text small">{{ $place->address }}</p>
                        <p class="card-text"><strong>{{ $place->facilities->count() }}</strong> fasilitas aksesibilitas</p>
                        <a href="{{ route('places.show', $place) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $places->links() }}
    </div>
@endif
@endsection
