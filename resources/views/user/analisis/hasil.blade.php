@extends('layouts.app')

@section('title', 'Hasil Analisis Kualitas Biji Kakao')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h4 class="fw-bold mb-1" style="color:#3d2b1f;">
        <i class="bi bi-clipboard-check me-2"></i>Hasil Analisis
    </h4>
    <p class="text-muted mb-0">Berikut hasil analisis kualitas biji kakao Anda</p>
</div>

{{-- HASIL UTAMA --}}
@php
    $gradeColors = [
        'A' => ['bg' => '#e8f5e9', 'border' => '#28a745', 'text' => '#1b5e20', 'badge' => 'success'],
        'B' => ['bg' => '#e3f2fd', 'border' => '#1976d2', 'text' => '#0d47a1', 'badge' => 'info'],
        'C' => ['bg' => '#fff8e1', 'border' => '#f9a825', 'text' => '#e65100', 'badge' => 'warning'],
        'D' => ['bg' => '#ffebee', 'border' => '#e53935', 'text' => '#b71c1c', 'badge' => 'danger'],
    ];
    $color = $gradeColors[$bestGrade['grade']->kode_grade] ?? $gradeColors['D'];
@endphp

<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">

                {{-- GRADE BADGE --}}
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-3"
                         style="width:70px; height:70px;
                                background:{{ $color['bg'] }};
                                color:{{ $color['text'] }};
                                border: 2px solid {{ $color['border'] }};">
                        {{ $bestGrade['grade']->kode_grade }}
                    </div>
                    <div>
                        <div class="text-muted small">Grade Kualitas</div>
                        <h5 class="fw-bold mb-0" style="color:#3d2b1f;">
                            {{ $bestGrade['grade']->nama_grade }}
                        </h5>
                    </div>
                </div>

                {{-- PERSENTASE --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Tingkat Keyakinan</small>
                        <small class="fw-bold" style="color:{{ $color['text'] }};">
                            {{ $bestGrade['persentase'] }}%
                        </small>
                    </div>
                    <div class="progress" style="height:10px; border-radius:10px;">
                        <div class="progress-bar bg-{{ $color['badge'] }}"
                             style="width:{{ $bestGrade['persentase'] }}%; border-radius:10px;">
                        </div>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <p class="text-muted small mb-0">
                    {{ $bestGrade['grade']->deskripsi }}
                </p>

            </div>
            <div class="col-md-6">

                {{-- REKOMENDASI --}}
                <div class="p-3 rounded" style="background:{{ $color['bg'] }};
                     border-left: 4px solid {{ $color['border'] }};">
                    <div class="fw-semibold mb-2" style="color:{{ $color['text'] }};">
                        <i class="bi bi-lightbulb me-1"></i> Rekomendasi Penanganan
                    </div>
                    <p class="mb-0 small" style="color:{{ $color['text'] }}; line-height:1.7;">
                        {{ $bestGrade['grade']->rekomendasi }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- RANKING SEMUA GRADE --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-header bg-white py-3 px-4"
         style="border-radius:12px 12px 0 0;">
        <h6 class="fw-bold mb-0" style="color:#3d2b1f;">
            <i class="bi bi-bar-chart me-2"></i>Perbandingan Semua Grade
        </h6>
    </div>
    <div class="card-body p-4">
        @foreach($rankings as $ranking)
        @php
            $c = $gradeColors[$ranking['grade']->kode_grade] ?? $gradeColors['D'];
        @endphp
        <div class="mb-3">
            <div class="d-flex justify-content-between mb-1">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-{{ $c['badge'] }}">
                        Grade {{ $ranking['grade']->kode_grade }}
                    </span>
                    <small class="text-muted">{{ $ranking['grade']->nama_grade }}</small>
                    @if($loop->first)
                        <span class="badge"
                              style="background:#fff3e0; color:#c8860a; font-size:10px;">
                            ✓ Hasil Terbaik
                        </span>
                    @endif
                </div>
                <small class="fw-bold">{{ $ranking['persentase'] }}%</small>
            </div>
            <div class="progress" style="height:8px; border-radius:8px;">
                <div class="progress-bar bg-{{ $c['badge'] }}"
                     style="width:{{ $ranking['persentase'] }}%; border-radius:8px;">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- TOMBOL AKSI --}}
<div class="d-flex gap-3">
    <a href="{{ route('user.analisis') }}" class="btn btn-cocoa px-4">
        <i class="bi bi-arrow-repeat me-1"></i> Analisis Lagi
    </a>
    <a href="{{ route('user.riwayat') }}" class="btn btn-outline-secondary px-4">
        <i class="bi bi-clock-history me-1"></i> Lihat Riwayat
    </a>
    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary px-4">
        <i class="bi bi-house me-1"></i> Dashboard
    </a>
</div>

@endsection