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
    <div class="dash-welcome">
        <span class="sc-brandline"><i data-lucide="layout-dashboard" style="width:14px;height:14px"></i> Dashboard</span>
        <h1>Selamat datang kembali.</h1>
        <p>Pantau alur mutu kakao dari satu halaman. Analisis, baca grade, lalu buka edukasi yang relevan.</p>
    </div>

    <div class="bento">
        {{-- Stats cards --}}
        <div class="bento-card dark">
            <div class="bento-icon"><i data-lucide="list-checks" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="database" style="width:11px;height:11px"></i> DATA KRITERIA</div>
            <div class="bento-value">{{ $criteriaCount }}</div>
            <div class="bento-desc">Kriteria yang dinilai dalam setiap analisis mutu biji kakao.</div>
        </div>

        <div class="bento-card">
            <div class="bento-icon"><i data-lucide="award" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="star" style="width:11px;height:11px"></i> GRADE REFERENSI</div>
            <div class="bento-value">{{ $gradeCount }}</div>
            <div class="bento-desc">Jumlah grade yang menjadi acuan penilaian kualitas.</div>
        </div>

        <div class="bento-card">
            <div class="bento-icon"><i data-lucide="sliders" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="settings" style="width:11px;height:11px"></i> PARAMETER</div>
            <div class="bento-title">{{ implode(' · ', $fieldLabels) }}</div>
            <div class="bento-desc">Parameter utama yang digunakan dalam perhitungan.</div>
        </div>

        {{-- Workflow card --}}
        <div class="bento-card span-2">
            <div class="bento-icon"><i data-lucide="footprints" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="route" style="width:11px;height:11px"></i> LANGKAH KERJA</div>
            <div class="bento-title">Alur analisis mutu kakao</div>
            <div class="bento-desc">Pakai alur singkat ini saat ingin cek mutu batch kakao.</div>
            <ul class="bento-list">
                <li><i data-lucide="clipboard-check" style="width:16px;height:16px;color:var(--apple-blue);flex-shrink:0"></i> Masuk ke halaman analisis dan pilih kondisi tiap kriteria.</li>
                <li><i data-lucide="trophy" style="width:16px;height:16px;color:var(--apple-blue);flex-shrink:0"></i> Lihat grade tertinggi, lalu bandingkan seluruh ranking.</li>
                <li><i data-lucide="book-open" style="width:16px;height:16px;color:var(--apple-blue);flex-shrink:0"></i> Buka edukasi untuk tindak lanjut pasca panen.</li>
            </ul>
        </div>

        {{-- Focus card --}}
        <div class="bento-card">
            <div class="bento-icon"><i data-lucide="focus" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="target" style="width:11px;height:11px"></i> FOKUS HARI INI</div>
            <div class="bento-title">Perhatikan hal ini</div>
            <ul class="bento-list">
                <li><i data-lucide="palette" style="width:16px;height:16px;color:var(--apple-blue);flex-shrink:0"></i> Warna biji</li>
                <li><i data-lucide="ruler" style="width:16px;height:16px;color:var(--apple-blue);flex-shrink:0"></i> Ukuran dan keseragaman</li>
                <li><i data-lucide="wind" style="width:16px;height:16px;color:var(--apple-blue);flex-shrink:0"></i> Aroma, tekstur, fisik</li>
            </ul>
        </div>

        {{-- Quick actions --}}
        <div class="bento-card blue span-2">
            <div class="bento-icon"><i data-lucide="zap" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="mouse-pointer-click" style="width:11px;height:11px"></i> AKSI CEPAT</div>
            <div class="bento-title">Langsung lompat ke halaman yang dibutuhkan</div>
            <ul class="bento-list">
                <li><a href="{{ route('petani.analysis') }}"><i data-lucide="search" style="width:16px;height:16px;flex-shrink:0"></i> Buka analisis mutu kakao</a></li>
                <li><a href="{{ route('petani.edukasi') }}"><i data-lucide="book-open" style="width:16px;height:16px;flex-shrink:0"></i> Buka edukasi dan referensi</a></li>
                <li><a href="{{ url('/') }}"><i data-lucide="home" style="width:16px;height:16px;flex-shrink:0"></i> Kembali ke halaman utama</a></li>
            </ul>
        </div>

        <div class="bento-card dark">
            <div class="bento-icon"><i data-lucide="shield-check" style="width:20px;height:20px"></i></div>
            <div class="bento-label"><i data-lucide="info" style="width:11px;height:11px"></i> STATUS</div>
            <div class="bento-title">Sistem aktif</div>
            <div class="bento-desc">Semua fitur analisis dan edukasi berjalan normal. Siap digunakan kapan saja.</div>
        </div>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
@endsection
