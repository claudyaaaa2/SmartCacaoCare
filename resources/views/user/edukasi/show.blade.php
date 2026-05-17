@extends('layouts.app')

@section('title', $edukasi->judul)

@section('content')

{{-- BREADCRUMB --}}
<nav class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('user.edukasi') }}" style="color:#c8860a;">Edukasi</a>
        </li>
        <li class="breadcrumb-item active text-muted">{{ Str::limit($edukasi->judul, 40) }}</li>
    </ol>
</nav>

<div class="row g-4">

    {{-- KONTEN UTAMA --}}
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">

            {{-- THUMBNAIL --}}
            @if($edukasi->thumbnail)
                <img src="{{ asset('images/edukasi/' . $edukasi->thumbnail) }}"
                     alt="{{ $edukasi->judul }}"
                     class="card-img-top"
                     style="height:280px; object-fit:cover; border-radius:12px 12px 0 0;">
            @else
                <div class="d-flex align-items-center justify-content-center"
                     style="height:200px; background:#f0ebe3; border-radius:12px 12px 0 0;">
                    <i class="bi bi-journal-richtext" style="font-size:48px; color:#c8860a;"></i>
                </div>
            @endif

            <div class="card-body p-4">

                {{-- KATEGORI & TANGGAL --}}
                @php
                    $kategoriLabels = [
                        'budidaya'      => ['label' => 'Budidaya',       'color' => 'success'],
                        'perawatan'     => ['label' => 'Perawatan',      'color' => 'primary'],
                        'panen'         => ['label' => 'Panen',          'color' => 'warning'],
                        'pasca_panen'   => ['label' => 'Pasca Panen',    'color' => 'info'],
                        'hama_penyakit' => ['label' => 'Hama & Penyakit','color' => 'danger'],
                        'kualitas'      => ['label' => 'Kualitas',       'color' => 'secondary'],
                    ];
                    $kat = $kategoriLabels[$edukasi->kategori] ?? ['label' => $edukasi->kategori, 'color' => 'secondary'];
                @endphp

                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-{{ $kat['color'] }}">{{ $kat['label'] }}</span>
                    <small class="text-muted">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ $edukasi->created_at->format('d M Y') }}
                    </small>
                </div>

                {{-- JUDUL --}}
                <h4 class="fw-bold mb-3" style="color:#3d2b1f;">
                    {{ $edukasi->judul }}
                </h4>

                {{-- RINGKASAN --}}
                <div class="p-3 rounded mb-4"
                     style="background:#f8f3ee; border-left:4px solid #c8860a;">
                    <p class="mb-0 text-muted small" style="line-height:1.7;">
                        {{ $edukasi->ringkasan }}
                    </p>
                </div>

                {{-- KONTEN --}}
                <div style="line-height:1.8; color:#444; font-size:14px;">
                    {!! nl2br(e($edukasi->konten)) !!}
                </div>

            </div>
        </div>
    </div>

    {{-- SIDEBAR ARTIKEL LAIN --}}
    <div class="col-md-4">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('user.edukasi') }}"
           class="btn btn-outline-secondary w-100 mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Edukasi
        </a>

        {{-- ARTIKEL TERKAIT --}}
        @if($artikelLain->count() > 0)
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white py-3 px-4"
                 style="border-radius:12px 12px 0 0;">
                <h6 class="fw-bold mb-0" style="color:#3d2b1f;">
                    <i class="bi bi-journal-bookmark me-2"></i>Artikel Terkait
                </h6>
            </div>
            <div class="card-body p-3">
                @foreach($artikelLain as $artikel)
                <a href="{{ route('user.edukasi.show', $artikel->id) }}"
                   class="text-decoration-none">
                    <div class="d-flex gap-3 mb-3 pb-3
                         {{ !$loop->last ? 'border-bottom' : '' }}">
                        {{-- THUMBNAIL KECIL --}}
                        @if($artikel->thumbnail)
                            <img src="{{ asset('images/edukasi/' . $artikel->thumbnail) }}"
                                 alt="{{ $artikel->judul }}"
                                 style="width:60px; height:60px; object-fit:cover; border-radius:8px; flex-shrink:0;">
                        @else
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:60px; height:60px; background:#f0ebe3; border-radius:8px;">
                                <i class="bi bi-journal-richtext" style="color:#c8860a;"></i>
                            </div>
                        @endif

                        <div>
                            <p class="mb-1 small fw-semibold" style="color:#3d2b1f; line-height:1.4;">
                                {{ Str::limit($artikel->judul, 50) }}
                            </p>
                            <small class="text-muted">
                                {{ $artikel->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- CTA ANALISIS --}}
        <div class="card border-0 shadow-sm mt-3 text-center p-4"
             style="border-radius:12px; background:linear-gradient(135deg, #3d2b1f, #5c3d2e);">
            <i class="bi bi-search fs-2 text-white mb-2"></i>
            <h6 class="text-white fw-bold mb-2">Cek Kualitas Biji Kakao</h6>
            <p class="text-white-50 small mb-3">
                Gunakan sistem pakar kami untuk analisis kualitas
            </p>
            <a href="{{ route('user.analisis') }}" class="btn btn-warning btn-sm fw-bold">
                Analisis Sekarang
            </a>
        </div>

    </div>
</div>

@endsection