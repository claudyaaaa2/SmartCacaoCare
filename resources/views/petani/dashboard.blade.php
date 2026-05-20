@extends('layouts.app')
@section('title', 'Dashboard Petani - SmartCacaoCare')

@section('nav')
<nav class="hidden md:flex items-center gap-6 text-body font-medium">
    <a href="{{ route('petani.analysis') }}" class="text-ink hover:text-action-blue transition-colors flex items-center gap-2"><i data-lucide="search" class="w-4 h-4"></i> Analisis</a>
    <a href="{{ route('mainpage.edukasi') }}" class="text-coral hover:text-coral-soft transition-colors flex items-center gap-2"><i data-lucide="book-open" class="w-4 h-4"></i> Edukasi</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-muted hover:text-error transition-colors flex items-center gap-2"><i data-lucide="log-out" class="w-4 h-4"></i> Keluar</a>
</nav>
@endsection

@section('content')
<div class="max-w-[1200px] mx-auto px-[24px] py-[80px]">
    <div class="mb-[64px]">
        <div class="flex items-center gap-2 mb-4">
            <span class="blog-filter-chip"><i data-lucide="layout-dashboard" class="w-4 h-4 mr-2"></i> Dashboard</span>
        </div>
        <h1 class="text-section-display mb-4 text-ink">Selamat datang kembali.</h1>
        <p class="text-body-large text-muted max-w-[600px]">Pantau alur mutu kakao dari satu halaman. Analisis, baca grade, lalu buka edukasi yang relevan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Stats cards --}}
        <div class="agent-console-card flex flex-col justify-between min-h-[200px]">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="database" class="w-4 h-4"></i> DATA KRITERIA</div>
            <div>
                <div class="text-[48px] font-display font-medium leading-none mb-2">{{ $criteriaCount }}</div>
                <div class="text-caption text-muted">Kriteria yang dinilai dalam setiap analisis mutu biji kakao.</div>
            </div>
        </div>

        <div class="product-card flex flex-col justify-between min-h-[200px] border border-border-light">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="star" class="w-4 h-4 text-coral"></i> GRADE REFERENSI</div>
            <div>
                <div class="text-[48px] font-display font-medium leading-none mb-2 text-ink">{{ $gradeCount }}</div>
                <div class="text-caption text-muted">Jumlah grade yang menjadi acuan penilaian kualitas.</div>
            </div>
        </div>

        <div class="product-card flex flex-col justify-between min-h-[200px] border border-border-light">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="settings" class="w-4 h-4 text-action-blue"></i> PARAMETER</div>
            <div>
                <div class="text-card-heading mb-2 text-ink">{{ implode(' · ', $fieldLabels) }}</div>
                <div class="text-caption text-muted">Parameter utama yang digunakan dalam perhitungan.</div>
            </div>
        </div>

        {{-- Workflow card --}}
        <div class="lg:col-span-2 capability-card bg-canvas border border-card-border p-[32px] rounded-lg">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-6"><i data-lucide="route" class="w-4 h-4 text-primary"></i> LANGKAH KERJA</div>
            <h3 class="text-card-heading text-ink mb-2">Alur analisis mutu kakao</h3>
            <p class="text-body text-muted mb-8 max-w-[500px]">Pakai alur singkat ini saat ingin cek mutu batch kakao.</p>
            <ul class="flex flex-col gap-4">
                <li class="flex items-start gap-4 p-4 rounded-xs hover:bg-soft-stone transition-colors border border-hairline">
                    <i data-lucide="clipboard-check" class="w-6 h-6 text-action-blue flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="block text-body font-medium text-ink">Pilih Kondisi</strong>
                        <span class="text-caption text-muted">Masuk ke halaman analisis dan tentukan kondisi tiap kriteria.</span>
                    </div>
                </li>
                <li class="flex items-start gap-4 p-4 rounded-xs hover:bg-soft-stone transition-colors border border-hairline">
                    <i data-lucide="trophy" class="w-6 h-6 text-coral flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="block text-body font-medium text-ink">Bandingkan Hasil</strong>
                        <span class="text-caption text-muted">Lihat grade tertinggi, lalu bandingkan seluruh ranking kepastian.</span>
                    </div>
                </li>
                <li class="flex items-start gap-4 p-4 rounded-xs hover:bg-soft-stone transition-colors border border-hairline">
                    <i data-lucide="book-open" class="w-6 h-6 text-coral flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="block text-body font-medium text-ink">Tindak Lanjut</strong>
                        <span class="text-caption text-muted">Buka edukasi untuk perbaikan pasca panen jika diperlukan.</span>
                    </div>
                </li>
            </ul>
        </div>

        {{-- Quick actions & Focus --}}
        <div class="flex flex-col gap-6">
            <div class="bg-deep-green text-on-dark p-[32px] rounded-lg border border-ink shadow-xl relative overflow-hidden flex-1 flex flex-col justify-center">
                <div class="absolute top-0 right-0 w-[150px] h-[150px] bg-action-blue opacity-20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
                <div class="text-mono-label text-muted flex items-center gap-2 mb-4 relative z-10"><i data-lucide="zap" class="w-4 h-4 text-action-blue"></i> AKSI CEPAT</div>
                <ul class="flex flex-col gap-3 relative z-10">
                    <li><a href="{{ route('petani.analysis') }}" class="flex items-center gap-3 text-body font-medium hover:text-action-blue transition-colors"><i data-lucide="arrow-right" class="w-4 h-4"></i> Buka Analisis</a></li>
                    <li><a href="{{ route('mainpage.edukasi') }}" class="flex items-center gap-3 text-body font-medium text-coral hover:text-coral-soft transition-colors"><i data-lucide="arrow-right" class="w-4 h-4"></i> Buka Edukasi</a></li>
                </ul>
            </div>
            
            <div class="product-card min-h-[160px] border border-border-light">
                <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="target" class="w-4 h-4 text-coral"></i> FOKUS HARI INI</div>
                <ul class="flex flex-col gap-2 text-body">
                    <li class="flex items-center gap-2"><div class="w-1.5 h-1.5 bg-primary rounded-full"></div> Warna biji</li>
                    <li class="flex items-center gap-2"><div class="w-1.5 h-1.5 bg-primary rounded-full"></div> Ukuran keseragaman</li>
                    <li class="flex items-center gap-2"><div class="w-1.5 h-1.5 bg-primary rounded-full"></div> Aroma & tekstur</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
@endsection
