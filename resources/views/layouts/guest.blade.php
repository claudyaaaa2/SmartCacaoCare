<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Cocoa Care')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0ebe3; }
        .navbar-guest { background: linear-gradient(135deg, #3d2b1f 0%, #5c3d2e 100%); padding: 14px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.15); }
        .navbar-guest .navbar-brand { font-size: 20px; font-weight: 700; color: #fff !important; }
        .navbar-guest .nav-link { color: rgba(255,255,255,0.8) !important; font-weight: 500; }
        .navbar-guest .nav-link:hover { color: #fff !important; }
        .btn-navbar-login { background: transparent; border: 1px solid rgba(255,255,255,0.6); color: #fff !important; border-radius: 20px; padding: 6px 18px; font-size: 14px; }
        .btn-navbar-login:hover { background: rgba(255,255,255,0.15); }
        .btn-navbar-register { background: #c8860a; border: none; color: #fff !important; border-radius: 20px; padding: 6px 18px; font-size: 14px; }
        .btn-navbar-register:hover { background: #a06d08; }
        .auth-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 16px; }
        .auth-card { background: #fff; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.10); padding: 40px; width: 100%; max-width: 440px; }
        .auth-logo { text-align: center; margin-bottom: 24px; }
        .auth-logo h4 { color: #3d2b1f; font-weight: 700; }
        .auth-logo p { color: #888; font-size: 14px; }
        .form-control:focus { border-color: #5c3d2e; box-shadow: 0 0 0 0.2rem rgba(92,61,46,0.15); }
        .form-label { font-weight: 500; color: #3d2b1f; font-size: 14px; }
        .btn-cocoa { background: linear-gradient(135deg, #3d2b1f 0%, #5c3d2e 100%); color: #fff; border: none; border-radius: 8px; padding: 10px; font-weight: 600; width: 100%; }
        .btn-cocoa:hover { background: linear-gradient(135deg, #5c3d2e 0%, #7a5240 100%); color: #fff; transform: translateY(-1px); }
        .footer-guest { background: #3d2b1f; color: rgba(255,255,255,0.6); text-align: center; padding: 16px; font-size: 13px; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-guest">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">🍫 Smart Cocoa Care</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navGuest">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navGuest">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing') }}">
                        <i class="bi bi-house"></i> Beranda
                    </a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-navbar-login">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-navbar-register">
                    <i class="bi bi-person-plus"></i> Daftar
                </a>
            </div>
        </div>
    </div>
</nav>

@yield('content')

<footer class="footer-guest">
    © {{ date('Y') }} Smart Cocoa Care — Kelompok 8
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>