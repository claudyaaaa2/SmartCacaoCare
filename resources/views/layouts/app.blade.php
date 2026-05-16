<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'SmartCacaoCare'))</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @endif

    {{-- Lucide Icons CDN --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body>
    <div class="sc-frame">
        <header class="sc-topbar" id="topbar">
            <div class="sc-brand">
                <div class="sc-mark">
                    <i data-lucide="leaf" style="width:20px;height:20px;color:#fff"></i>
                </div>
                <div>
                    <div>SmartCacaoCare</div>
                    <small>Sistem analisis mutu kakao</small>
                </div>
            </div>

            @hasSection('nav')
                @yield('nav')
            @else
                <nav class="sc-nav" id="main-nav">
                    <a href="#about"><i data-lucide="info" style="width:14px;height:14px"></i> About</a>
                    <a href="#services"><i data-lucide="grid-3x3" style="width:14px;height:14px"></i> Services</a>
                    <a href="#contact"><i data-lucide="mail" style="width:14px;height:14px"></i> Contacts</a>
                </nav>
            @endif

            <button class="sc-menu-toggle" onclick="document.getElementById('topbar').classList.toggle('open')" aria-label="Menu">
                <i data-lucide="menu" style="width:20px;height:20px"></i>
            </button>

            <nav class="sc-links">
                <a class="sc-btn" href="{{ route('petani.edukasi') }}">
                    <i data-lucide="book-open" style="width:16px;height:16px"></i> Edukasi
                </a>
                @auth
                    <a class="sc-btn primary" href="{{ route('user.dashboard') }}">
                        <i data-lucide="layout-dashboard" style="width:16px;height:16px"></i> Dashboard
                    </a>
                @else
                    <a class="sc-btn primary" href="{{ route('login') }}">
                        <i data-lucide="log-in" style="width:16px;height:16px"></i> Masuk
                    </a>
                @endauth
            </nav>
        </header>

        @yield('content')

        <footer class="sc-footer">
            <span><i data-lucide="leaf" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> SmartCacaoCare</span>
            <span>Warm minimal UI for cocoa quality support</span>
        </footer>
    </div>

    <script>lucide.createIcons();</script>
    @stack('scripts')
</body>
</html>
