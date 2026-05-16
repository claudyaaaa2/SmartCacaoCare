<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SmartCacaoCare — Sistem analisis mutu biji kakao berbasis Certainty Factor untuk petani dan profesional.">
    <title>{{ config('app.name', 'SmartCacaoCare') }} — Analisis Mutu Kakao</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <a href="#contact">Contact</a>
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

        <main class="sc-hero">
            <section class="sc-panel sc-hero-main">
                <div class="sc-hero-copy">
                    <span class="sc-brandline">SmartCacaoCare</span>
                    <h1>Unleash Your Inner Champion. All In One Place.</h1>
                    <p class="sc-lead">Satu tempat untuk membaca mutu kakao, menilai kondisi lapangan, lalu memilih tindakan yang paling tepat tanpa tampilan yang ramai.</p>
                    <div class="sc-cta">
                        <a href="{{ route('petani.index') }}" class="sc-btn primary">Start your journey</a>
                        <a href="{{ route('petani.edukasi') }}" class="sc-btn secondary">Explore cocoa guide</a>
                    </div>
                </div>

                <div class="sc-hero-metrics">
                    <div class="sc-metric-chip">
                        <span>Analisis cepat</span>
                        <strong>CF ranking</strong>
                    </div>
                    <div class="sc-metric-chip">
                        <span>Fokus lapangan</span>
                        <strong>Petani first</strong>
                    </div>
                    <div class="sc-metric-chip">
                        <span>Visual system</span>
                        <strong>Warm minimal</strong>
                    </div>
                </div>
            </section>

            <aside class="sc-panel sc-side">
                <div class="sc-brandline">About SmartCacaoCare</div>
                <p class="intro">At SmartCacaoCare, we don't just show results — we help you read the field with calm, clear, and focused decision support.</p>
                <div class="sc-side-card">
                    <span>Gaya visual</span>
                    <strong>Warm, minimal, editorial, dan terasa seperti alat kerja nyata.</strong>
                </div>
                <div class="sc-side-card">
                    <span>Fokus utama</span>
                    <strong>Analisis cepat, hasil yang mudah dibaca, dan langkah berikutnya jelas.</strong>
                </div>
                <div class="mini-stats" id="numbers">
                    <div class="mini-stat">
                        <span>Criteria</span>
                        <strong>4+</strong>
                    </div>
                    <div class="mini-stat">
                        <span>Grades</span>
                        <strong>3</strong>
                    </div>
                    <div class="mini-stat">
                        <span>Flow</span>
                        <strong>1 tap</strong>
                    </div>
                </div>
            </aside>
        </main>

        <section class="section" id="about">
            <div class="section-head">
                <div>
                    <h2>Built for field decisions, not decoration.</h2>
                    <p>Struktur halaman dibuat seperti landing page premium: hero besar, kartu informasi, angka ringkas, dan area layanan yang langsung bisa dipahami.</p>
                </div>
            </div>
            <div class="about">
                <article class="card dark">
                    <b>Professional grade layout</b>
                    <p>Tampilan dibuat tenang dan berlapis, mirip referensi yang Anda kirim, tapi tetap sesuai identitas SmartCacaoCare.</p>
                    <div class="card-note">Use this flow to review quality, compare results, and move to the next decision with less friction.</div>
                </article>
                <article class="card">
                    <b>Cocoa-first design language</b>
                    <p>Kami terjemahkan pola visual referensi menjadi sistem yang lebih relevan untuk kakao: header bersih, hero kuat, kartu-kartu padat, dan angka yang mudah dipindai.</p>
                    <div class="icons">
                        <div class="avatar"></div>
                        <div class="avatar"></div>
                        <div class="avatar"></div>
                    </div>
                </article>
            </div>
        </section>

        <section class="service-shell" id="services">
            <div class="card">
                <b>Professional field dashboard</b>
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
                    <div class="mini-arrow">↗</div>
                    <div class="overlay">
                        <span>Quality analysis</span>
                        <strong>Start with the form, then read the CF ranking.</strong>
                    </div>
                </div>
                <div class="image-card green">
                    <div class="mini-arrow">⟳</div>
                    <div class="overlay">
                        <span>Guided learning</span>
                        <strong>Open cocoa education for the next step.</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="contact">
            <div class="section-head">
                <div>
                    <h2>Services that keep the flow simple.</h2>
                    <p>Three compact cards echo the reference layout: a strong feature card, a visual card, and a data card.</p>
                </div>
                <a class="sc-btn primary" href="{{ route('petani.index') }}">Book now</a>
            </div>
            <div class="grid">
                <article class="card dark">
                    <b>Professional analysis</b>
                    <p>Masuk ke form analisis, pilih kondisi, lalu dapatkan grade utama dan ranking keyakinan.</p>
                    <div class="card-note">Perfect for batch checks and quick field decisions.</div>
                </article>
                <article class="card">
                    <b>Guided education</b>
                    <p>Buka referensi budidaya dan pasca panen untuk menjaga mutu kakao tetap konsisten.</p>
                    <div class="card-note">Works like a lightweight guidebook.</div>
                </article>
                <article class="card">
                    <b>One place for everything</b>
                    <p>Dashboard, analisis, dan edukasi dirangkai dalam satu alur yang jelas dan tidak berisik.</p>
                    <div class="card-note">Built to feel intentional, not generic.</div>
                </article>
            </div>
        </section>

        <div class="footerbar">
            <span>SmartCacaoCare</span>
            <span>Warm minimal UI for cocoa quality support</span>
        </div>
    </div>
</body>
</html>
