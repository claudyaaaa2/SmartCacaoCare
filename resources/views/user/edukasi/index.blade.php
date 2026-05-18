@extends('layouts.app')

@section('title', 'Edukasi Kakao')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h4 class="fw-bold mb-1" style="color:#3d2b1f;">
        <i class="bi bi-journal-richtext me-2"></i>Edukasi Kakao
    </h4>
    <p class="text-muted mb-0">Artikel dan panduan seputar perawatan dan pengolahan kakao</p>
</div>

{{-- FILTER KATEGORI --}}
<div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('user.edukasi') }}"
       class="btn btn-sm {{ !$kategori ? 'btn-cocoa' : 'btn-outline-secondary' }}">
        Semua
    </a>
    @foreach(['budidaya' => 'Budidaya', 'perawatan' => 'Perawatan', 'panen' => 'Panen', 'pasca_panen' => 'Pasca Panen', 'hama_penyakit' => 'Hama & Penyakit', 'kualitas' => 'Kualitas'] as $key => $label)
    <a href="{{ route('user.edukasi', ['kategori' => $key]) }}"
       class="btn btn-sm {{ $kategori == $key ? 'btn-cocoa' : 'btn-outline-secondary' }}">
        {{ $label }}
    </a>
    @endforeach
</div>

{{-- ARTIKEL GRID --}}
@if($edukasi->count() > 0)
<div class="row g-4">
    @foreach($edukasi as $artikel)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">

            {{-- THUMBNAIL --}}
            @if($artikel->thumbnail)
                <img src="{{ asset('images/edukasi/' . $artikel->thumbnail) }}"
                     alt="{{ $artikel->judul }}"
                     class="card-img-top"
                     style="height:180px; object-fit:cover; border-radius:12px 12px 0 0;">
            @else
                <div class="d-flex align-items-center justify-content-center"
                     style="height:180px; background:#f0ebe3; border-radius:12px 12px 0 0;">
                    <i class="bi bi-journal-richtext fs-1" style="color:#c8860a;"></i>
                </div>
            @endif

            <div class="card-body p-3">
                {{-- KATEGORI --}}
                @php
                    $kategoriLabels = [
                        'budidaya'     => ['label' => 'Budidaya',      'color' => 'success'],
                        'perawatan'    => ['label' => 'Perawatan',     'color' => 'primary'],
                        'panen'        => ['label' => 'Panen',         'color' => 'warning'],
                        'pasca_panen'  => ['label' => 'Pasca Panen',   'color' => 'info'],
                        'hama_penyakit'=> ['label' => 'Hama & Penyakit','color' => 'danger'],
                        'kualitas'     => ['label' => 'Kualitas',      'color' => 'secondary'],
                    ];
                    $kat = $kategoriLabels[$artikel->kategori] ?? ['label' => $artikel->kategori, 'color' => 'secondary'];
                @endphp
                <span class="badge bg-{{ $kat['color'] }} mb-2">{{ $kat['label'] }}</span>

                {{-- JUDUL --}}
                <h6 class="fw-bold mb-2" style="color:#3d2b1f;">
                    {{ $artikel->judul }}
                </h6>

                {{-- RINGKASAN --}}
                <p class="text-muted small mb-3" style="line-height:1.6;">
                    {{ Str::limit($artikel->ringkasan, 100) }}
                </p>

                {{-- TANGGAL --}}
                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $artikel->created_at->format('d M Y') }}
                </small>
            </div>

            <div class="card-footer bg-white px-3 pb-3 pt-0 border-0">
                <a href="{{ route('user.edukasi.show', $artikel->id) }}"
                   class="btn btn-cocoa w-100 btn-sm">
                    Baca Selengkapnya
                </a>
            </div>

        </div>
    </div>
    @endforeach
</div>

{{-- PAGINATION --}}
@if($edukasi->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $edukasi->links() }}
</div>
@endif

@else
{{-- KOSONG --}}
<div class="card border-0 shadow-sm text-center p-5" style="border-radius:12px;">
    <i class="bi bi-journal-x fs-1 text-muted mb-3"></i>
    <h6 class="text-muted">Belum ada artikel edukasi</h6>
    <p class="text-muted small">Artikel akan segera tersedia!</p>
</div>
@endif

@endsection