<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', config('app.name', 'SmartCacaoCare'))</title>

    {{-- Google Fonts: Outfit (Display) and Inter (Body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @endif

    {{-- Lucide Icons CDN --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="bg-canvas text-ink font-body @yield('bodyClass','')">

    <div class="announcement-bar">
        <span><span class="font-mono uppercase tracking-widest text-coral mr-2">Status</span> SmartCacaoCare is in active development. <a href="#" class="underline hover:text-white transition-colors">Learn more</a></span>
    </div>

    <div class="site-container w-full">
        <header class="flex items-center justify-between h-[72px] px-[24px] lg:px-[80px] bg-canvas relative z-50 border-b border-border-light" id="topbar">
            <div class="flex items-center gap-3 font-display font-medium text-[20px] text-ink tracking-tight">
                <a href="{{ url('/') }}" class="no-underline text-ink font-display text-[20px]">SmartCacaoCare</a>
            </div>

            <button class="md:hidden p-2 text-ink" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" aria-label="Menu">
                <i data-lucide="menu" style="width:24px;height:24px"></i>
            </button>

            @hasSection('nav')
                <div class="hidden md:flex items-center gap-6">
                    @yield('nav')
                </div>
            @else
                <nav class="hidden md:flex items-center gap-8 text-body font-medium">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'text-coral' : 'text-ink hover:text-action-blue' }} transition-colors flex items-center gap-2">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                        </a>
                        <a href="{{ route('petani.analysis') }}" class="{{ request()->routeIs('petani.analysis') ? 'text-coral' : 'text-ink hover:text-action-blue' }} transition-colors flex items-center gap-2">
                            <i data-lucide="search" class="w-4 h-4"></i> Analisis
                        </a>
                        <a href="{{ route('user.riwayat') }}" class="{{ request()->routeIs('user.riwayat') ? 'text-coral' : 'text-ink hover:text-action-blue' }} transition-colors flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4"></i> Riwayat
                        </a>
                        <a href="{{ route('mainpage.edukasi') }}" class="{{ request()->routeIs('mainpage.edukasi') ? 'text-coral' : 'text-ink hover:text-action-blue' }} transition-colors flex items-center gap-2">
                            <i data-lucide="book-open" class="w-4 h-4"></i> Edukasi
                        </a>
                    @else
                        @if(request()->is('/') || request()->is('#*'))
                            <a href="#about" class="text-ink hover:text-action-blue transition-colors">About</a>
                            <a href="#services" class="text-ink hover:text-action-blue transition-colors">Services</a>
                            <a href="#contact" class="text-ink hover:text-action-blue transition-colors">Contacts</a>
                        @else
                            <a href="{{ url('/') }}" class="text-ink hover:text-action-blue transition-colors">Beranda</a>
                            <a href="{{ route('petani.analysis') }}" class="{{ request()->routeIs('petani.analysis') ? 'text-coral' : 'text-ink hover:text-action-blue' }} transition-colors flex items-center gap-2">
                                <i data-lucide="search" class="w-4 h-4"></i> Analisis
                            </a>
                            <a href="{{ route('mainpage.edukasi') }}" class="{{ request()->routeIs('mainpage.edukasi') ? 'text-coral' : 'text-ink hover:text-action-blue' }} transition-colors flex items-center gap-2">
                                <i data-lucide="book-open" class="w-4 h-4"></i> Edukasi
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif

            <nav class="hidden md:flex items-center gap-4">
                @auth
                    <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone py-2 px-4 text-body" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar <i data-lucide="log-out" class="ml-1 w-4 h-4"></i>
                    </a>
                @else
                    <a class="btn-primary" href="{{ route('login') }}">
                        Masuk <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                    </a>
                @endauth
            </nav>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden absolute top-[80px] left-0 right-0 bg-canvas border-b border-border-light p-[24px] flex flex-col gap-4 shadow-lg md:hidden z-50">
                @auth
                    <a href="{{ route('user.dashboard') }}" class="text-ink hover:text-coral transition-colors font-medium flex items-center gap-2 py-2">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                    <a href="{{ route('petani.analysis') }}" class="text-ink hover:text-coral transition-colors font-medium flex items-center gap-2 py-2">
                        <i data-lucide="search" class="w-4 h-4"></i> Analisis
                    </a>
                    <a href="{{ route('user.riwayat') }}" class="text-ink hover:text-coral transition-colors font-medium flex items-center gap-2 py-2">
                        <i data-lucide="clock" class="w-4 h-4"></i> Riwayat
                    </a>
                    <a href="{{ route('mainpage.edukasi') }}" class="text-ink hover:text-coral transition-colors font-medium flex items-center gap-2 py-2">
                        <i data-lucide="book-open" class="w-4 h-4"></i> Edukasi
                    </a>
                    <hr class="border-border-light my-2">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-error font-medium flex items-center gap-2 py-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                    </a>
                @else
                    <a href="{{ url('/') }}" class="text-ink font-medium py-2">Beranda</a>
                    <a href="{{ route('petani.analysis') }}" class="text-ink font-medium py-2 flex items-center gap-2">
                        <i data-lucide="search" class="w-4 h-4"></i> Analisis
                    </a>
                    <a href="{{ route('mainpage.edukasi') }}" class="text-ink font-medium py-2 flex items-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4"></i> Edukasi
                    </a>
                    <hr class="border-border-light my-2">
                    <a class="btn-primary w-full justify-center py-3" href="{{ route('login') }}">Masuk</a>
                @endauth
            </div>
        </header>

        <main class="min-h-[calc(100vh-80px)]">
            @yield('content')
        </main>

        <footer id="contact" class="footer-newsletter">
            <div class="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-[40px] items-center">
                <div>
                    <span class="inline-flex items-center justify-center bg-transparent text-coral text-caption rounded-sm px-[10px] py-[4px] border border-coral-soft mb-[16px]">Agricultural Infrastructure</span>
                    <h3 class="font-display text-[32px] font-normal leading-[1.2] tracking-[-0.01em] text-on-dark mb-4">Advance your cacao quality.</h3>
                    <p class="text-muted text-body max-w-[40ch]">SmartCacaoCare provides the tools and references you need to make confident decisions on the field.</p>
                </div>
                <div class="flex flex-col gap-[16px]">
                    <p class="text-micro text-muted uppercase tracking-[0.02em] font-mono">Subscribe to updates</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Your email address" class="w-full h-[44px] px-[14px] py-[10px] rounded-xs border border-cohere-black bg-ink text-on-dark text-body transition-colors focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral">
                        <button class="btn-primary-white">Submit</button>
                    </div>
                </div>
            </div>
            <div class="max-w-[1200px] mx-auto mt-[64px] pt-[24px] border-t border-ink flex flex-col md:flex-row justify-between text-muted">
                <span class="flex items-center gap-2"><i data-lucide="leaf" style="width:14px;height:14px"></i> SmartCacaoCare 2026</span>
                <span class="mt-4 md:mt-0 text-right">Enterprise Quality Control</span>
            </div>
        </footer>
    </div>

    @auth
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
    @endauth

    <script>lucide.createIcons();</script>
    @stack('scripts')
</body>
</html>
