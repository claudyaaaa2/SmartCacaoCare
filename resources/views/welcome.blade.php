@extends('layouts.app')
@section('bodyClass','page-landing')
@section('title', 'SmartCacaoCare - Analisis Mutu Kakao')

@section('content')
    {{-- PROMO EDUKASI HEADER - two-column hero --}}
    <section id="about" class="w-full">
        <div class="w-full mx-0 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-1/2 w-full h-[560px] lg:h-[720px] relative bg-cover bg-center" style="background-image:url('{{ asset('cacao.jpg') }}')">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
                </div>

                <div class="lg:w-1/2 w-full bg-white p-8 md:p-16 flex items-center">
                    <div class="max-w-[640px] mx-auto">
                        <h1 class="text-hero-display mb-4 text-ink">Edukasi SmartCacaoCare</h1>
                        <p class="text-body-large text-body-muted mb-6">Pelatihan singkat, panduan lapangan, dan video praktis untuk membantu petani meningkatkan mutu kakao dengan SmartCacaoCare — gratis dan mudah diikuti.</p>

                        <div class="flex flex-wrap items-center gap-4 mb-6">
                            <a href="{{ route('mainpage.edukasi') }}" class="btn-primary">Jelajahi Edukasi <i data-lucide="arrow-right" class="ml-2 w-4 h-4"></i></a>
                            <a href="{{ route('petani.index') }}" class="btn-pill-outline flex items-center gap-2"><i data-lucide="play" class="w-4 h-4"></i> Coba Analisis</a>
                        </div>

                        <div class="flex gap-6 flex-wrap">
                            <div class="text-center">
                                <div class="text-[44px] font-display text-ink">Materi</div>
                                <div class="text-caption text-muted">Panduan & Video</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[44px] font-display text-ink">Praktis</div>
                                <div class="text-caption text-muted">Langkah demi langkah</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[44px] font-display text-ink">Gratis</div>
                                <div class="text-caption text-muted">Untuk petani</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Video Modal --}}
    <div id="video-modal" class="fixed inset-0 z-60 hidden items-center justify-center bg-black/60 p-6">
        <div class="max-w-[900px] w-full bg-white rounded-lg overflow-hidden">
            <div class="flex justify-end p-3"><button id="video-modal-close" class="text-muted">Close</button></div>
            <div class="aspect-video bg-black">
                <iframe id="video-iframe" class="w-full h-full" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    {{-- EDUKASI SINGKAT - Landing cards to highlight learning content --}}
    <section id="edu" class="w-full px-[24px] py-[64px]">
        <div class="text-center mb-[40px]">
            <h2 class="text-section-display mb-4">Edukasi Singkat untuk Petani</h2>
            <p class="text-body text-muted max-w-[720px] mx-auto">Pelajari langkah-langkah praktis untuk meningkatkan mutu kakao Anda — dari panen hingga penyimpanan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('mainpage.edukasi') }}" class="capability-card hover:scale-[1.02] transition-transform">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-coral flex items-center justify-center text-on-primary"><i data-lucide="book-open" class="w-5 h-5"></i></div>
                    <h3 class="text-card-heading m-0">Pengenalan Grade</h3>
                </div>
                <p class="text-body text-muted mb-4">Kenali standar grade kakao, apa yang membedakan Grade A, B, dan C, dan bagaimana pengukuran dilakukan di lapangan.</p>
                <span class="text-action-blue font-medium">Baca selengkapnya →</span>
            </a>

            <a href="{{ route('mainpage.edukasi') }}" class="capability-card hover:scale-[1.02] transition-transform">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-action-blue flex items-center justify-center text-on-primary"><i data-lucide="search" class="w-5 h-5"></i></div>
                    <h3 class="text-card-heading m-0">Mendeteksi Kualitas</h3>
                </div>
                <p class="text-body text-muted mb-4">Checklist praktis untuk mendeteksi cacat biji, kelembapan, dan risiko jamur sebelum proses pengeringan.</p>
                <span class="text-action-blue font-medium">Baca selengkapnya →</span>
            </a>

            <a href="{{ route('mainpage.edukasi') }}" class="capability-card hover:scale-[1.02] transition-transform">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-deep-green flex items-center justify-center text-on-primary"><i data-lucide="leaf" class="w-5 h-5"></i></div>
                    <h3 class="text-card-heading m-0">Pemeliharaan & Panen</h3>
                </div>
                <p class="text-body text-muted mb-4">Praktik pemeliharaan pohon, waktu panen optimal, dan teknik pasca panen untuk menjaga kualitas biji.</p>
                <span class="text-action-blue font-medium">Baca selengkapnya →</span>
            </a>
        </div>
    </section>

    {{-- TRUST LOGO STRIP (Stats) --}}
    <section class="trust-logo-strip border-t border-hairline mt-[40px] w-full">
        <span class="text-mono-label text-muted">SYSTEM CAPABILITIES</span>
        <div class="flex flex-wrap items-center justify-center gap-[64px] md:gap-[120px] w-full max-w-[1000px]">
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">4+</span><span class="text-caption text-muted">Kriteria Analisis</span></div>
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">3</span><span class="text-caption text-muted">Grade Referensi</span></div>
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">CF</span><span class="text-caption text-muted">Certainty Factor</span></div>
            <div class="text-center"><span class="block text-[48px] font-display font-medium tracking-tight text-ink">1</span><span class="text-caption text-muted">Alur Keputusan</span></div>
        </div>
    </section>

    {{-- DARK FEATURE BAND --}}
    <section id="services" class="dark-feature-band">
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-[80px] items-center">
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
                <div class="flex justify-between text-caption text-muted mb-3 relative z-10"><span>Grade A</span><strong class="text-white progress-value" data-target="87.4">0%</strong></div>
                <div class="h-3 rounded-full bg-ink overflow-hidden mb-8 relative z-10 progress-bar" data-target="87.4"><div class="h-full bg-action-blue progress-fill" style="width:0%"></div></div>
                <div class="flex justify-between text-caption text-muted mb-3 relative z-10"><span>Grade B</span><strong class="text-white progress-value" data-target="62.1">0%</strong></div>
                <div class="h-3 rounded-full bg-ink overflow-hidden relative z-10 progress-bar" data-target="62.1"><div class="h-full bg-coral progress-fill" style="width:0%"></div></div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="w-full max-w-[1200px] mx-auto text-center py-[120px] px-[24px]">
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
