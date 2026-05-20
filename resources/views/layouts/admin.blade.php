<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Smart Cocoa Care')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @endif

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    @stack('styles')
</head>
<body class="font-body bg-soft-stone text-ink min-h-screen flex">

    <aside class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col border-r border-white/10 bg-deep-green text-white shadow-[0_24px_80px_rgba(0,0,0,0.2)]">
        <div class="border-b border-white/10 px-8 py-8">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col gap-1">
                <span class="text-mono-label text-coral-soft">SMARTCOCOA</span>
                <span class="text-card-heading text-white">Administrator</span>
                <span class="text-caption text-white/60">Enterprise control panel</span>
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-6">
            <div class="px-4 pb-2 text-mono-label text-white/45">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                <span>Dashboard</span>
            </a>

            <div class="px-4 pb-2 pt-6 text-mono-label text-white/45">Data Master</div>
            <a href="{{ route('admin.grade.index') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.grade*') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="award" class="h-5 w-5"></i>
                <span>Grade Kualitas</span>
            </a>
            <a href="{{ route('admin.kriteria.index') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.kriteria*') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="list-checks" class="h-5 w-5"></i>
                <span>Kriteria</span>
            </a>
            <a href="{{ route('admin.rule.index') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.rule*') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="git-merge" class="h-5 w-5"></i>
                <span>Rule CF</span>
            </a>

            <div class="px-4 pb-2 pt-6 text-mono-label text-white/45">Konten</div>
            <a href="{{ route('admin.edukasi.index') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.edukasi*') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="book-open" class="h-5 w-5"></i>
                <span>Artikel Edukasi</span>
            </a>

            <div class="px-4 pb-2 pt-6 text-mono-label text-white/45">Pengguna</div>
            <a href="{{ route('admin.user.index') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.user*') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="users" class="h-5 w-5"></i>
                <span>Data User</span>
            </a>
            <a href="{{ route('admin.riwayat.index') }}" class="mb-1 flex items-center gap-3 rounded-xs px-4 py-3 text-body transition-colors {{ request()->routeIs('admin.riwayat*') ? 'bg-canvas text-deep-green' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="clock" class="h-5 w-5"></i>
                <span>Riwayat Analisis</span>
            </a>
        </nav>

        <div class="border-t border-white/10 p-4">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-xs px-4 py-3 text-body text-white/75 transition-colors hover:bg-[#ffefec] hover:text-error">
                    <i data-lucide="log-out" class="h-5 w-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="ml-[280px] flex min-h-screen flex-1 flex-col">
        <header class="sticky top-0 z-40 border-b border-border-light bg-canvas/95 px-8 py-5 backdrop-blur">
            <div class="flex items-center justify-between gap-6">
                <div>
                    <h1 class="text-card-heading m-0 text-ink">@yield('title', 'Dashboard')</h1>
                    <p class="text-caption m-0 text-muted">@yield('subtitle', 'Smart Cocoa Care Admin Panel')</p>
                </div>
                <div class="flex items-center gap-3 rounded-full border border-border-light bg-soft-stone px-4 py-2">
                    <i data-lucide="user" class="h-4 w-4 text-muted"></i>
                    <span class="text-caption font-medium text-ink">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <main class="flex-1 p-8 lg:p-10">
            @if(session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-lg border border-deep-green/15 bg-pale-green px-4 py-4 text-body text-deep-green">
                    <i data-lucide="check-circle-2" class="mt-0.5 h-5 w-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-lg border border-error/15 bg-[#fff2f0] px-4 py-4 text-body text-error">
                    <i data-lucide="alert-triangle" class="mt-0.5 h-5 w-5"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-border-light px-8 py-6 text-center text-caption text-muted">
            © {{ date('Y') }} Smart Cocoa Care — Enterprise System
        </footer>
    </div>

    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>