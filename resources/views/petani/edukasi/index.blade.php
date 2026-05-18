@extends('layouts.app')
@section('title', 'Edukasi Petani - SmartCacaoCare')

@section('nav')
<nav class="hidden md:flex items-center gap-6 text-body font-medium">
    <a href="{{ route('petani.index') }}" class="text-ink hover:text-action-blue transition-colors flex items-center gap-2"><i data-lucide="search" class="w-4 h-4"></i> Analisis</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-muted hover:text-error transition-colors flex items-center gap-2"><i data-lucide="log-out" class="w-4 h-4"></i> Keluar</a>
</nav>
@endsection

@section('content')
<div class="max-w-[1200px] mx-auto px-[24px] py-[80px]">
    {{-- Editorial banner --}}
    <div class="mb-[64px] border-b border-hairline pb-[40px]">
        <div class="flex items-center gap-2 mb-6">
            <span class="blog-filter-chip"><i data-lucide="graduation-cap" class="w-4 h-4 mr-2"></i> Edukasi Petani</span>
        </div>
        <h1 class="text-section-display mb-6 text-ink">Referensi untuk<br>mutu biji kakao.</h1>
        <p class="text-body-large text-muted max-w-[600px] mb-8">Kumpulan materi yang membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.</p>
        <div>
            <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone" href="{{ route('petani.index') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Analisis</a>
        </div>
    </div>

    {{-- Masonry card grid --}}
    @if($edukasi->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($edukasi as $item)
                <article class="contact-form-card p-[24px] md:p-[32px] flex flex-col items-start hover:border-coral transition-colors group cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-[100px] h-[100px] bg-coral opacity-0 group-hover:opacity-5 transition-opacity rounded-full blur-2xl translate-x-1/2 -translate-y-1/2"></div>
                    <div class="text-mono-label text-coral mb-4 flex items-center gap-2"><i data-lucide="tag" class="w-3.5 h-3.5"></i> {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</div>
                    <h2 class="text-card-heading text-ink mb-3 group-hover:text-coral transition-colors">{{ $item->judul }}</h2>
                    <div class="text-caption text-muted mb-4 font-medium flex items-center gap-2"><i data-lucide="file-text" class="w-3.5 h-3.5"></i> {{ $item->ringkasan }}</div>
                    <div class="text-body text-body-muted line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 150) }}</div>
                </article>
            @endforeach
        </div>
    @else
        <div class="product-card flex flex-col items-center justify-center text-center py-[80px]">
            <i data-lucide="inbox" class="w-12 h-12 text-muted mb-4"></i>
            <h2 class="text-card-heading text-ink mb-2">Belum ada artikel edukasi.</h2>
            <p class="text-body text-muted max-w-[400px]">Silakan isi data edukasi dari panel admin untuk menampilkan materi di halaman ini.</p>
        </div>
    @endif

    <div class="mt-[40px]">
        {{ $edukasi->links() }}
    </div>
</div>
<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
@endsection