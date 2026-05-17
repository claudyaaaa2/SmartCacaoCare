@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color:#3d2b1f;">
            Selamat Datang, {{ auth()->user()->name }}! 👋
        </h4>
        <p class="text-muted mb-0">Pantau kualitas biji kakao Anda di sini</p>
    </div>
    <a href="{{ route('user.analisis') }}" class="btn btn-cocoa px-4">
        <i class="bi bi-search me-1"></i> Analisis Sekarang
    </a>
</div>

{{-- STATS CARD --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#fff3e0;">
                        <i class="bi bi-clipboard-data fs-4" style="color:#c8860a;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Analisis</div>
                        <div class="fw-bold fs-4" style="color:#3d2b1f;">
                            {{ $totalAnalisis }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#e8f5e9;">
                        <i class="bi bi-book fs-4" style="color:#28a745;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Artikel Edukasi</div>
                        <div class="fw-bold fs-4" style="color:#3d2b1f;">
                            Tersedia
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#e3f2fd;">
                        <i class="bi bi-clock-history fs-4" style="color:#1976d2;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Analisis Terakhir</div>
                        <div class="fw-bold fs-5" style="color:#3d2b1f;">
                            {{ $riwayatTerbaru->first() ? $riwayatTerbaru->first()->created_at->diffForHumans() : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MENU UTAMA --}}
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 text-center p-4"
             style="border-radius:12px; cursor:pointer;"
             onclick="window.location='{{ route('user.analisis') }}'">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                 style="width:70px; height:70px; background:#fff3e0;">
                <i class="bi bi-search fs-2" style="color:#c8860a;"></i>
            </div>
            <h5 class="fw-bold" style="color:#3d2b1f;">Analisis Kualitas</h5>
            <p class="text-muted small mb-3">
                Tentukan grade kualitas biji kakao Anda berdasarkan kondisi fisik
            </p>
            <a href="{{ route('user.analisis') }}" class="btn btn-cocoa">
                Mulai Analisis
            </a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 text-center p-4"
             style="border-radius:12px; cursor:pointer;"
             onclick="window.location='{{ route('user.edukasi') }}'">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                 style="width:70px; height:70px; background:#e8f5e9;">
                <i class="bi bi-journal-richtext fs-2" style="color:#28a745;"></i>
            </div>
            <h5 class="fw-bold" style="color:#3d2b1f;">Edukasi Kakao</h5>
            <p class="text-muted small mb-3">
                Pelajari cara perawatan, panen, dan pengolahan kakao yang baik
            </p>
            <a href="{{ route('user.edukasi') }}" class="btn btn-success">
                Baca Edukasi
            </a>
        </div>
    </div>
</div>

{{-- RIWAYAT TERBARU --}}
@if($riwayatTerbaru->count() > 0)
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
         style="border-radius:12px 12px 0 0;">
        <h6 class="fw-bold mb-0" style="color:#3d2b1f;">
            <i class="bi bi-clock-history me-2"></i>Riwayat Analisis Terbaru
        </h6>
        <a href="{{ route('user.riwayat') }}" class="btn btn-sm btn-outline-secondary">
            Lihat Semua
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Grade</th>
                        <th>Keyakinan</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayatTerbaru as $item)
                    <tr>
                        <td class="ps-4">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                        <td>
                            @php
                                $gradeColors = [
                                    'A' => 'success',
                                    'B' => 'info',
                                    'C' => 'warning',
                                    'D' => 'danger'
                                ];
                                $color = $gradeColors[$item->grade_hasil] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} px-3">
                                Grade {{ $item->grade_hasil }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height:6px; width:80px;">
                                    <div class="progress-bar bg-{{ $color }}"
                                         style="width:{{ $item->persentase_cf }}%"></div>
                                </div>
                                <small>{{ $item->persentase_cf }}%</small>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ Str::limit($item->rekomendasi, 50) }}
                            </small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm text-center p-5" style="border-radius:12px;">
    <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
    <h6 class="text-muted">Belum ada riwayat analisis</h6>
    <p class="text-muted small mb-3">Mulai analisis kualitas biji kakao Anda sekarang!</p>
    <a href="{{ route('user.analisis') }}" class="btn btn-cocoa px-4">
        Mulai Analisis
    </a>
</div>
@endif

@endsection