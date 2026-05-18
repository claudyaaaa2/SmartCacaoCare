@extends('layouts.app')
@section('title', 'Edukasi Petani - SmartCacaoCare')

@section('nav')
<nav class="sc-nav" id="main-nav">
    <a href="{{ route('petani.index') }}"><i data-lucide="search" style="width:14px;height:14px"></i> Analisis</a>
</nav>
@endsection

@section('content')
    {{-- Editorial banner --}}
    <div class="edu-banner">
        <span class="sc-brandline"><i data-lucide="graduation-cap" style="width:14px;height:14px"></i> Edukasi Petani</span>
        <h1>Referensi singkat untuk<br>menjaga mutu biji kakao.</h1>
        <p>Kumpulan materi yang membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.</p>
        <div class="toolbar">
            <a class="sc-btn secondary" href="{{ route('petani.index') }}"><i data-lucide="arrow-left" style="width:14px;height:14px"></i> Kembali ke analisis</a>
        </div>
    </div>

    {{-- Masonry card grid --}}
    @if($edukasi->count() > 0)
        <div class="edu-masonry">
            @foreach ($edukasi as $item)
                <article class="edu-card">
                    <div class="sc-badge" style="background:rgba(0,113,227,.06);color:var(--apple-blue)"><i data-lucide="tag" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</div>
                    <h2>{{ $item->judul }}</h2>
                    <div class="meta"><i data-lucide="file-text" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> {{ $item->ringkasan }}</div>
                    <div class="summary">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 200) }}</div>
                </article>
            @endforeach
        </div>
    @else
        <div class="edu-empty">
            <i data-lucide="inbox" style="width:32px;height:32px;color:var(--apple-text-3);margin:0 auto 12px;display:block"></i>
            <h2>Belum ada artikel edukasi.</h2>
            <p>Silakan isi data edukasi dari panel admin untuk menampilkan materi di halaman petani.</p>
        </div>
    @endif

    <div class="pagination">
        {{ $edukasi->links() }}
    </div>
@endsection