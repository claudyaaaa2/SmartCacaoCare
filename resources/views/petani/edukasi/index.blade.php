@extends(auth()->check() ? 'layouts.farmer' : 'layouts.app')
@section('title', 'Edukasi Petani - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto {{ auth()->check() ? '' : 'px-[24px] py-[80px]' }}">
    {{-- Editorial banner --}}
    <div class="{{ auth()->check() ? 'mb-12 border-b border-hairline pb-8' : 'mb-[64px] border-b border-hairline pb-[40px]' }}">
        <div class="flex items-center gap-2 mb-6">
            <span class="blog-filter-chip"><i data-lucide="graduation-cap" class="w-4 h-4 mr-2"></i> Edukasi Petani</span>
        </div>
        <h1 class="text-section-display mb-6 text-ink">Referensi untuk<br>mutu biji kakao.</h1>
        <p class="text-body-large text-muted max-w-[600px] mb-8">Kumpulan materi yang membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.</p>
        
        <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
            <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone" href="{{ route('petani.index') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Analisis</a>
            
            <form action="{{ route('mainpage.edukasi') }}" method="GET" class="relative w-full md:w-auto">
                <label for="edu-search" class="sr-only">Cari artikel</label>
                <input
                    id="edu-search"
                    type="search"
                    name="q"
                    value="{{ $search ?? request('q') }}"
                    placeholder="Cari artikel..."
                    class="w-full md:w-[300px] lg:w-[400px] rounded-full border border-hairline bg-white px-5 py-3 pr-24 text-base text-ink placeholder:text-muted shadow-sm transition-all focus:border-coral focus:outline-none focus:ring-2 focus:ring-coral/20"
                >
                @if(!empty($search ?? request('q')))
                    <a href="{{ route('mainpage.edukasi') }}" class="absolute right-16 top-1/2 -translate-y-1/2 text-muted hover:text-ink text-base leading-none">&times;</a>
                @endif
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-ink px-4 py-2 text-sm font-medium text-white hover:bg-coral transition-colors">
                    Cari
                </button>
            </form>
        </div>

        @if(!empty($search))
            <div class="mt-6 inline-flex items-center gap-2 rounded-full border border-hairline bg-soft-stone px-4 py-2 text-sm text-muted">
                <span>Hasil pencarian:</span>
                <strong class="text-ink">{{ $search }}</strong>
                <a href="{{ route('mainpage.edukasi') }}" class="text-coral hover:underline">hapus</a>
            </div>
        @endif
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
@endsection