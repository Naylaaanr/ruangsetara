@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali isianmu:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="name" class="form-label">Nama Tempat</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $place->name ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select class="form-select" id="category_id" name="category_id" required>
            <option value="">— Pilih kategori —</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $place->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status Verifikasi</label>
        <select class="form-select" id="status" name="status" required>
            <option value="belum_diverifikasi" @selected(old('status', $place->status ?? 'belum_diverifikasi') === 'belum_diverifikasi')>Belum Diverifikasi</option>
            <option value="sudah_diverifikasi" @selected(old('status', $place->status ?? '') === 'sudah_diverifikasi')>Sudah Diverifikasi</option>
            <option value="perlu_diperiksa" @selected(old('status', $place->status ?? '') === 'perlu_diperiksa')>Perlu Diperiksa</option>
        </select>
    </div>
</div>

<div class="mb-3">
    <label for="address" class="form-label">Alamat</label>
    <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', $place->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="district" class="form-label">Kecamatan</label>
    <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $place->district ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi <span class="text-muted">(boleh kosong)</span></label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $place->description ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="phone" class="form-label">Telepon <span class="text-muted">(boleh kosong)</span></label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $place->phone ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="opening_hours" class="form-label">Jam Buka <span class="text-muted">(boleh kosong)</span></label>
        <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $place->opening_hours ?? '') }}" placeholder="cth: 08.00-16.00">
    </div>
    <div class="col-md-4 mb-3">
        <label for="maps_url" class="form-label">Tautan Google Maps <span class="text-muted">(boleh kosong)</span></label>
        <input type="url" class="form-control" id="maps_url" name="maps_url" value="{{ old('maps_url', $place->maps_url ?? '') }}" placeholder="https://maps.google.com/...">
    </div>
</div>

<fieldset class="mb-3">
    <legend class="h6">Fasilitas Aksesibilitas</legend>
    <p class="text-muted small">Centang fasilitas yang tersedia di tempat ini.</p>

    @php
        $selectedFacilities = old('facilities', isset($place) ? $place->facilities->pluck('id')->toArray() : []);
        $needLabels = [
            'fisik' => 'Kebutuhan Fisik (pengguna kursi roda / disabilitas fisik)',
            'penglihatan' => 'Kebutuhan Penglihatan (tunanetra / keterbatasan penglihatan)',
            'pendengaran' => 'Kebutuhan Pendengaran (tunarungu / keterbatasan pendengaran)',
        ];
    @endphp

    @foreach ($needLabels as $need => $label)
        <p class="fw-semibold mb-1 mt-3">{{ $label }}</p>
        @foreach ($facilities->where('need', $need) as $facility)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $facility->id }}" id="facility-{{ $facility->id }}" @checked(in_array($facility->id, $selectedFacilities))>
                <label class="form-check-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
            </div>
        @endforeach
    @endforeach
</fieldset>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.places.index') }}" class="btn btn-outline-secondary">Batal</a>
