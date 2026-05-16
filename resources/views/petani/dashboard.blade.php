@extends('layouts.app')
@section('title', 'Dashboard Petani - SmartCacaoCare')

@section('nav')
<nav class="sc-nav" id="main-nav">
    <a href="{{ route('petani.analysis') }}"><i data-lucide="search" style="width:14px;height:14px"></i> Analisis</a>
    <a href="{{ route('petani.edukasi') }}"><i data-lucide="book-open" style="width:14px;height:14px"></i> Edukasi</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-lucide="log-out" style="width:14px;height:14px"></i> Keluar</a>
</nav>
@endsection

@section('content')
    <section class="sc-hero">
        <div class="sc-panel sc-hero-main">
            <span class="sc-brandline"><i data-lucide="layout-dashboard" style="width:14px;height:14px"></i> Dashboard Petani</span>
            <h1>Mulai dari lot, bukan dari asumsi.</h1>
            <p class="sc-lead">Pantau alur mutu kakao dari satu halaman: analisis, baca grade, lalu buka edukasi yang relevan.</p>
        </div>
        <aside class="sc-panel sc-side">
            <span class="sc-brandline"><i data-lucide="bar-chart-2" style="width:14px;height:14px"></i> Ringkasan</span>
            <div class="stats">
                <div class="stat"><span><i data-lucide="list-checks" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Kriteria yang dinilai</span><strong>{{ $criteriaCount }}</strong></div>
                <div class="stat"><span><i data-lucide="award" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Grade referensi</span><strong>{{ $gradeCount }}</strong></div>
                <div class="stat"><span><i data-lucide="sliders" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Parameter utama</span><strong>{{ implode(' · ', $fieldLabels) }}</strong></div>
            </div>
        </aside>
    </section>

    <section class="sc-grid">
        <article class="sc-card">
            <h2><i data-lucide="footprints" style="width:18px;height:18px;display:inline;vertical-align:middle"></i> Langkah kerja</h2>
            <p class="meta">Pakai alur singkat ini saat ingin cek mutu batch kakao.</p>
            <ul class="list">
                <li><i data-lucide="clipboard-check" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Masuk ke halaman analisis dan pilih kondisi tiap kriteria.</li>
                <li><i data-lucide="trophy" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Lihat grade tertinggi, lalu bandingkan seluruh ranking.</li>
                <li><i data-lucide="book-open" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Buka edukasi untuk tindak lanjut pasca panen.</li>
            </ul>
        </article>
        <article class="sc-card">
            <h2><i data-lucide="focus" style="width:18px;height:18px;display:inline;vertical-align:middle"></i> Fokus hari ini</h2>
            <p class="meta">Gunakan untuk mengingat hal yang paling penting.</p>
            <ul class="list">
                <li><i data-lucide="palette" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Warna biji</li>
                <li><i data-lucide="ruler" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Ukuran dan keseragaman</li>
                <li><i data-lucide="wind" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Aroma, tekstur, dan fisik biji</li>
            </ul>
        </article>
        <article class="sc-card">
            <h2><i data-lucide="zap" style="width:18px;height:18px;display:inline;vertical-align:middle"></i> Aksi cepat</h2>
            <p class="meta">Langsung lompat ke halaman yang dibutuhkan.</p>
            <ul class="list">
                <li><a href="{{ route('petani.analysis') }}"><i data-lucide="search" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Buka analisis</a></li>
                <li><a href="{{ route('petani.edukasi') }}"><i data-lucide="book-open" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Buka edukasi</a></li>
                <li><a href="{{ url('/') }}"><i data-lucide="home" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Kembali ke beranda</a></li>
            </ul>
        </article>
    </section>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
@endsection
