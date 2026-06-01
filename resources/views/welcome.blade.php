@extends('layouts.app')
@section('bodyClass','page-landing')
@section('title', 'SmartCacaoCare - Analisis Mutu Kakao')

@section('content')
    {{-- PROMO EDUKASI HEADER - two-column hero --}}
    <section id="about" class="w-full">
        <div class="w-full mx-0 overflow-hidden border-b border-hairline">
            <div class="flex flex-col lg:flex-row lg:min-h-[640px] xl:min-h-[720px]">
                <div class="lg:w-1/2 w-full min-h-[300px] sm:min-h-[400px] md:min-h-[480px] lg:min-h-full relative bg-cover bg-center" style="background-image:url('{{ asset('cacao_hero.png') }}')">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
                </div>

                <div class="lg:w-1/2 w-full bg-white p-6 sm:p-10 md:p-16 lg:p-20 flex items-center">
                    <div class="max-w-[560px] lg:max-w-[600px] w-full">
                        <h1 class="text-hero-display mb-6 text-ink">Edukasi <span class="text-coral block sm:inline-block xl:inline">SmartCacaoCare</span></h1>
                        <p class="text-body-large text-body-muted mb-8 leading-relaxed">Pelatihan singkat, panduan lapangan, dan video praktis untuk membantu petani meningkatkan mutu kakao dengan SmartCacaoCare — gratis dan mudah diikuti.</p>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 mb-10">
                            <a href="{{ route('mainpage.edukasi') }}" class="btn-primary w-full sm:w-auto justify-center">Jelajahi Edukasi <i data-lucide="arrow-right" class="ml-2 w-4 h-4"></i></a>
                            <a href="{{ route('petani.index') }}" class="btn-pill-outline w-full sm:w-auto justify-center flex items-center gap-2"><i data-lucide="play" class="w-4 h-4"></i> Coba Analisis</a>
                        </div>

                        <div class="grid grid-cols-3 gap-4 sm:gap-8 pt-8 border-t border-hairline mt-8 w-full">
                            <div class="text-left">
                                <div class="text-[28px] sm:text-[36px] font-display font-medium text-ink leading-none mb-2">Materi</div>
                                <div class="text-caption text-muted leading-tight">Panduan & Video</div>
                            </div>
                            <div class="text-left">
                                <div class="text-[28px] sm:text-[36px] font-display font-medium text-ink leading-none mb-2">Praktis</div>
                                <div class="text-caption text-muted leading-tight">Langkah demi langkah</div>
                            </div>
                            <div class="text-left">
                                <div class="text-[28px] sm:text-[36px] font-display font-medium text-ink leading-none mb-2">Gratis</div>
                                <div class="text-caption text-muted leading-tight">Untuk petani</div>
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
    <section id="edu" class="w-full px-[24px] lg:px-[80px] py-[64px]">
        <div class="max-w-[1200px] mx-auto">
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
        <div class="max-w-[1200px] mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-[80px] items-center">
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bars = document.querySelectorAll('.progress-bar');
            
            if (!bars.length) return;

            // Helper to animate numbers smoothly
            function animateNumber(element, start, end, duration) {
                let startTime = null;

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    const currentVal = start + progress * (end - start);
                    element.textContent = currentVal.toFixed(1) + '%';
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                }
                window.requestAnimationFrame(step);
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bar = entry.target;
                        const fill = bar.querySelector('.progress-fill');
                        const target = parseFloat(bar.getAttribute('data-target') || '0');
                        
                        // Find matching progress value element
                        const container = bar.closest('.bg-primary');
                        let valueEl = null;
                        if (container) {
                            valueEl = container.querySelector(`.progress-value[data-target="${bar.getAttribute('data-target')}"]`);
                        }

                        // Make progress fill animate using hardware-accelerated CSS transition
                        if (fill) {
                            fill.style.transition = 'width 1.8s cubic-bezier(0.22, 1, 0.36, 1)';
                            // Force reflow to ensure the initial state is registered before animating
                            fill.offsetHeight; 
                            fill.style.width = target + '%';
                        }

                        if (valueEl) {
                            animateNumber(valueEl, 0, target, 1800);
                        }

                        // Stop observing this bar once animated
                        observer.unobserve(bar);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px' // Trigger slightly before reaching the viewport center
            });

            bars.forEach(bar => {
                // Ensure starting state is clean 0% width and 0% text
                const fill = bar.querySelector('.progress-fill');
                if (fill) {
                    fill.style.width = '0%';
                }
                
                const container = bar.closest('.bg-primary');
                if (container) {
                    const valueEl = container.querySelector(`.progress-value[data-target="${bar.getAttribute('data-target')}"]`);
                    if (valueEl) {
                        valueEl.textContent = '0.0%';
                    }
                }
                
                observer.observe(bar);
            });
        });
    </script>
    @endpush
@endsection
