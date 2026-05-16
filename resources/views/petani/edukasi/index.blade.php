<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kumpulan edukasi budidaya dan pasca panen kakao untuk petani.">
    <title>SmartCacaoCare - Edukasi Petani</title>

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
                    <small>Edukasi petani kakao</small>
                </div>
            </div>
            <nav class="sc-links">
                <a class="sc-btn" href="{{ route('petani.index') }}">Analisis</a>
                @auth
                    <a class="sc-btn primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                @else
                    <a class="sc-btn primary" href="{{ route('login') }}">Masuk</a>
                @endauth
            </nav>
        </header>

        <section class="hero">
            <div class="badge">Edukasi Petani</div>
            <h1>Referensi singkat untuk menjaga mutu biji kakao.</h1>
            <p>Kumpulan edukasi ini membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.</p>
            <div class="toolbar">
                <a class="sc-btn secondary" href="{{ route('petani.index') }}">Kembali ke analisis</a>
            </div>
        </section>

        <section class="grid">
            @forelse ($edukasi as $item)
                <article class="card">
                    <div class="sc-badge" style="background:rgba(0,113,227,0.08);color:var(--color-primary);">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</div>
                    <h2>{{ $item->judul }}</h2>
                    <div class="meta">{{ $item->ringkasan }}</div>
                    <div class="summary">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 180) }}</div>
                </article>
            @empty
                <div class="card empty" style="grid-column:1/-1;">
                    <h2>Belum ada artikel edukasi.</h2>
                    <p>Silakan isi data edukasi dari panel admin untuk menampilkan materi di halaman petani.</p>
                </div>
            @endforelse
        </section>

        <div class="pagination">
            {{ $edukasi->links() }}
        </div>

        <div class="footerbar">
            <span>SmartCacaoCare</span>
            <span>Edukasi untuk petani kakao Indonesia</span>
        </div>
    </div>
</body>
</html>