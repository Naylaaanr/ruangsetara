<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RuangSetara')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --bs-primary: #047857;
            --bs-primary-rgb: 4, 120, 87;
            --bs-link-color: #047857;
            --bs-link-hover-color: #065f46;
        }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: #f3f6f4;
            color: #1f2937;
        }
        main { min-height: 62vh; }
        .btn-primary {
            --bs-btn-bg: #047857; --bs-btn-border-color: #047857;
            --bs-btn-hover-bg: #065f46; --bs-btn-hover-border-color: #065f46;
            --bs-btn-active-bg: #065f46; --bs-btn-active-border-color: #065f46;
            --bs-btn-disabled-bg: #047857; --bs-btn-disabled-border-color: #047857;
        }
        .btn-outline-primary {
            --bs-btn-color: #047857; --bs-btn-border-color: #047857;
            --bs-btn-hover-bg: #047857; --bs-btn-hover-border-color: #047857;
            --bs-btn-active-bg: #065f46; --bs-btn-active-border-color: #065f46;
        }
        .progress-bar { background-color: #047857; }
        .form-check-input:checked { background-color: #047857; border-color: #047857; }
        .form-control:focus, .form-select:focus {
            border-color: #6ee7b7;
            box-shadow: 0 0 0 .25rem rgba(4, 120, 87, .15);
        }
        .page-link { color: #047857; }
        .page-item.active .page-link { background-color: #047857; border-color: #047857; }
        .navbar-rs { background-color: rgba(255, 255, 255, .96); }
        .navbar-rs .nav-link { color: #3c4a57; font-weight: 500; }
        .navbar-rs .nav-link:hover { color: #047857; }
        .brand-badge {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px; border-radius: 12px;
            background-color: #047857; color: #fff; font-size: 1.25rem;
        }
        .icon-circle {
            display: inline-flex; align-items: center; justify-content: center;
            width: 60px; height: 60px; border-radius: 50%;
            background-color: #d1fae5; color: #047857; font-size: 1.7rem;
        }
        .icon-circle-sm { width: 44px; height: 44px; font-size: 1.2rem; }
        .card-hover { transition: transform .18s ease, box-shadow .18s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 1rem 2rem rgba(4, 63, 53, .12) !important; }
        .badge-score { background-color: #f59e0b; color: #1f2937; }
        .hero-rs {
            background: linear-gradient(120deg, #043f35 0%, #047857 55%, #0d9488 100%);
            color: #fff; border-radius: 1.5rem;
        }
        .footer-rs { background-color: #043f35; color: #cfe8df; }
        .footer-rs a { color: #e7f6f0; text-decoration: none; }
        .footer-rs a:hover { text-decoration: underline; }
        .step-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 44px; height: 44px; border-radius: 50%;
            background-color: #047857; color: #fff; font-weight: 700; font-size: 1.1rem;
        }
        :focus-visible { outline: 3px solid #f59e0b; outline-offset: 2px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-rs sticky-top shadow-sm" data-bs-theme="light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" style="color: #065f46;" href="{{ url('/') }}">
                <span class="brand-badge"><i class="bi bi-universal-access-circle"></i></span>
                RuangSetara
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUtama" aria-controls="navbarUtama" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarUtama">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('places.index') }}">Cari Tempat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recommendations.index') }}">Rekomendasi</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endauth
                    @auth
                        @if (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Panel Admin</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary rounded-pill px-3 ms-lg-2" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="navbar-text me-2 d-none d-lg-inline">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Keluar</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 rounded-4 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer-rs mt-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <p class="d-flex align-items-center gap-2 fw-bold text-white mb-2">
                        <span class="brand-badge"><i class="bi bi-universal-access-circle"></i></span>
                        RuangSetara
                    </p>
                    <p class="mb-0 small">Platform pencarian dan rekomendasi tempat ramah disabilitas di Kabupaten Kuningan, Jawa Barat. Setara untuk semua.</p>
                </div>
                <div class="col-md-2">
                    <p class="fw-bold text-white mb-2">Jelajahi</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="mb-1"><a href="{{ route('places.index') }}">Cari Tempat</a></li>
                        <li><a href="{{ route('recommendations.index') }}">Rekomendasi</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p class="fw-bold text-white mb-2">Tiga Kebutuhan</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1"><i class="bi bi-person-wheelchair me-1"></i> Disabilitas fisik</li>
                        <li class="mb-1"><i class="bi bi-eye me-1"></i> Tunanetra</li>
                        <li><i class="bi bi-ear me-1"></i> Tunarungu</li>
                    </ul>
                </div>
                    <div class="col-md-3">
                    <p class="fw-bold text-white mb-2">Kontak</p>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1"><i class="bi bi-geo-alt me-1"></i> Kabupaten Kuningan, Jawa Barat</li>
                        <li class="mb-1"><i class="bi bi-envelope me-1"></i> <a href="mailto:ayagreelaaa@gmail.com">ayagreelaaa@gmail.com</a></li>
                        <li><i class="bi bi-github me-1"></i> <a href="https://github.com/Naylaaanr/ruangsetara" target="_blank" rel="noopener">github.com/Naylaaanr/ruangsetara</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-light opacity-25">
            <p class="small mb-0">RuangSetara &mdash; Platform Tempat Ramah Disabilitas Kabupaten Kuningan</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
