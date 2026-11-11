@extends('layouts.app')

@section('title', 'Masuk - RuangSetara')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="p-4 text-white" style="background: linear-gradient(120deg, #043f35, #047857);">
                <span class="brand-badge mb-2" style="background-color: rgba(255, 255, 255, .18);"><i class="bi bi-box-arrow-in-right"></i></span>
                <h1 class="h4 fw-bold mb-1">Masuk ke RuangSetara</h1>
                <p class="small mb-0 opacity-75">Selamat datang kembali. Masuk untuk membuka dashboardmu.</p>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-4 border-0" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata sandi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Masuk</button>
                </form>

                <p class="mt-3 mb-0 text-center small">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
