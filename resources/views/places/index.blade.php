@extends('layouts.app')

@section('content')
<h1 class="h3 fw-bold mb-1"><i class="bi bi-search text-primary"></i> Cari Tempat Ramah Disabilitas</h1>
<p class="text-muted mb-4">Tempat terverifikasi di Kabupaten Kuningan, sesuai kebutuhan aksesibilitasmu.</p>

<form method="GET" action="{{ route('places.index') }}" class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="q" class="form-label fw-semibold">Kata kunci</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="q" name="q" class="form-control" value="{{ request('q') }}" placeholder="Nama tempat, kecamatan, atau alamat">
                </div>
            </div>
            <div class="col-md-6">
                <label for="category_id" class="form-label fw-semibold">Kategori</label>
                <select id="category_id" name="category_id" class="form-select">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <fieldset class="mt-4">
            <legend class="fs-6 fw-bold"><i class="bi bi-sliders text-primary"></i> Fasilitas yang dibutuhkan</legend>
            <div class="row">
                @foreach ($facilitiesByNeed as $need => $facilities)
                    <div class="col-md-4">
                        <p class="fw-semibold mb-1"><i class="bi {{ ['fisik' => 'bi-person-wheelchair', 'penglihatan' => 'bi-eye', 'pendengaran' => 'bi-ear'][$need] ?? 'bi-universal-access' }} text-primary"></i> {{ ['fisik' => 'Kebutuhan Fisik', 'penglihatan' => 'Kebutuhan Penglihatan', 'pendengaran' => 'Kebutuhan Pendengaran'][$need] ?? $need }}</p>
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

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-search"></i> Cari</button>
            <a href="{{ route('places.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Reset</a>
        </div>
    </div>
</form>

@if ($places->isEmpty())
    <div class="alert alert-info rounded-4 border-0">Belum ada tempat terverifikasi yang cocok dengan pencarian ini. Coba kurangi filter atau ganti kata kunci.</div>
@else
    <p class="text-muted">{{ $places->total() }} tempat ditemukan</p>
    <div class="row row-cols-1 row-cols-md-3 g-3">
        @foreach ($places as $place)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                    @if ($place->photo)
                        <img src="{{ asset('storage/' . $place->photo) }}" class="card-img-top" alt="Foto {{ $place->name }}" style="height: 190px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height: 190px; background-color: #e7f4ef;">
                            <i class="bi bi-image" style="font-size: 3rem; color: #047857;"></i>
                        </div>
                    @endif
                    <div class="card-body p-4">
                        <span class="badge text-bg-primary rounded-pill mb-2">{{ $place->category->name }}</span>
                        <h2 class="h5 fw-bold card-title">{{ $place->name }}</h2>
                        <p class="card-text text-muted mb-1"><i class="bi bi-geo-alt"></i> Kecamatan {{ $place->district }}</p>
                        <p class="card-text small text-muted">{{ $place->address }}</p>
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

    <div class="mt-4 d-flex justify-content-center">
        {{ $places->links() }}
    </div>
@endif
@endsection
