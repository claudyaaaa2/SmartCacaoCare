<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Petani - SmartCacaoCare</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>body{font-family:'Nunito',system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;}</style>
    @endif
</head>
<body>
    <div class="sc-frame">
        <header class="sc-topbar">
                <div class="sc-brand">
                <div class="sc-mark"></div>
                <div>
                    <div>SmartCacaoCare</div>
                    <small class="muted">Ruang kontrol mutu kakao</small>
                </div>
            </div>
            <nav class="sc-links">
                <a class="sc-btn" href="{{ route('petani.analysis') }}">Analisis</a>
                <a class="sc-btn" href="{{ route('petani.edukasi') }}">Edukasi</a>
                <a class="sc-btn" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
            </nav>
        </header>

        <section class="sc-hero">
            <div class="sc-panel sc-hero-main">
                <span class="sc-brandline">Dashboard Petani</span>
                <h1>Mulai dari lot, bukan dari asumsi.</h1>
                <p class="sc-lead">Pantau alur mutu kakao dari satu halaman: analisis, baca grade, lalu buka edukasi yang relevan.</p>
            </div>
            <aside class="sc-panel sc-side">
                <span class="sc-brandline">Ringkasan</span>
                <div class="stats">
                    <div class="stat"><span>Kriteria yang dinilai</span><strong>{{ $criteriaCount }}</strong></div>
                    <div class="stat"><span>Grade referensi</span><strong>{{ $gradeCount }}</strong></div>
                    <div class="stat"><span>Parameter utama</span><strong>{{ implode(' · ', $fieldLabels) }}</strong></div>
                </div>
            </aside>
        </section>

        <section class="sc-grid">
            <article class="sc-card">
                <h2>Langkah kerja</h2>
                <p class="meta">Pakai alur singkat ini saat ingin cek mutu batch kakao.</p>
                <ul class="list">
                    <li>Masuk ke halaman analisis dan pilih kondisi tiap kriteria.</li>
                    <li>Lihat grade tertinggi, lalu bandingkan seluruh ranking.</li>
                    <li>Buka edukasi untuk tindak lanjut pasca panen.</li>
                </ul>
            </article>
            <article class="sc-card">
                <h2>Fokus hari ini</h2>
                <p class="meta">Gunakan untuk mengingat hal yang paling penting.</p>
                <ul class="list">
                    <li>Warna biji</li>
                    <li>Ukuran dan keseragaman</li>
                    <li>Aroma, tekstur, dan fisik biji</li>
                </ul>
            </article>
            <article class="sc-card">
                <h2>Aksi cepat</h2>
                <p class="meta">Langsung lompat ke halaman yang dibutuhkan.</p>
                <ul class="list">
                    <li><a href="{{ route('petani.analysis') }}">Buka analisis</a></li>
                    <li><a href="{{ route('petani.edukasi') }}">Buka edukasi</a></li>
                    <li><a href="{{ url('/') }}">Kembali ke beranda</a></li>
                </ul>
            </article>
        </section>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
</body>
</html>
