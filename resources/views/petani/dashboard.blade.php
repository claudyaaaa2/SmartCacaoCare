@extends('layouts.farmer')
@section('title', 'Dashboard Petani - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto">
    {{-- Left-Aligned Stacked Editorial Header --}}
    <div class="mb-12 pb-8 border-b border-hairline">
        <div class="flex items-center gap-2 mb-3">
            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[10px] py-[4px] border border-coral-soft">
                <i data-lucide="layout-dashboard" class="w-3.5 h-3.5 mr-1.5"></i> Dashboard Console
            </span>
        </div>
        <h1 class="text-section-display font-medium text-ink mb-3">Selamat datang kembali.</h1>
        <p class="text-body-large text-muted max-w-[720px] mb-8">Pantau alur mutu kakao dari satu halaman. Analisis kriteria fisik biji kakao Anda, baca grade mutunya secara presisi, lalu buka panduan penanganan pasca panen yang relevan.</p>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('petani.analysis') }}" class="btn-primary flex items-center justify-center gap-2 text-body">
                <i data-lucide="search" class="w-4 h-4"></i> Mulai Analisis Baru
            </a>
            <a href="{{ route('mainpage.edukasi') }}" class="btn-pill-outline flex items-center justify-center gap-2 text-body py-2.5 px-5">
                <i data-lucide="book-open" class="w-4 h-4"></i> Jelajahi Pustaka Edukasi
            </a>
        </div>
    </div>

    {{-- Unframed Technical Metrics Section --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-0 border border-hairline bg-canvas rounded-lg overflow-hidden mb-16 shadow-[0_8px_32px_rgba(0,0,0,0.01)]">
        
        {{-- Metric 1: Total Analisis Anda --}}
        <div class="p-8 border-b xl:border-b-0 xl:border-r border-hairline flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
            <div class="text-mono-label text-muted flex items-center gap-2"><span class="text-coral">01 /</span> TOTAL ANALISIS ANDA</div>
            <div class="mt-4">
                <div class="text-[64px] font-display font-normal leading-none mb-2 text-coral tracking-tighter">{{ $totalAnalisis }}</div>
                <div class="text-caption text-muted">Batch biji kakao yang telah Anda analisis mutunya.</div>
            </div>
        </div>

        {{-- Metric 2: Grade Referensi --}}
        <div class="p-8 border-b xl:border-b-0 xl:border-r border-hairline flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
            <div class="text-mono-label text-muted flex items-center gap-2"><span>02 /</span> GRADE REFERENSI</div>
            <div class="mt-4">
                <div class="text-[64px] font-display font-normal leading-none mb-2 text-ink tracking-tighter">{{ $gradeCount }}</div>
                <div class="text-caption text-muted">Jumlah grade referensi acuan standar mutu kakao.</div>
            </div>
        </div>

        {{-- Metric 3: Parameter --}}
        <div class="p-8 flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
            <div class="text-mono-label text-muted flex items-center gap-2"><span>03 /</span> PARAMETER UTAMA</div>
            <div class="mt-4">
                <div class="text-feature-heading font-medium text-ink leading-tight mb-2 truncate" title="{{ implode(' · ', $fieldLabels) }}">
                    {{ implode(' · ', $fieldLabels) }}
                </div>
                <div class="text-caption text-muted">Faktor penentu karakteristik fisik biji kakao.</div>
            </div>
        </div>

    </div>

    {{-- Two-Column asymmetric layout --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
        
        {{-- Left Column (65%): Riwayat Analisis Terbaru (Research-Table style) --}}
        <div class="xl:col-span-2 flex flex-col gap-6">
            <div class="flex justify-between items-center pb-4 border-b border-hairline">
                <h2 class="text-card-heading text-ink font-medium flex items-center gap-2.5">
                    <i data-lucide="history" class="w-5.5 h-5.5 text-coral"></i> Analisis Terbaru Anda
                </h2>
                @if($riwayatTerbaru->count())
                    <a href="{{ route('user.riwayat') }}" class="text-caption text-action-blue hover:underline font-medium flex items-center gap-1">
                        Lihat Semua Riwayat <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                @endif
            </div>

            @if($riwayatTerbaru->count())
                <div class="flex flex-col">
                    @foreach($riwayatTerbaru as $item)
                    @php
                        $gradeColors = [
                            'A' => 'text-green-700 bg-green-50 border-green-200',
                            'B' => 'text-blue-700 bg-blue-50 border-blue-200',
                            'C' => 'text-amber-700 bg-amber-50 border-amber-200',
                            'D' => 'text-red-700 bg-red-50 border-red-200',
                        ];
                        $color = $gradeColors[$item->grade_hasil] ?? 'text-slate bg-soft-stone border-border-light';
                    @endphp
                    
                    {{-- Row-based rule separated item --}}
                    <div class="py-5 border-b border-hairline flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:px-2 hover:bg-soft-stone/20 rounded-xs transition-all">
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-caption font-medium border {{ $color }}">
                                    Grade {{ $item->grade_hasil }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-caption font-medium border border-border-light bg-soft-stone/40 text-ink">
                                    {{ number_format($item->persentase_cf, 1) }}% keyakinan
                                </span>
                            </div>
                            <p class="text-caption text-muted max-w-[450px] line-clamp-1" title="{{ $item->rekomendasi }}">
                                {{ $item->rekomendasi }}
                            </p>
                        </div>
                        <div class="text-left sm:text-right flex-shrink-0">
                            <div class="text-caption text-ink font-medium">{{ $item->created_at->format('d M Y') }}</div>
                            <div class="text-micro text-muted mt-0.5">{{ $item->created_at->format('H:i') }} WIB</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-canvas border border-card-border p-12 text-center rounded-lg shadow-sm flex flex-col items-center justify-center min-h-[250px]">
                    <i data-lucide="inbox" class="w-12 h-12 text-muted mb-4"></i>
                    <h3 class="text-body-large text-ink font-medium mb-1">Belum ada riwayat</h3>
                    <p class="text-caption text-muted mb-6 max-w-[320px]">Data analisis mutu kakao Anda akan tersimpan di sini secara otomatis.</p>
                    <a href="{{ route('petani.analysis') }}" class="btn-pill-outline border-border-light hover:bg-soft-stone text-ink py-2 px-5 text-body">
                        Mulai Analisis Pertama <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                    </a>
                </div>
            @endif
        </div>

        {{-- Right Column (35%): Langkah Kerja & Fokus (Timeline Style) --}}
        <div class="flex flex-col gap-8">
            
            {{-- Langkah Kerja Widget --}}
            <div class="contact-form-card p-8 bg-canvas">
                <h3 class="text-feature-heading text-ink font-medium mb-6 flex items-center gap-2">
                    <i data-lucide="route" class="w-5 h-5 text-coral"></i> Langkah Kerja
                </h3>
                <ul class="flex flex-col gap-6 pl-4 border-l border-hairline">
                    <li class="relative">
                        <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-coral rounded-full ring-4 ring-coral/20"></div>
                        <div class="pl-2">
                            <span class="text-mono-label text-micro text-coral">Langkah 01</span>
                            <strong class="block text-body font-medium text-ink mt-0.5">Pilih Kondisi Kriteria</strong>
                            <span class="text-caption text-muted mt-1 block">Tentukan kondisi visual, tekstur, dan aroma batch biji kakao Anda.</span>
                        </div>
                    </li>
                    <li class="relative">
                        <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-ink rounded-full ring-4 ring-ink/10"></div>
                        <div class="pl-2">
                            <span class="text-mono-label text-micro text-muted">Langkah 02</span>
                            <strong class="block text-body font-medium text-ink mt-0.5">Evaluasi Certainty Factor</strong>
                            <span class="text-caption text-muted mt-1 block">Sistem menghitung kecocokan evidence dengan parameter grade.</span>
                        </div>
                    </li>
                    <li class="relative">
                        <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-ink rounded-full ring-4 ring-ink/10"></div>
                        <div class="pl-2">
                            <span class="text-mono-label text-micro text-muted">Langkah 03</span>
                            <strong class="block text-body font-medium text-ink mt-0.5">Rekomendasi Tindak Lanjut</strong>
                            <span class="text-caption text-muted mt-1 block">Lihat saran penanganan pasca panen dan edukasi perbaikan batch.</span>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Fokus Hari Ini Widget --}}
            <div class="p-8 rounded-lg border border-border-light bg-soft-stone/40">
                <h3 class="text-feature-heading text-ink font-medium mb-4 flex items-center gap-2">
                    <i data-lucide="target" class="w-5 h-5 text-coral"></i> Fokus Hari Ini
                </h3>
                <p class="text-caption text-muted mb-6">Parameter penting yang perlu diperhatikan dalam penyortiran biji kakao saat ini:</p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3 py-2 border-b border-hairline/60">
                        <i data-lucide="check" class="w-4 h-4 text-coral flex-shrink-0"></i>
                        <span class="text-body text-ink">Proses Fermentasi (Aroma Coklat Khas)</span>
                    </div>
                    <div class="flex items-center gap-3 py-2 border-b border-hairline/60">
                        <i data-lucide="check" class="w-4 h-4 text-coral flex-shrink-0"></i>
                        <span class="text-body text-ink">Proses Pengeringan (Kekerasan Tekstur)</span>
                    </div>
                    <div class="flex items-center gap-3 py-2">
                        <i data-lucide="check" class="w-4 h-4 text-coral flex-shrink-0"></i>
                        <span class="text-body text-ink">Kebersihan Biji (Kondisi Bebas Jamur)</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
