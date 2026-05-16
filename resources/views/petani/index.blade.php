<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Form analisis mutu biji kakao menggunakan metode Certainty Factor.">
    <title>Analisis Kakao - SmartCacaoCare</title>

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
                    <small>Analisis mutu biji kakao</small>
                </div>
            </div>
            <nav class="sc-links">
                <a class="sc-btn" href="{{ route('petani.edukasi') }}">Edukasi</a>
                @auth
                    <a class="sc-btn primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                @else
                    <a class="sc-btn primary" href="{{ route('login') }}">Masuk</a>
                @endauth
            </nav>
        </header>

        <section class="sc-hero">
            <div class="sc-panel sc-hero-main">
                <div class="sc-hero-copy">
                    <span class="sc-brandline">Form lapangan</span>
                    <h1>Nilai mutu kakao dengan tampilan yang lebih tenang.</h1>
                    <p class="sc-lead">Pilih kondisi tiap kriteria sesuai hasil pengamatan. Hasilnya dibaca sebagai grade utama dan jejak perhitungan, tanpa tampilan yang ramai.</p>
                </div>
            </div>
            <aside class="sc-panel hero-side">
                <span class="pill">Panduan singkat</span>
                <div class="mini-grid">
                    <div class="mini"><span>Cara kerja</span><strong>Pilih kondisi lalu baca ranking</strong></div>
                    <div class="mini"><span>Target utama</span><strong>Menentukan grade biji paling meyakinkan</strong></div>
                    <div class="mini"><span>Rujukan</span><strong>{{ count($criteria) }} kriteria inti</strong></div>
                </div>
            </aside>
        </section>

        <div class="layout">
            <section class="sc-panel">
                <div class="panel-inner">
                    <div class="panel-head">
                        <div>
                            <span class="tag">Tahap 1 · Input kondisi</span>
                            <h2 class="sc-small-margin">Form Penilaian Petani</h2>
                            <p>Pilih satu nilai untuk setiap kriteria. Data ini menjadi bahan hitung certainty factor.</p>
                        </div>
                        <span class="tag">Wajib lengkap</span>
                    </div>

                    <div class="steps">
                        <div class="step"><b>1. Cek visual</b><span>Lihat warna, aroma, dan kondisi fisik biji.</span></div>
                        <div class="step"><b>2. Isi form</b><span>Pilih opsi yang paling mendekati hasil pengamatan.</span></div>
                        <div class="step"><b>3. Baca hasil</b><span>Bandingkan grade terbaik dan detail keyakinan.</span></div>
                    </div>

                    @if ($errors->any())
                        <div class="notice error">
                            <strong>Masih ada input yang perlu diperbaiki.</strong>
                            <div class="sc-small-margin">
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
                                @php $fieldOptions = $definition['options'] ?? $options; @endphp
                                <div class="field">
                                    <label for="{{ $field }}">{{ $definition['label'] }}</label>
                                    <small>Bobot utama {{ number_format(($definition['weight'] ?? 0) * 100, 0) }}%</small>
                                    <select id="{{ $field }}" name="{{ $field }}" required>
                                        <option value="">Pilih kondisi {{ strtolower($definition['label']) }}</option>
                                        @foreach ($fieldOptions as $key => $option)
                                            <option value="{{ $key }}" @selected(old($field, $selected[$field] ?? '') === $key)>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <div class="actions">
                            <button class="sc-btn primary" type="submit">Hitung Grade</button>
                            <a class="sc-btn secondary" href="{{ route('petani.index') }}">Reset pilihan</a>
                        </div>
                    </form>
                </div>
            </section>

            <aside class="sc-panel">
                @if ($result)
                    <div class="result-band">
                        <span class="sc-pill" style="background:rgba(255,255,255,.12);color:#fff;">Tahap 2 · Hasil</span>
                        <h3>{{ $result['best_grade']['label'] }}</h3>
                        <p>Confidence akhir: {{ number_format($result['best_grade']['percentage'], 2) }}%</p>
                        <div class="scoreline">
                            @foreach ($result['rankings'] as $ranking)
                                <div class="score-row">
                                    <div class="label">
                                        <span>{{ $ranking['label'] }}</span>
                                        <strong>{{ number_format($ranking['percentage'], 2) }}%</strong>
                                    </div>
                                    <div class="bar"><span data-percent="{{ min(100, max(0, $ranking['percentage'])) }}"></span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel-inner">
                        <div class="panel-head">
                            <div><h3>Jejak keputusan</h3><p>Ringkasan input dan alasan hasil grade.</p></div>
                            <span class="tag">CF ranking</span>
                        </div>
                        <div class="criteria">
                            @foreach ($result['selected_criteria'] as $criterion)
                                <div class="item">
                                    <div>
                                        <strong>{{ $criterion['label'] }}</strong>
                                        <div class="muted">{{ $criterion['selection_label'] }}</div>
                                    </div>
                                    <span class="tag">{{ number_format($criterion['weight'] * 100, 0) }}%</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-head" style="margin-top:24px">
                            <div><h3>Detail grade teratas</h3><p>Nilai yang paling berpengaruh pada hasil akhir.</p></div>
                        </div>
                        <div class="detail">
                            @foreach ($result['best_grade']['details'] as $detail)
                                <div class="item">
                                    <div>
                                        <strong>{{ $detail['label'] }}</strong>
                                        <div class="muted">{{ $detail['selection_label'] }}</div>
                                    </div>
                                    <div class="sc-text-right">
                                        <span class="tag">{{ number_format($detail['weighted_evidence'], 4) }}</span>
                                        <div class="muted sc-small-margin" style="font-size:12px">Evidence {{ number_format($detail['evidence'], 2) }} · Bobot {{ number_format($detail['weight'], 2) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="result-band">
                        <span class="pill" style="background:rgba(255,255,255,.12);color:#fff;">Tahap 2 · Siap hitung</span>
                        <h3>Grade akan muncul di sini.</h3>
                        <p>Setelah form diisi, sistem menampilkan ranking grade dari tertinggi ke terendah.</p>
                        <div class="footer-note">Tampilan dibuat lebih sederhana agar fokus tetap ke keputusan, bukan dekorasi.</div>
                    </div>

                    <div class="panel-inner">
                        <div class="notice">
                            <strong>Kenapa tampilannya dibuat begini?</strong>
                            <p style="margin:10px 0 0;color:var(--text-tertiary)">
                                Supaya terasa lebih kalem, lebih editorial, dan tidak terlalu seperti template umum.
                                Fokusnya tetap jelas: pilih kondisi, lihat hasil, lalu ambil keputusan.
                            </p>
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.bar > span').forEach(function (el) {
            var p = Number(el.getAttribute('data-percent') || 0);
            p = Math.max(0, Math.min(100, p));
            setTimeout(function(){ el.style.width = p + '%'; }, 100);
        });
    });
    </script>
</body>
</html>
