@extends('layouts.app')

@section('content')
<h1 class="h3 mb-1">Rekomendasi Tempat untukmu</h1>
<p class="text-muted">Pilih kebutuhanmu, tempat diurutkan dari yang fasilitasnya paling cocok.</p>

<form method="GET" action="{{ route('recommendations.index') }}" class="card card-body mb-4">
    <fieldset>
        <legend class="fs-6 fw-bold">Kebutuhan aksesibilitasmu</legend>
        @foreach ($needs as $value => $label)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="need" value="{{ $value }}" id="need-{{ $value }}" @checked(request('need') === $value)>
                <label class="form-check-label" for="need-{{ $value }}">{{ $label }}</label>
            </div>
        @endforeach
    </fieldset>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Lihat Rekomendasi</button>
    </div>
</form>

@if ($need)
    @if ($places->isEmpty())
        <div class="alert alert-info">Belum ada tempat terverifikasi untuk rekomendasi ini.</div>
    @else
        <p class="text-muted">Diurutkan dari skor tertinggi untuk {{ $needs[$need] }} (total {{ $total }} fasilitas).</p>
        @foreach ($places as $place)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <div>
                            <span class="badge text-bg-primary mb-2">{{ $place->category->name }}</span>
                            <h2 class="h5 card-title mb-1">{{ $place->name }}</h2>
                            <p class="card-text text-muted mb-1">Kecamatan {{ $place->district }}</p>
                            <p class="card-text small mb-0">{{ $place->matched_count }} dari {{ $place->total_count }} fasilitas {{ $needs[$need] }}</p>
                        </div>
                        <span class="badge text-bg-success fs-6">{{ $place->score }}%</span>
                    </div>
                    <div class="progress mt-2" role="progressbar" aria-valuenow="{{ $place->score }}" aria-valuemin="0" aria-valuemax="100" aria-label="Skor aksesibilitas {{ $place->name }}">
                        <div class="progress-bar" style="width: {{ $place->score }}%"></div>
                    </div>
                    <ul class="list-group list-group-flush mt-2">
                        @foreach ($place->facilities->where('need', $need) as $facility)
                            <li class="list-group-item px-0 py-1">&#10003; {{ $facility->name }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('places.show', $place) }}" class="btn btn-sm btn-outline-primary mt-2">Lihat Detail</a>
                </div>
            </div>
        @endforeach
        <p class="text-muted small">Tempat dengan skor 0% tetap ditampilkan di urutan paling bawah, supaya urutan skornya terlihat bekerja dan tidak ada tempat yang hilang diam-diam.</p>
    @endif
@endif
@endsection
