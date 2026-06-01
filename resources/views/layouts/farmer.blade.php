<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'SmartCacaoCare — Petani')</title>

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
<body class="font-body bg-soft-stone text-ink min-h-screen flex flex-col lg:flex-row">

    {{-- Off-canvas Backdrop for Mobile --}}
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    {{-- Left Sidebar Navigation --}}
    <aside id="farmer-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-[280px] -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex-col border-r border-border-light bg-canvas text-ink shadow-[12px_0_40px_rgba(0,0,0,0.02)]">
        
        {{-- Logo Section --}}
        <div class="border-b border-border-light px-8 py-6">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3">
                <span class="font-display font-medium text-[20px] text-ink tracking-tight">SmartCacaoCare</span>
            </a>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 flex flex-col gap-1">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-body font-medium transition-all {{ request()->routeIs('user.dashboard') ? 'bg-coral/10 text-coral border-l-4 border-coral pl-3' : 'text-slate hover:bg-soft-stone/50 hover:text-ink' }}">
                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('petani.analysis') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-body font-medium transition-all {{ request()->routeIs('petani.analysis') || request()->routeIs('petani.index') ? 'bg-coral/10 text-coral border-l-4 border-coral pl-3' : 'text-slate hover:bg-soft-stone/50 hover:text-ink' }}">
                <i data-lucide="search" class="h-5 w-5"></i>
                <span>Analisis</span>
            </a>
            
            <a href="{{ route('user.riwayat') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-body font-medium transition-all {{ request()->routeIs('user.riwayat') ? 'bg-coral/10 text-coral border-l-4 border-coral pl-3' : 'text-slate hover:bg-soft-stone/50 hover:text-ink' }}">
                <i data-lucide="clock" class="h-5 w-5"></i>
                <span>Riwayat</span>
            </a>
            
            <a href="{{ route('mainpage.edukasi') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-body font-medium transition-all {{ request()->routeIs('mainpage.edukasi') ? 'bg-coral/10 text-coral border-l-4 border-coral pl-3' : 'text-slate hover:bg-soft-stone/50 hover:text-ink' }}">
                <i data-lucide="book-open" class="h-5 w-5"></i>
                <span>Edukasi</span>
            </a>
        </nav>

        {{-- User Strip & Logout --}}
        <div class="border-t border-border-light p-4 flex flex-col gap-3">
            <div class="flex items-center gap-3 px-4 py-2.5 bg-soft-stone/40 rounded-xl border border-border-light/40">
                <div class="h-8 w-8 rounded-full bg-coral/10 flex items-center justify-center text-coral text-caption font-bold border border-coral-soft/20 flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="truncate">
                    <div class="text-caption font-medium text-ink truncate leading-tight">{{ auth()->user()->name }}</div>
                    <div class="text-micro text-muted truncate mt-0.5 leading-none">{{ auth()->user()->email }}</div>
                </div>
            </div>
            
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-body font-medium text-slate hover:bg-[#ffefec] hover:text-error transition-colors">
                <i data-lucide="log-out" class="h-5 w-5"></i>
                <span>Keluar</span>
            </button>
        </div>
    </aside>

    {{-- Mobile Header --}}
    <header class="sticky top-0 z-30 flex lg:hidden h-16 items-center justify-between border-b border-border-light bg-canvas px-6 backdrop-blur">
        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 font-display font-medium text-[18px] text-ink">
            SmartCacaoCare
        </a>
        <button class="p-2 text-ink hover:bg-soft-stone/50 rounded-lg transition-colors" onclick="toggleSidebar()" aria-label="Menu">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </header>

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col min-w-0 lg:ml-[280px]">
        <main class="flex-1 p-6 lg:p-12 min-h-screen">
            @yield('content')
        </main>

        <footer class="border-t border-border-light/60 px-8 py-6 text-center text-caption text-muted bg-canvas/30">
            © {{ date('Y') }} Smart Cocoa Care — Enterprise Agricultural Console
        </footer>
    </div>

    {{-- Global Logout Form --}}
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>

    <script>
        lucide.createIcons();

        function toggleSidebar() {
            const sidebar = document.getElementById('farmer-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>
