<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                :root{--bg:#f5efe4;--panel:rgba(255,255,255,.88);--line:rgba(17,24,39,.10);--text:#18211f;--muted:#66736d;--ink:#13201b;--forest:#1f4b37;--rust:#a85b2c;--cream:#fbf7f0}
                *{box-sizing:border-box}
                html{scroll-behavior:smooth}
                body{margin:0;font-family:'Nunito',system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:
                    radial-gradient(circle at 14% 10%, rgba(168,91,44,.09), transparent 22%),
                    radial-gradient(circle at 86% 12%, rgba(31,75,55,.09), transparent 18%),
                    radial-gradient(circle at 60% 76%, rgba(17,24,39,.04), transparent 24%),
                    linear-gradient(180deg,#f8f2e9 0%, #f2eadf 100%);color:var(--text);min-height:100vh;line-height:1.6}
                a{color:inherit}
                .sc-frame{max-width:1240px;margin:0 auto;padding:18px 18px 56px}
                .sc-topbar{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:8px 0 18px;position:sticky;top:0;z-index:10;background:linear-gradient(180deg,rgba(248,242,233,.96),rgba(248,242,233,.72) 80%,transparent);backdrop-filter:blur(12px)}
                .sc-brand{display:flex;align-items:center;gap:12px;font-weight:800;letter-spacing:-.02em}
                .sc-brand small,.muted{color:var(--muted)}
                .sc-mark{width:40px;height:40px;border-radius:14px;background:linear-gradient(135deg,#1f4b37,#a85b2c);box-shadow:0 14px 30px rgba(20,33,29,.12)}
                .sc-nav{display:flex;align-items:center;gap:14px;flex-wrap:wrap;justify-content:center}
                .sc-nav a{padding:10px 12px;color:var(--muted);text-decoration:none;font-weight:700;transition:color .2s ease,transform .2s ease}
                .sc-nav a:hover{color:var(--ink);transform:translateY(-1px)}
                .sc-links{display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end}
                .sc-btn{display:inline-flex;align-items:center;justify-content:center;min-height:46px;padding:12px 18px;border-radius:999px;text-decoration:none;font-weight:800;line-height:1;border:1px solid var(--line);color:var(--ink);background:rgba(255,255,255,.72);box-shadow:0 10px 24px rgba(20,33,29,.04)}
                .sc-btn.primary{background:var(--ink);color:#fff;border-color:var(--ink);box-shadow:0 18px 30px rgba(19,32,27,.16)}
                .sc-hero{display:grid;grid-template-columns:1.15fr .85fr;gap:16px;align-items:stretch}
                .sc-panel{border:1px solid var(--line);border-radius:28px;background:var(--panel);box-shadow:0 18px 40px rgba(20,33,29,.07);overflow:hidden}
                .sc-hero-main{position:relative;padding:24px 28px;min-height:420px;display:flex;flex-direction:column;justify-content:space-between;background:
                    linear-gradient(180deg, rgba(255,255,255,.12), rgba(255,255,255,.04)),
                    radial-gradient(circle at 18% 14%, rgba(255,255,255,.12), transparent 22%),
                    linear-gradient(135deg, #66a8d8 0%, #74b2dd 35%, #8ec2e4 58%, #d7a17d 58%, #e0b08e 100%)}
                .sc-hero-main::before{content:"";position:absolute;inset:18px 18px 18px auto;width:min(40%,320px);border-radius:22px;background:
                    radial-gradient(circle at 72% 26%, rgba(255,255,255,.5), transparent 16%),
                    radial-gradient(circle at 24% 60%, rgba(17,24,39,.12), transparent 12%),
                    linear-gradient(180deg, rgba(255,255,255,.12), rgba(255,255,255,.02)),
                    linear-gradient(145deg, #f2d6b9 0%, #c77f56 44%, #8d4d2c 100%);opacity:.14}
                .sc-hero-main::after{content:"";position:absolute;right:24px;bottom:24px;width:86px;height:86px;border-radius:50%;background:radial-gradient(circle at 35% 35%, rgba(255,255,255,.18), transparent 28%),linear-gradient(145deg,#2f6e49,#173326);box-shadow:none;opacity:.9}
                .sc-hero-copy{position:relative;z-index:2;max-width:56ch;padding-right:28%}
                .sc-brandline{display:inline-flex;padding:7px 12px;border-radius:999px;background:rgba(255,255,255,.18);color:#fff;font-size:.8rem;font-weight:800}
                h1{margin:14px 0 10px;font-size:clamp(2.1rem,5vw,3.6rem);line-height:1.03;letter-spacing:-.04em;max-width:14ch;color:#fff}
                .sc-lead{margin:0;max-width:42ch;font-size:1.02rem;line-height:1.75;color:rgba(255,255,255,.88)}
                .sc-cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:22px}
                .sc-hero-metrics{position:relative;z-index:1;display:flex;align-items:flex-end;justify-content:space-between;gap:14px;margin-top:34px}
                .sc-metric-chip{padding:12px 14px;border-radius:18px;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.20);color:#fff;backdrop-filter:blur(10px);min-width:140px}
                .sc-metric-chip span{display:block;font-size:.8rem;opacity:.84;margin-bottom:4px}
                .sc-metric-chip strong{font-size:1.15rem;letter-spacing:-.03em}
                .sc-side{padding:20px;display:grid;grid-template-rows:auto auto 1fr;gap:12px;background:linear-gradient(180deg, rgba(255,255,255,.9), rgba(255,255,255,.78))}
                .sc-side .intro{font-size:1.05rem;line-height:1.7;color:var(--text);margin:0}
                .sc-side-card{background:#fff;border:1px solid var(--line);border-radius:22px;padding:16px;box-shadow:0 12px 24px rgba(20,33,29,.04)}
                .sc-side-card span{display:block;color:var(--muted);font-size:.85rem;margin-bottom:6px}
                .sc-side-card strong{font-size:1rem;line-height:1.45}
                .mini-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px}
                .mini-stat{padding:14px;border-radius:18px;background:linear-gradient(180deg,#fff, #f9f6f1);border:1px solid var(--line)}
                .mini-stat span{display:block;font-size:.78rem;color:var(--muted);margin-bottom:4px}
                .mini-stat strong{font-size:1.2rem;letter-spacing:-.04em}
                .section{margin-top:18px;padding:24px}
                .section-head{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:14px}
                .section-head h2{margin:0;font-size:1.45rem;letter-spacing:-.04em}
                .section-head p{margin:6px 0 0;color:var(--muted);max-width:62ch}
                .grid{display:grid;grid-template-columns:1.12fr .95fr .93fr;gap:14px}
                .card{padding:18px;border-radius:24px;border:1px solid var(--line);background:rgba(255,255,255,.88);box-shadow:0 14px 30px rgba(20,33,29,.04)}
                .card.dark{background:linear-gradient(180deg,#1b2940,#101826);color:#fff;border-color:rgba(255,255,255,.06)}
                .card.dark p,.card.dark .card-note{color:rgba(255,255,255,.74)}
                .card b{display:block;margin-bottom:8px;font-size:1.02rem}
                .card p{margin:0;color:var(--muted);line-height:1.7}
                .card-note{margin-top:12px;font-size:.92rem;color:var(--muted)}
                .meter{margin-top:14px;display:grid;gap:8px}
                .meter-row{display:flex;justify-content:space-between;gap:12px;font-size:.88rem}
                .bars{display:grid;gap:8px;margin-top:12px}
                .bar{height:8px;border-radius:999px;background:#e8eee7;overflow:hidden}
                .bar span{display:block;height:100%;border-radius:inherit;background:linear-gradient(90deg,#6bb18b,#1f4b37)}
                .about{display:grid;grid-template-columns:.94fr 1.06fr;gap:14px;margin-top:14px}
                .about .card{min-height:170px}
                .about .story{display:flex;flex-direction:column;justify-content:space-between;background:linear-gradient(135deg, #ffffff, #f5efe4)}
                .icons{display:flex;align-items:center;gap:8px;margin-top:10px}
                .avatar{width:30px;height:30px;border-radius:50%;border:2px solid #fff;background:linear-gradient(135deg,#d7a17d,#8d4d2c);box-shadow:0 8px 16px rgba(20,33,29,.12);margin-left:-6px}
                .service-shell{display:grid;grid-template-columns:1fr 1.2fr;gap:14px;align-items:stretch;margin-top:14px}
                .service-list{display:grid;gap:12px}
                .service-item{padding:14px;border-radius:18px;background:#fff;border:1px solid var(--line)}
                .service-item span{display:block;color:var(--muted);font-size:.82rem;margin-bottom:6px}
                .service-item strong{font-size:1rem}
                .image-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:12px}
                .image-card{position:relative;min-height:180px;border-radius:24px;overflow:hidden;border:1px solid var(--line);background:
                    radial-gradient(circle at 32% 28%, rgba(255,255,255,.28), transparent 18%),
                    linear-gradient(145deg,#d59a69,#8e4d2a 50%, #271c17 100%)}
                .image-card.green{background:
                    radial-gradient(circle at 32% 22%, rgba(255,255,255,.26), transparent 20%),
                    linear-gradient(145deg,#cbe08e,#7aa15c 50%, #37502d 100%)}
                .image-card::after{content:"";position:absolute;inset:18px;border-radius:20px;border:1px solid rgba(255,255,255,.18)}
                .image-card .overlay{position:absolute;left:16px;right:16px;bottom:14px;color:#fff;z-index:1}
                .overlay span{display:inline-flex;padding:7px 10px;border-radius:999px;background:rgba(255,255,255,.18);backdrop-filter:blur(8px);font-size:.78rem;font-weight:800;margin-bottom:8px}
                .overlay strong{display:block;font-size:1rem;line-height:1.35;max-width:18ch}
                .mini-arrow{position:absolute;right:14px;top:14px;width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,.92);color:var(--ink);display:grid;place-items:center;font-size:1.1rem;font-weight:900;z-index:1}
                .footerbar{display:flex;align-items:center;justify-content:space-between;gap:12px;padding-top:14px;margin-top:6px;color:var(--muted);font-size:.92rem}
                @media (max-width:1080px){.hero,.grid,.about,.service-shell{grid-template-columns:1fr}.hero-main{min-height:0}.hero-copy{padding-right:0}.hero-main::before{width:46%;opacity:.7}.hero-metrics{flex-wrap:wrap}.mini-stats{grid-template-columns:1fr}.topbar{position:static;background:transparent;backdrop-filter:none}.nav{order:3;width:100%;justify-content:flex-start}.links{margin-left:auto}}
                @media (max-width:720px){.frame{padding:14px 14px 40px}.hero-main{padding:22px}.section{padding:18px}.section-head{flex-direction:column}.links,.nav{width:100%}.links{justify-content:flex-start}.btn{width:100%}.hero-main::before,.hero-main::after{opacity:.45}.hero-metrics{gap:10px}.metric-chip{min-width:0;flex:1}}
            </style>
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
                    <a href="#contact">Contacts</a>
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
                            <a href="{{ route('petani.edukasi') }}" class="sc-btn">Explore cocoa guide</a>
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
                    <div class="sc-brandline sc-note">About SmartCacaoCare</div>
                    <p class="intro">At SmartCacaoCare, we don’t just show results — we help you read the field with calm, clear, and focused decision support.</p>
                    <div class="sc-side-card"><span>Gaya visual</span><strong>Warm, minimal, editorial, dan terasa seperti alat kerja nyata.</strong></div>
                    <div class="sc-side-card"><span>Fokus utama</span><strong>Analisis cepat, hasil yang mudah dibaca, dan langkah berikutnya jelas.</strong></div>
                    <div class="mini-stats" id="numbers">
                        <div class="mini-stat"><span>Criteria</span><strong>4+</strong></div>
                        <div class="mini-stat"><span>Grades</span><strong>3</strong></div>
                        <div class="mini-stat"><span>Flow</span><strong>1 tap</strong></div>
                    </div>
                </aside>
            </main>

            <section class="panel section" id="about">
                <div class="section-head">
                    <div>
                        <h2>Built for field decisions, not decoration.</h2>
                        <p>Struktur halaman dibuat seperti landing page premium: hero besar, kartu informasi, angka ringkas, dan area layanan yang langsung bisa dipahami.</p>
                    </div>
                    <span class="brandline sc-note" style="background:rgba(168,91,44,.10);color:var(--rust);">Cocoa palette</span>
                </div>
                <div class="about">
                    <article class="card dark">
                        <div>
                            <b>Professional grade layout</b>
                            <p>Tampilan dibuat tenang dan berlapis, mirip referensi yang Anda kirim, tapi tetap sesuai identitas SmartCacaoCare.</p>
                        </div>
                        <div class="card-note">Use this flow to review quality, compare results, and move to the next decision with less friction.</div>
                    </article>

                    <article class="card story">
                        <div>
                            <b>At Horizon, we don’t just play tennis.</b>
                            <p>Kami terjemahkan pola visual referensi menjadi sistem yang lebih relevan untuk kakao: header bersih, hero kuat, kartu-kartu padat, dan angka yang mudah dipindai.</p>
                        </div>
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

            <section class="panel section" id="contact">
                <div class="section-head">
                    <div>
                        <h2>Services that keep the flow simple.</h2>
                        <p>Three compact cards echo the reference layout: a strong feature card, a visual card, and a data card.</p>
                    </div>
                    <a class="btn" href="{{ route('petani.index') }}">Book now</a>
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
            </section>
                <div class="footerbar">
                    <span>SmartCacaoCare</span>
                    <span>Warm minimal UI for cocoa quality support</span>
                </div>
            </section>
    </body>
</html>
