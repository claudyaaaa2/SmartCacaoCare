@extends('layouts.app')
@section('title', 'SmartCacaoCare — Analisis Mutu Kakao')

@section('content')
    <main class="sc-hero">
        <section class="sc-panel sc-hero-main">
            <div class="sc-hero-copy">
                <span class="sc-brandline"><i data-lucide="sparkles" style="width:14px;height:14px"></i> SmartCacaoCare</span>
                <h1>Unleash Your Inner Champion. All In One Place.</h1>
                <p class="sc-lead">Satu tempat untuk membaca mutu kakao, menilai kondisi lapangan, lalu memilih tindakan yang paling tepat tanpa tampilan yang ramai.</p>
                <div class="sc-cta">
                    <a href="{{ route('petani.index') }}" class="sc-btn primary"><i data-lucide="arrow-right" style="width:16px;height:16px"></i> Start your journey</a>
                    <a href="{{ route('petani.edukasi') }}" class="sc-btn secondary"><i data-lucide="book-open" style="width:16px;height:16px"></i> Explore cocoa guide</a>
                </div>
            </div>

            <div class="sc-hero-metrics">
                <div class="sc-metric-chip">
                    <span><i data-lucide="zap" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Analisis cepat</span>
                    <strong>CF ranking</strong>
                </div>
                <div class="sc-metric-chip">
                    <span><i data-lucide="target" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Fokus lapangan</span>
                    <strong>Petani first</strong>
                </div>
                <div class="sc-metric-chip">
                    <span><i data-lucide="palette" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Visual system</span>
                    <strong>Warm minimal</strong>
                </div>
            </div>
        </section>

        <aside class="sc-panel sc-side">
            <div class="sc-brandline"><i data-lucide="info" style="width:14px;height:14px"></i> About SmartCacaoCare</div>
            <p class="intro">At SmartCacaoCare, we don't just show results — we help you read the field with calm, clear, and focused decision support.</p>
            <div class="sc-side-card"><span>Gaya visual</span><strong>Warm, minimal, editorial, dan terasa seperti alat kerja nyata.</strong></div>
            <div class="sc-side-card"><span>Fokus utama</span><strong>Analisis cepat, hasil yang mudah dibaca, dan langkah berikutnya jelas.</strong></div>
            <div class="mini-stats" id="numbers">
                <div class="mini-stat"><span>Criteria</span><strong>4+</strong></div>
                <div class="mini-stat"><span>Grades</span><strong>3</strong></div>
                <div class="mini-stat"><span>Flow</span><strong>1 tap</strong></div>
            </div>
        </aside>
    </main>

    <section class="panel section-block" id="about">
        <div style="padding:24px">
            <div class="section-head">
                <div>
                    <h2><i data-lucide="layers" style="width:20px;height:20px;display:inline;vertical-align:middle"></i> Built for field decisions, not decoration.</h2>
                    <p>Struktur halaman dibuat seperti landing page premium: hero besar, kartu informasi, angka ringkas, dan area layanan yang langsung bisa dipahami.</p>
                </div>
                <span class="brandline" style="background:rgba(202,138,4,.10);color:#ca8a04;padding:6px 14px;border-radius:999px;font-size:12px;font-weight:600"><i data-lucide="bean" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Cocoa palette</span>
            </div>
            <div class="about">
                <article class="card dark">
                    <div>
                        <b><i data-lucide="layout" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Professional grade layout</b>
                        <p>Tampilan dibuat tenang dan berlapis, mirip referensi yang Anda kirim, tapi tetap sesuai identitas SmartCacaoCare.</p>
                    </div>
                    <div class="card-note">Use this flow to review quality, compare results, and move to the next decision with less friction.</div>
                </article>

                <article class="card story">
                    <div>
                        <b><i data-lucide="users" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Designed for real farmers</b>
                        <p>Kami terjemahkan pola visual referensi menjadi sistem yang lebih relevan untuk kakao: header bersih, hero kuat, kartu-kartu padat, dan angka yang mudah dipindai.</p>
                    </div>
                    <div class="icons">
                        <div class="avatar"></div>
                        <div class="avatar"></div>
                        <div class="avatar"></div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="service-shell" id="services">
        <div class="card">
            <b><i data-lucide="gauge" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Professional field dashboard</b>
            <p>Ruang kontrol singkat untuk analisis, edukasi, dan hasil yang langsung bisa dipakai.</p>
            <div class="meter">
                <div class="meter-row"><span>Readability</span><strong>94%</strong></div>
                <div class="bar"><span style="width:94%"></span></div>
                <div class="meter-row"><span>Decision flow</span><strong>88%</strong></div>
                <div class="bar"><span style="width:88%"></span></div>
                <div class="meter-row"><span>Visual calm</span><strong>91%</strong></div>
                <div class="bar"><span style="width:91%"></span></div>
            </div>
            <div class="card-note">Clean interface, fast interpretation, and low distraction.</div>
        </div>

        <div class="image-grid">
            <div class="image-card">
                <div class="mini-arrow"><i data-lucide="arrow-up-right" style="width:14px;height:14px"></i></div>
                <div class="overlay">
                    <span>Quality analysis</span>
                    <strong>Start with the form, then read the CF ranking.</strong>
                </div>
            </div>
            <div class="image-card green">
                <div class="mini-arrow"><i data-lucide="refresh-cw" style="width:14px;height:14px"></i></div>
                <div class="overlay">
                    <span>Guided learning</span>
                    <strong>Open cocoa education for the next step.</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="panel section-block" id="contact">
        <div style="padding:24px">
            <div class="section-head">
                <div>
                    <h2><i data-lucide="workflow" style="width:20px;height:20px;display:inline;vertical-align:middle"></i> Services that keep the flow simple.</h2>
                    <p>Three compact cards echo the reference layout: a strong feature card, a visual card, and a data card.</p>
                </div>
                <a class="sc-btn primary" href="{{ route('petani.index') }}"><i data-lucide="play" style="width:14px;height:14px"></i> Mulai Analisis</a>
            </div>
            <div class="grid">
                <article class="card dark">
                    <b><i data-lucide="search" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Professional analysis</b>
                    <p>Masuk ke form analisis, pilih kondisi, lalu dapatkan grade utama dan ranking keyakinan.</p>
                    <div class="card-note">Perfect for batch checks and quick field decisions.</div>
                </article>
                <article class="card">
                    <b><i data-lucide="graduation-cap" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Guided education</b>
                    <p>Buka referensi budidaya dan pasca panen untuk menjaga mutu kakao tetap konsisten.</p>
                    <div class="card-note">Works like a lightweight guidebook.</div>
                </article>
                <article class="card">
                    <b><i data-lucide="package" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> One place for everything</b>
                    <p>Dashboard, analisis, dan edukasi dirangkai dalam satu alur yang jelas dan tidak berisik.</p>
                    <div class="card-note">Built to feel intentional, not generic.</div>
                </article>
            </div>
        </div>
    </section>
@endsection
