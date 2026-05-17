<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Smart Cocoa Care')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f0ebe3; font-family: 'Segoe UI', sans-serif; }
        #sidebar { width: 250px; min-height: 100vh; background: linear-gradient(180deg, #3d2b1f 0%, #5c3d2e 100%); position: fixed; top: 0; left: 0; z-index: 100; }
        #sidebar .sidebar-brand { padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        #sidebar .nav-link { color: rgba(255,255,255,0.75); padding: 12px 20px; border-radius: 8px; margin: 2px 10px; transition: all 0.2s; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { color: #fff; background-color: rgba(255,255,255,0.15); }
        #sidebar .nav-link i { width: 20px; margin-right: 8px; }
        #sidebar .nav-section { color: rgba(255,255,255,0.4); font-size: 11px; font-weight: 600; letter-spacing: 1px; padding: 15px 20px 5px; text-transform: uppercase; }
        #main-content { margin-left: 250px; min-height: 100vh; }
        #topbar { background: #fff; border-bottom: 1px solid #e0d6cc; padding: 12px 24px; position: sticky; top: 0; z-index: 99; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .card-header { border-radius: 12px 12px 0 0 !important; border-bottom: 1px solid #e0d6cc; }
        .table thead th { background-color: #f8f3ee; color: #3d2b1f; font-weight: 600; border-bottom: 2px solid #e0d6cc; }
        .btn-cocoa { background-color: #3d2b1f; color: #fff; border: none; }
        .btn-cocoa:hover { background-color: #5c3d2e; color: #fff; }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<div id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
            <h5 class="text-white fw-bold mb-0">🍫 Smart Cocoa Care</h5>
            <small style="color: rgba(255,255,255,0.5);">Admin Panel</small>
        </a>
    </div>
    <nav class="mt-3">
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">Data Master</div>
        <a href="{{ route('admin.grade.index') }}"
           class="nav-link {{ request()->routeIs('admin.grade*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Grade Kualitas
        </a>
        <a href="{{ route('admin.kriteria.index') }}"
           class="nav-link {{ request()->routeIs('admin.kriteria*') ? 'active' : '' }}">
            <i class="bi bi-list-check"></i> Kriteria
        </a>
        <a href="{{ route('admin.rule.index') }}"
           class="nav-link {{ request()->routeIs('admin.rule*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i> Rule CF
        </a>

        <div class="nav-section">Konten</div>
        <a href="{{ route('admin.edukasi.index') }}"
           class="nav-link {{ request()->routeIs('admin.edukasi*') ? 'active' : '' }}">
            <i class="bi bi-journal-richtext"></i> Artikel Edukasi
        </a>

        <div class="nav-section">Pengguna</div>
        <a href="{{ route('admin.user.index') }}"
           class="nav-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Data User
        </a>
        <a href="{{ route('admin.riwayat.index') }}"
           class="nav-link {{ request()->routeIs('admin.riwayat*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat Analisis
        </a>

        <div class="nav-section">Akun</div>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="nav-link w-100 text-start border-0"
                    style="background: none; cursor: pointer;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </nav>
</div>

{{-- MAIN CONTENT --}}
<div id="main-content">
    <div id="topbar" class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-0 fw-semibold text-dark">@yield('title', 'Dashboard')</h6>
            <small class="text-muted">@yield('subtitle', 'Smart Cocoa Care Admin Panel')</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle text-muted"></i>
            <small class="text-muted fw-semibold">{{ auth()->user()->name }}</small>
        </div>
    </div>

    <div class="p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center py-3" style="color: #999; font-size: 12px;">
        © {{ date('Y') }} Smart Cocoa Care — Kelompok 8
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>