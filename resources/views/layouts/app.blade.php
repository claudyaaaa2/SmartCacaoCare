<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SmartCacaoCare') }}</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @endif
</head>
<body>
    <div class="sc-frame">
        <header class="sc-topbar">
            <div class="sc-brand">
                <div class="sc-mark"></div>
                <div>
                    <div>SmartCacaoCare</div>
                    <small>Sistem analisis mutu kakao</small>
                </div>
            </div>
            <nav class="sc-nav">
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#numbers">Numbers</a>
                <a href="#contact">Contacts</a>
            </nav>
            <nav class="sc-links">
                <a class="sc-btn" href="{{ route('petani.edukasi') }}">Edukasi</a>
                @auth
                    <a class="sc-btn primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                @else
                    <a class="sc-btn primary" href="{{ route('login') }}">Masuk</a>
                @endauth
            </nav>
        </header>

        @yield('content')

        <div class="footerbar">
            <span>SmartCacaoCare</span>
            <span>Warm minimal UI for cocoa quality support</span>
        </div>
    </div>
</body>
</html>
