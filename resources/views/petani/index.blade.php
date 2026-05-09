<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartCacaoCare - Analisis Biji Kakao</title>
    <style>
        :root {
            --bg: #08111f;
            --panel: rgba(255, 255, 255, 0.95);
            --panel-soft: rgba(255, 255, 255, 0.08);
            --text: #102033;
            --muted: #5b687a;
            --primary: #0f766e;
            --primary-dark: #115e59;
            --accent: #d97706;
            --border: rgba(15, 23, 42, 0.1);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(217, 119, 6, 0.28), transparent 28%),
                radial-gradient(circle at right 10%, rgba(15, 118, 110, 0.28), transparent 24%),
                linear-gradient(135deg, #07111f 0%, #0f172a 50%, #111827 100%);
            color: var(--text);
        }

        .wrap {
            max-width: 1180px;
            margin: 0 auto;
            padding: 40px 20px 56px;
        }

        .hero {
            color: #f8fafc;
            margin-bottom: 24px;
        }

        .hero h1 {
            margin: 0 0 12px;
            font-size: clamp(2rem, 4vw, 3.5rem);
            line-height: 1.02;
            letter-spacing: -0.04em;
        }

        .hero p {
            max-width: 760px;
            margin: 0;
            color: rgba(248, 250, 252, 0.78);
            font-size: 1rem;
            line-height: 1.7;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 20px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 28px;
            box-shadow: 0 28px 80px rgba(2, 6, 23, 0.28);
            overflow: hidden;
        }

        .card .inner {
            padding: 24px;
        }

        .card-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .card-title h2,
        .card-title h3 {
            margin: 0;
            font-size: 1.25rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.1);
            color: var(--primary-dark);
            font-size: 0.875rem;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #1e293b;
        }

        .field select {
            width: 100%;
            padding: 13px 14px;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            background: #fff;
            color: #0f172a;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .field select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .button {
            appearance: none;
            border: 0;
            border-radius: 14px;
            padding: 13px 18px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .button.primary {
            background: linear-gradient(135deg, var(--primary) 0%, #14b8a6 100%);
            color: #fff;
        }

        .button.secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        .alert {
            border-radius: 18px;
            padding: 14px 16px;
            margin-bottom: 16px;
        }

        .alert.error {
            background: #fff1f2;
            color: #9f1239;
        }

        .result-hero {
            padding: 24px;
            color: #fff;
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
        }

        .result-hero .label {
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.75rem;
            opacity: 0.82;
        }

        .result-hero h3 {
            margin: 10px 0 8px;
            font-size: 1.8rem;
            line-height: 1.1;
        }

        .result-hero p {
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .stat {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 14px;
            background: #fff;
        }

        .stat span {
            display: block;
            font-size: 0.8rem;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .stat strong {
            font-size: 1.05rem;
            color: #0f172a;
        }

        .ranking-list,
        .detail-list {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        .ranking-item,
        .detail-item {
            border: 1px solid var(--border);
            border-radius: 18px;
            background: #fff;
            padding: 14px;
        }

        .ranking-item.active {
            border-color: rgba(15, 118, 110, 0.4);
            background: rgba(15, 118, 110, 0.06);
        }

        .ranking-top,
        .detail-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .ranking-top strong,
        .detail-top strong {
            font-size: 1rem;
        }

        .meta {
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .criteria-summary {
            margin-top: 16px;
            display: grid;
            gap: 10px;
        }

        .criteria-chip {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid var(--border);
        }

        .criteria-chip strong {
            display: block;
            color: #0f172a;
        }

        .criteria-chip span {
            color: var(--muted);
            font-size: 0.93rem;
        }

        @media (max-width: 960px) {
            .grid,
            .form-grid,
            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="badge">SmartCacaoCare</div>
            <h1>Analisis kualitas biji kakao dengan certainty factor.</h1>
            <p>
                Petani cukup memilih kondisi <strong>Warna, Ukuran, Aroma, Tekstur</strong>, dan <strong>Kondisi Fisik</strong>.
                Sistem akan menghitung tingkat keyakinan setiap grade lalu menampilkan grade tertinggi sebagai hasil akhir.
            </p>
        </section>

        <div class="grid">
            <section class="card">
                <div class="inner">
                    <div class="card-title">
                        <h2>Form Penilaian Petani</h2>
                        <span class="badge">5 kriteria wajib</span>
                    </div>

                    @if ($errors->any())
                        <div class="alert error">
                            <strong>Periksa kembali input Anda.</strong>
                            <div style="margin-top: 8px;">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('petani.analyze') }}">
                        @csrf

                        <div class="form-grid">
                            @foreach ($criteria as $field => $definition)
                                <div class="field">
                                    <label for="{{ $field }}">{{ $definition['label'] }}</label>
                                    <select id="{{ $field }}" name="{{ $field }}" required>
                                        <option value="">Pilih kondisi {{ strtolower($definition['label']) }}</option>
                                        @foreach ($options as $key => $option)
                                            <option value="{{ $key }}" @selected(old($field, $selected[$field] ?? '') === $key)>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <div class="actions">
                            <button class="button primary" type="submit">Hitung CF</button>
                            <a class="button secondary" href="{{ route('petani.index') }}">Reset</a>
                        </div>
                    </form>
                </div>
            </section>

            <aside class="card">
                @if ($result)
                    <div class="result-hero">
                        <div class="label">Hasil utama</div>
                        <h3>{{ $result['best_grade']['label'] }}</h3>
                        <p>Nilai keyakinan akhir: {{ number_format($result['best_grade']['percentage'], 2) }}%</p>
                    </div>

                    <div class="inner">
                        <div class="card-title">
                            <h3>Ranking Grade</h3>
                            <span class="badge">CF tertinggi menang</span>
                        </div>

                        <div class="ranking-list">
                            @foreach ($result['rankings'] as $ranking)
                                <div class="ranking-item @if ($ranking['grade_key'] === $result['best_grade']['grade_key']) active @endif">
                                    <div class="ranking-top">
                                        <strong>{{ $ranking['label'] }}</strong>
                                        <span class="badge">{{ number_format($ranking['percentage'], 2) }}%</span>
                                    </div>
                                    <div class="meta">
                                        Confidence: {{ number_format($ranking['confidence'], 4) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-title" style="margin-top: 22px;">
                            <h3>Ringkasan Input</h3>
                        </div>

                        <div class="criteria-summary">
                            @foreach ($result['selected_criteria'] as $criterion)
                                <div class="criteria-chip">
                                    <div>
                                        <strong>{{ $criterion['label'] }}</strong>
                                        <span>{{ $criterion['selection_label'] }}</span>
                                    </div>
                                    <span>Bobot {{ number_format($criterion['weight'] * 100, 0) }}%</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-title" style="margin-top: 22px;">
                            <h3>Detail CF Grade Terbaik</h3>
                        </div>

                        <div class="detail-list">
                            @foreach ($result['best_grade']['details'] as $detail)
                                <div class="detail-item">
                                    <div class="detail-top">
                                        <strong>{{ $detail['label'] }}</strong>
                                        <span class="badge">{{ $detail['selection_label'] }}</span>
                                    </div>
                                    <div class="meta">
                                        Evidence {{ number_format($detail['evidence'], 2) }} ·
                                        Bobot {{ number_format($detail['weight'], 2) }} ·
                                        CF tertimbang {{ number_format($detail['weighted_evidence'], 4) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="result-hero">
                        <div class="label">Panduan</div>
                        <h3>Isi form untuk melihat grade terbaik.</h3>
                        <p>Setelah semua kriteria dipilih, sistem akan mengembalikan ranking grade dari tertinggi ke terendah.</p>
                    </div>

                    <div class="inner">
                        <div class="meta">
                            Algoritma ini menghitung CF per grade dengan mengalikan bobot kriteria dan nilai keyakinan dari pilihan dropdown, lalu menggabungkannya menggunakan rumus CF.
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</body>
</html>