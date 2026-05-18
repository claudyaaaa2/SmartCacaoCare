@extends('layouts.app')
@section('title', 'SmartCacaoCare — Analisis Mutu Kakao')

@section('content')
    {{-- HERO SECTION --}}
    <section class="max-w-[1200px] mx-auto px-[24px] pt-[120px] pb-[80px]">
        <div class="text-center max-w-[900px] mx-auto mb-[64px]">
            <h1 class="text-hero-display mb-6 text-ink">Precision meets<br>simplicity.</h1>
            <p class="text-body-large text-body-muted max-w-[600px] mx-auto mb-10">Platform analisis mutu kakao untuk petani modern. Baca kondisi lapangan, nilai grade, ambil keputusan — semua dalam satu alur yang tenang.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('petani.index') }}" class="btn-primary">Mulai Analisis <i data-lucide="arrow-right" class="ml-2 w-4 h-4"></i></a>
                <a href="{{ route('petani.edukasi') }}" class="text-coral font-medium flex items-center gap-1.5 hover:underline transition-colors"><i data-lucide="book-open" class="w-5 h-5"></i> Pelajari Kakao</a>
            </div>
        </div>
        
        {{-- Hero Media Split --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 agent-console-card min-h-[400px] flex flex-col justify-between border border-cohere-black shadow-xl">
                <div class="flex items-center gap-2 mb-8">
                    <div class="w-3 h-3 rounded-full bg-coral"></div>
                    <div class="w-3 h-3 rounded-full bg-action-blue"></div>
                    <span class="text-mono-label text-muted ml-2">ANALYSIS_CONSOLE</span>
                </div>
                <div>
                    <h3 class="text-card-heading text-on-dark mb-4">Real-time certainty factor calculation.</h3>
                    <div class="bg-cohere-black p-6 rounded-xs border border-ink font-mono text-[14px] text-muted leading-loose">
                        > analyzing sample metrics...<br>
                        > humidity: 12%<br>
                        > mold_presence: low<br>
                        <span class="text-action-blue">> RESULT: GRADE A (87.4% CONFIDENCE)</span>
                    </div>
                </div>
            </div>
            <div class="hero-photo-card bg-soft-stone min-h-[400px] p-[32px] flex flex-col justify-end">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-auto shadow-sm">
                    <i data-lucide="palette" class="w-6 h-6 text-primary"></i>
                </div>
                <span class="text-caption text-ink font-medium uppercase tracking-widest mt-8">Desain Visual</span>
                <p class="text-body-large mt-2 text-ink">Warm, minimal, editorial — terasa seperti alat kerja sungguhan.</p>
            </div>
        </div>
    </section>

    {{-- TRUST LOGO STRIP (Stats) --}}
    <section class="trust-logo-strip border-t border-hairline mt-[40px]">
        <span class="text-mono-label text-muted">SYSTEM CAPABILITIES</span>
        <div class="flex flex-wrap items-center justify-center gap-[64px] md:gap-[120px] w-full max-w-[1000px]">
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">4+</span><span class="text-caption text-muted">Kriteria Analisis</span></div>
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">3</span><span class="text-caption text-muted">Grade Referensi</span></div>
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">CF</span><span class="text-caption text-muted">Certainty Factor</span></div>
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">1</span><span class="text-caption text-muted">Alur Keputusan</span></div>
        </div>
    </section>

    {{-- DARK FEATURE BAND --}}
    <section class="dark-feature-band">
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-[80px] items-center">
            <div>
                <h2 class="text-section-display mb-6">Analisis profesional,<br>langsung di lapangan.</h2>
                <p class="text-body-large text-slate mb-8 max-w-[440px]">Masuk ke form, pilih kondisi tiap kriteria, lalu dapatkan grade utama beserta ranking keyakinan secara real-time. Tidak ada kebisingan visual, hanya data yang Anda butuhkan.</p>
                <ul class="flex flex-col gap-5">
                    <li class="flex items-center gap-3 text-body-large text-on-dark"><i data-lucide="check" class="text-coral"></i> Dashboard terpadu</li>
                    <li class="flex items-center gap-3 text-body-large text-on-dark"><i data-lucide="check" class="text-coral"></i> Edukasi terarah</li>
                    <li class="flex items-center gap-3 text-body-large text-on-dark"><i data-lucide="check" class="text-coral"></i> Layout profesional</li>
                </ul>
            </div>
            <div class="bg-primary p-[40px] rounded-lg border border-ink shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[200px] h-[200px] bg-action-blue opacity-10 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
                <div class="flex justify-between text-caption text-muted mb-3 relative z-10"><span>Grade A</span><strong class="text-white">87.4%</strong></div>
                <div class="h-3 rounded-full bg-ink overflow-hidden mb-8 relative z-10"><div class="h-full bg-action-blue w-[87%]"></div></div>
                <div class="flex justify-between text-caption text-muted mb-3 relative z-10"><span>Grade B</span><strong class="text-white">62.1%</strong></div>
                <div class="h-3 rounded-full bg-ink overflow-hidden relative z-10"><div class="h-full bg-coral w-[62%]"></div></div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-[800px] mx-auto text-center py-[120px] px-[24px]">
        <h2 class="text-section-display mb-6 text-ink">Mulai analisis<br>pertama Anda.</h2>
        <p class="text-body-large text-body-muted mb-10 max-w-[500px] mx-auto">Bergabung dengan petani kakao yang sudah menggunakan SmartCacaoCare untuk keputusan lapangan yang lebih cepat dan akurat.</p>
        <div class="flex items-center justify-center gap-6">
            <a href="{{ route('petani.index') }}" class="btn-primary">Mulai Sekarang</a>
            @guest
                <a href="{{ route('register') }}" class="btn-secondary">Daftar Gratis</a>
            @endguest
        </div>
    </section>
@endsection
