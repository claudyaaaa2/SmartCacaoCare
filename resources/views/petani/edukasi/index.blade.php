<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartCacaoCare - Edukasi Petani</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>body{font-family:'Nunito',system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;}</style>
    @endif
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="badge">Edukasi Petani</div>
            <h1>Referensi singkat untuk menjaga mutu biji kakao.</h1>
            <p>
                Kumpulan edukasi ini membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.
            </p>
            <div class="toolbar">
                <a class="button secondary" href="{{ route('petani.index') }}">Kembali ke analisis</a>
            </div>
        </section>

        <section class="grid">
            @forelse ($edukasi as $item)
                <article class="card">
                    <div class="sc-badge" style="background: rgba(15, 118, 110, 0.10); color: #0f766e;">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</div>
                    <h2>{{ $item->judul }}</h2>
                    <div class="meta">{{ $item->ringkasan }}</div>
                    <div class="summary">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 180) }}</div>
                </article>
            @empty
                <div class="card empty">
                    <h2>Belum ada artikel edukasi.</h2>
                    <p>Silakan isi data edukasi dari panel admin untuk menampilkan materi di halaman petani.</p>
                </div>
            @endforelse
        </section>

        <div class="pagination">
            {{ $edukasi->links() }}
        </div>
    </div>
</body>
</html>