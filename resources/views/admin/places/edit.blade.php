@extends('layouts.app')

@section('title', 'Edit Tempat')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Edit Tempat: {{ $place->name }}</h1>

    <form action="{{ route('admin.places.update', $place) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.places._form')
    </form>
</div>
@endsection
