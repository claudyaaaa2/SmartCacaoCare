@extends('layouts.app')
@section('title', 'Edukasi Petani - SmartCacaoCare')

@section('nav')
<nav class="sc-nav" id="main-nav">
    <a href="{{ route('petani.index') }}"><i data-lucide="search" style="width:14px;height:14px"></i> Analisis</a>
</nav>
@endsection

@section('content')
    <div class="edu-hero">
        <span class="sc-brandline"><i data-lucide="graduation-cap" style="width:14px;height:14px"></i> Edukasi Petani</span>
        <h1>Referensi singkat untuk menjaga mutu biji kakao.</h1>
        <p>Kumpulan edukasi ini membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.</p>
        <div class="toolbar">
            <a class="sc-btn secondary" href="{{ route('petani.index') }}"><i data-lucide="arrow-left" style="width:14px;height:14px"></i> Kembali ke analisis</a>
        </div>
    </div>

    <div class="edu-grid">
        @forelse ($edukasi as $item)
            <article class="card">
                <div class="sc-badge" style="background: rgba(22,163,74,.08); color: #16a34a;"><i data-lucide="tag" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</div>
                <h2>{{ $item->judul }}</h2>
                <div class="meta">{{ $item->ringkasan }}</div>
                <div class="summary">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 180) }}</div>
            </article>
        @empty
            <div class="card empty" style="text-align:center;padding:40px;grid-column:1/-1">
                <h2><i data-lucide="inbox" style="width:24px;height:24px;display:inline;vertical-align:middle"></i> Belum ada artikel edukasi.</h2>
                <p style="color:var(--text-3);margin-top:8px">Silakan isi data edukasi dari panel admin untuk menampilkan materi di halaman petani.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $edukasi->links() }}
    </div>
@endsection