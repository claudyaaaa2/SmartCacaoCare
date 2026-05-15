<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartCacaoCare - Edukasi Petani</title>
    <style>
        :root {
            --bg: #07111f;
            --panel: rgba(255, 255, 255, 0.95);
            --border: rgba(15, 23, 42, 0.10);
            --text: #102033;
            --muted: #5b687a;
            --primary: #0f766e;
            --accent: #d97706;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(217, 119, 6, 0.22), transparent 25%),
                radial-gradient(circle at right top, rgba(15, 118, 110, 0.24), transparent 22%),
                linear-gradient(135deg, #07111f 0%, #0f172a 52%, #111827 100%);
            color: var(--text);
        }

        .wrap {
            max-width: 1120px;
            margin: 0 auto;
            padding: 40px 20px 56px;
        }

        .hero {
            color: #f8fafc;
            margin-bottom: 24px;
        }

        .badge {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            font-size: 0.875rem;
            font-weight: 700;
        }

        h1 {
            margin: 14px 0 10px;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.04;
        }

        p {
            margin: 0;
            max-width: 760px;
            color: rgba(248, 250, 252, 0.78);
            line-height: 1.7;
        }

        .toolbar {
            margin: 18px 0 24px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 800;
            border: 1px solid transparent;
        }

        .button.secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 28px 80px rgba(2, 6, 23, 0.22);
        }

        .card h2 {
            margin: 0 0 10px;
            font-size: 1.2rem;
        }

        .meta {
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .summary {
            color: #1e293b;
            line-height: 1.7;
        }

        .empty {
            grid-column: 1 / -1;
            color: #f8fafc;
            border: 1px dashed rgba(255, 255, 255, 0.24);
            background: rgba(255, 255, 255, 0.06);
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 860px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                    <div class="badge" style="background: rgba(15, 118, 110, 0.10); color: #0f766e;">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</div>
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