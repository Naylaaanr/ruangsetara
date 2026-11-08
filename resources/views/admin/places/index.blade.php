@extends('layouts.app')

@section('title', 'Kelola Data Tempat')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Kelola Data Tempat</h1>
        <a href="{{ route('admin.places.create') }}" class="btn btn-primary">+ Tambah Tempat</a>
    </div>

    @if ($places->isEmpty())
        <div class="alert alert-info">
            Belum ada data tempat. Klik tombol "Tambah Tempat" untuk menambahkan data pertama.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nama Tempat</th>
                        <th>Kategori</th>
                        <th>Kecamatan</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($places as $place)
                        <tr>
                            <td>{{ $place->name }}</td>
                            <td>{{ $place->category->name }}</td>
                            <td>{{ $place->district }}</td>
                            <td>{{ $place->facilities_count }} fasilitas</td>
                            <td>
                                <span class="badge {{ $place->statusBadgeClass() }}">{{ $place->statusLabel() }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.places.edit', $place) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.places.destroy', $place) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tempat ini? Data yang dihapus tidak bisa dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $places->links() }}
    @endif
</div>
@endsection
