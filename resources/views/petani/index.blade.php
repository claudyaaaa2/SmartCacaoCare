@extends('layouts.app')
@section('title', 'Analisis Kakao - SmartCacaoCare')

@section('nav')
<nav class="sc-nav" id="main-nav">
    <a href="{{ route('petani.edukasi') }}"><i data-lucide="book-open" style="width:14px;height:14px"></i> Edukasi</a>
</nav>
@endsection

@section('content')
    {{-- Centered header --}}
    <div class="analysis-header">
        <span class="sc-brandline"><i data-lucide="clipboard-list" style="width:14px;height:14px"></i> Form Lapangan</span>
        <h1>Nilai mutu kakao Anda.</h1>
        <p class="sc-lead">Pilih kondisi tiap kriteria sesuai hasil pengamatan. Sistem menghitung grade dan confidence secara otomatis.</p>
    </div>

    {{-- Steps as connected bar --}}
    <div class="analysis-steps">
        <div class="a-step">
            <div class="step-num">1</div>
            <b><i data-lucide="eye" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Cek visual</b>
            <span>Lihat warna, aroma, dan kondisi fisik biji.</span>
        </div>
        <div class="a-step">
            <div class="step-num">2</div>
            <b><i data-lucide="file-edit" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Isi form</b>
            <span>Pilih opsi yang paling mendekati pengamatan.</span>
        </div>
        <div class="a-step">
            <div class="step-num">3</div>
            <b><i data-lucide="bar-chart-3" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Baca hasil</b>
            <span>Bandingkan grade terbaik dan keyakinan.</span>
        </div>
    </div>

    {{-- Two-column: form + result --}}
    <div class="analysis-body">
        <section class="sc-panel">
            <div class="panel-inner">
                <div class="panel-head">
                    <div>
                        <span class="tag"><i data-lucide="pencil" style="width:12px;height:12px"></i> Input kondisi</span>
                        <h2 class="sc-small-margin">Form Penilaian</h2>
                        <p>Pilih satu nilai untuk setiap kriteria. Data ini menjadi bahan hitung certainty factor.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="notice error">
                        <strong><i data-lucide="alert-triangle" style="width:14px;height:14px"></i> Masih ada input yang perlu diperbaiki.</strong>
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
                        <button class="sc-btn primary" type="submit"><i data-lucide="calculator" style="width:16px;height:16px"></i> Hitung Grade</button>
                        <a class="sc-btn" href="{{ route('petani.index') }}"><i data-lucide="rotate-ccw" style="width:16px;height:16px"></i> Reset</a>
                    </div>
                </form>
            </div>
        </section>

        <aside class="sc-panel">
            @if ($result)
                <div class="result-band">
                    <span class="sc-pill" style="background:rgba(255,255,255,.12); color:#fff;"><i data-lucide="trophy" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Hasil Analisis</span>
                    <h3>{{ $result['best_grade']['label'] }}</h3>
                    <p>Confidence: {{ number_format($result['best_grade']['percentage'], 2) }}%</p>
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
                        <div>
                            <h3><i data-lucide="git-branch" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Jejak keputusan</h3>
                            <p>Ringkasan input dan alasan grade.</p>
                        </div>
                        <span class="tag">CF</span>
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

                    <div class="panel-head sc-small-margin" style="margin-top:20px">
                        <div>
                            <h3><i data-lucide="bar-chart-2" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Detail grade teratas</h3>
                            <p>Nilai paling berpengaruh pada hasil akhir.</p>
                        </div>
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
                                    <div class="muted sc-small-margin">Evidence {{ number_format($detail['evidence'], 2) }} · Bobot {{ number_format($detail['weight'], 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="result-band">
                    <span class="sc-pill" style="background:rgba(255,255,255,.12); color:#fff;"><i data-lucide="clock" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Menunggu input</span>
                    <h3>Grade akan muncul di sini.</h3>
                    <p>Isi form di sebelah kiri, lalu tekan Hitung Grade.</p>
                    <div class="footer-note"><i data-lucide="info" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Ranking ditampilkan dari tertinggi ke terendah.</div>
                </div>
                <div class="panel-inner">
                    <div class="notice">
                        <strong><i data-lucide="lightbulb" style="width:14px;height:14px"></i> Tips</strong>
                        <p>Cek kondisi visual biji secara langsung sebelum mengisi form. Hasil yang akurat bergantung pada pengamatan yang cermat.</p>
                    </div>
                </div>
            @endif
        </aside>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.bar > span').forEach(function (el) {
        var p = Number(el.getAttribute('data-percent') || 0);
        p = Math.max(0, Math.min(100, p));
        el.style.width = p + '%';
    });
});
</script>
@endpush
