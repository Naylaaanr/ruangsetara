@extends('layouts.app')

@section('content')
<h1 class="h3 fw-bold mb-1"><i class="bi bi-stars text-primary"></i> Rekomendasi Tempat untukmu</h1>
<p class="text-muted mb-4">Pilih kebutuhanmu, tempat diurutkan dari yang fasilitasnya paling cocok.</p>

<form method="GET" action="{{ route('recommendations.index') }}" class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <fieldset>
            <legend class="fs-6 fw-bold mb-3">Kebutuhan aksesibilitasmu</legend>
            <div class="row g-3">
                @foreach ($needs as $value => $label)
                    <div class="col-md-4">
                        <input type="radio" class="btn-check" name="need" id="need-{{ $value }}" value="{{ $value }}" @checked(request('need') === $value)>
                        <label class="btn btn-outline-primary w-100 h-100 rounded-4 p-3 text-start" for="need-{{ $value }}">
                            <i class="bi {{ ['fisik' => 'bi-person-wheelchair', 'penglihatan' => 'bi-eye', 'pendengaran' => 'bi-ear'][$value] ?? 'bi-universal-access' }} fs-2 d-block mb-2"></i>
                            <span class="fw-bold">{{ $label }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </fieldset>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-stars"></i> Lihat Rekomendasi</button>
        </div>
    </div>
</form>

@if ($need)
    @if ($places->isEmpty())
        <div class="alert alert-info rounded-4 border-0">Belum ada tempat terverifikasi untuk rekomendasi ini.</div>
    @else
        <p class="text-muted">Diurutkan dari skor tertinggi untuk {{ $needs[$need] }} (total {{ $total }} fasilitas).</p>
        @foreach ($places as $place)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3 card-hover">
                @if ($place->photo)
                    <img src="{{ asset('storage/' . $place->photo) }}" class="card-img-top" alt="Foto {{ $place->name }}" style="height: 160px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center" style="height: 160px; background-color: #e7f4ef;">
                        <i class="bi bi-image" style="font-size: 3rem; color: #047857;"></i>
                    </div>
                @endif
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <div>
                            <span class="badge text-bg-primary rounded-pill mb-2">{{ $place->category->name }}</span>
                            <h2 class="h5 fw-bold card-title mb-1">{{ $place->name }}</h2>
                            <p class="card-text text-muted mb-1"><i class="bi bi-geo-alt"></i> Kecamatan {{ $place->district }}</p>
                            <p class="card-text small mb-0">{{ $place->matched_count }} dari {{ $place->total_count }} fasilitas {{ $needs[$need] }}</p>
                        </div>
                        <span class="badge badge-score fs-6 rounded-pill px-3 py-2"><i class="bi bi-award"></i> {{ $place->score }}%</span>
                    </div>
                    <div class="progress mt-3 rounded-pill" role="progressbar" aria-valuenow="{{ $place->score }}" aria-valuemin="0" aria-valuemax="100" aria-label="Skor aksesibilitas {{ $place->name }}" style="height: 10px;">
                        <div class="progress-bar" style="width: {{ $place->score }}%"></div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        @foreach ($place->facilities->where('need', $need) as $facility)
                            <span class="badge text-bg-light border rounded-pill"><i class="bi bi-check-lg"></i> {{ $facility->name }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('places.show', $place) }}" class="btn btn-outline-primary btn-sm rounded-pill mt-3">Lihat Detail</a>
                </div>
            </div>
        @endforeach
        <p class="text-muted small">Tempat dengan skor 0% tetap ditampilkan di urutan paling bawah, supaya urutan skornya terlihat bekerja dan tidak ada tempat yang hilang diam-diam.</p>
    @endif
@endif
@endsection
