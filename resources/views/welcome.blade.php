@extends('layouts.app')
@section('title', 'SmartCacaoCare — Analisis Mutu Kakao')

@section('content')
    {{-- ═══ CINEMATIC DARK HERO ═══ --}}
    <section class="landing-hero">
        <div class="hero-text">
            <span class="sc-brandline" style="background:rgba(255,255,255,.06);color:rgba(255,255,255,.7)"><i data-lucide="leaf" style="width:14px;height:14px"></i> SmartCacaoCare</span>
            <h1>Precision meets<br>simplicity.</h1>
            <p class="sc-lead">Platform analisis mutu kakao untuk petani modern. Baca kondisi lapangan, nilai grade, ambil keputusan — semua dalam satu alur yang tenang.</p>
            <div class="sc-cta">
                <a href="{{ route('petani.index') }}" class="sc-btn primary"><i data-lucide="arrow-right" style="width:16px;height:16px"></i> Mulai Analisis</a>
                <a href="{{ route('petani.edukasi') }}" class="sc-btn"><i data-lucide="book-open" style="width:16px;height:16px"></i> Pelajari Kakao</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="sc-side-card" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08)">
                <span style="color:rgba(255,255,255,.5)"><i data-lucide="palette" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Desain visual</span>
                <strong style="color:#fff">Warm, minimal, editorial — terasa seperti alat kerja sungguhan.</strong>
            </div>
            <div class="sc-side-card" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08)">
                <span style="color:rgba(255,255,255,.5)"><i data-lucide="compass" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Fokus utama</span>
                <strong style="color:#fff">Analisis cepat, hasil mudah dibaca, langkah selanjutnya jelas.</strong>
            </div>
        </div>
    </section>

    {{-- ═══ STATS STRIP ═══ --}}
    <div class="landing-stats">
        <div class="l-stat"><strong>4+</strong><span>Kriteria Analisis</span></div>
        <div class="l-stat"><strong>3</strong><span>Grade Referensi</span></div>
        <div class="l-stat"><strong>CF</strong><span>Certainty Factor</span></div>
        <div class="l-stat"><strong>1 tap</strong><span>Alur Keputusan</span></div>
    </div>

    {{-- ═══ BENTO FEATURES ═══ --}}
    <section class="landing-features">
        <div class="feat-card dark tall">
            <div>
                <div class="feat-icon"><i data-lucide="search" style="width:22px;height:22px"></i></div>
                <h3>Analisis profesional</h3>
                <p>Masuk ke form, pilih kondisi tiap kriteria, lalu dapatkan grade utama beserta ranking keyakinan secara real-time.</p>
            </div>
            <div class="feat-visual" style="background:rgba(255,255,255,.04)">
                <div style="display:flex;justify-content:space-between;font-size:13px;color:rgba(255,255,255,.5);margin-bottom:8px"><span>Grade A</span><strong style="color:#fff">87.4%</strong></div>
                <div class="bar" style="background:rgba(255,255,255,.1)"><span style="width:87%"></span></div>
                <div style="display:flex;justify-content:space-between;font-size:13px;color:rgba(255,255,255,.5);margin-top:12px"><span>Grade B</span><strong style="color:#fff">62.1%</strong></div>
                <div class="bar" style="background:rgba(255,255,255,.1)"><span style="width:62%"></span></div>
            </div>
        </div>
        <div class="feat-card wide">
            <div class="feat-icon"><i data-lucide="graduation-cap" style="width:22px;height:22px"></i></div>
            <h3>Edukasi terarah</h3>
            <p>Referensi budidaya dan pasca panen yang membantu petani menjaga mutu kakao tetap konsisten. Seperti guidebook ringan yang selalu siap diakses.</p>
        </div>
        <div class="feat-card">
            <div class="feat-icon"><i data-lucide="gauge" style="width:22px;height:22px"></i></div>
            <h3>Dashboard terpadu</h3>
            <p>Pantau alur mutu kakao dari satu halaman: analisis, baca grade, lalu buka edukasi yang relevan.</p>
        </div>
        <div class="feat-card">
            <div class="feat-icon"><i data-lucide="layers" style="width:22px;height:22px"></i></div>
            <h3>Layout profesional</h3>
            <p>Interface yang tenang dan berlapis. Setiap informasi punya tempat yang jelas tanpa kebisingan visual.</p>
        </div>
    </section>

    {{-- ═══ CTA BANNER ═══ --}}
    <section class="landing-cta">
        <h2>Mulai analisis<br>pertama Anda.</h2>
        <p>Bergabung dengan petani kakao yang sudah menggunakan SmartCacaoCare untuk keputusan lapangan yang lebih cepat dan akurat.</p>
        <div class="sc-cta" style="justify-content:center">
            <a href="{{ route('petani.index') }}" class="sc-btn primary"><i data-lucide="arrow-right" style="width:16px;height:16px"></i> Mulai Sekarang</a>
            @guest
                <a href="{{ route('register') }}" class="sc-btn" style="color:rgba(255,255,255,.7);border-color:rgba(255,255,255,.2)"><i data-lucide="user-plus" style="width:16px;height:16px"></i> Daftar Gratis</a>
            @endguest
        </div>
    </section>
@endsection
