@extends(auth()->check() ? 'layouts.farmer' : 'layouts.app')
@section('title', 'Edukasi Petani - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto {{ auth()->check() ? '' : 'px-[24px] py-[80px]' }}">
    {{-- Editorial banner --}}
    <div class="{{ auth()->check() ? 'mb-12 border-b border-hairline pb-8' : 'mb-[64px] border-b border-hairline pb-[40px]' }}">
        <div class="flex items-center gap-2 mb-6">
            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[10px] py-[4px] border border-coral-soft">
                <i data-lucide="graduation-cap" class="w-3.5 h-3.5 mr-1.5"></i> Edukasi Library
            </span>
        </div>
        <h1 class="text-section-display mb-6 text-ink font-medium leading-none">Referensi untuk<br>mutu biji kakao.</h1>
        <p class="text-body-large text-muted max-w-[600px] mb-8">Kumpulan materi yang membantu petani memahami budidaya, perawatan, panen, hingga pasca panen agar hasil analisis kualitas lebih konsisten.</p>
        
        <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
            @auth
                <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone py-2 px-5 text-body" href="{{ route('petani.index') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Analisis</a>
            @else
                <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone py-2 px-5 text-body" href="{{ url('/') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Halaman Utama</a>
            @endauth
            
            <form action="{{ route('mainpage.edukasi') }}" method="GET" class="relative w-full md:w-auto">
                <label for="edu-search" class="sr-only">Cari artikel</label>
                <div class="relative">
                    <input
                        id="edu-search"
                        type="search"
                        name="q"
                        value="{{ $search ?? request('q') }}"
                        placeholder="Cari artikel edukasi..."
                        class="w-full md:w-[320px] lg:w-[400px] h-[44px] pl-10 pr-24 rounded-xs border border-border-light bg-canvas text-ink text-body placeholder:text-muted focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral/20 transition-all"
                    >
                    <i data-lucide="search" class="w-4 h-4 text-muted absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    @if(!empty($search ?? request('q')))
                        <a href="{{ route('mainpage.edukasi') }}" class="absolute right-20 top-1/2 -translate-y-1/2 text-muted hover:text-ink text-xl leading-none">&times;</a>
                    @endif
                    <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 bg-primary text-on-primary hover:bg-ink text-[12px] font-mono tracking-wider uppercase px-4 rounded-xs transition-colors">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        @if(!empty($search))
            <div class="mt-6 inline-flex items-center gap-2 rounded-sm border border-hairline bg-soft-stone/30 px-3 py-1.5 text-caption text-muted">
                <span>Hasil pencarian untuk:</span>
                <strong class="text-ink font-medium">"{{ $search }}"</strong>
                <span class="text-hairline">|</span>
                <a href="{{ route('mainpage.edukasi') }}" class="text-coral hover:underline font-medium">Hapus Filter</a>
            </div>
        @endif
    </div>

    {{-- Masonry card grid --}}
    @if($edukasi->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($edukasi as $item)
                <article class="bg-canvas border border-card-border p-8 rounded-lg hover:border-coral/50 transition-all duration-300 relative group flex flex-col justify-between min-h-[300px] cursor-pointer shadow-[0_8px_32px_rgba(0,0,0,0.01)]" onclick="openArticleModal({{ $item->id }})">
                    <div>
                        <div class="mb-4">
                            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[8px] py-[3px] border border-coral-soft">
                                <i data-lucide="tag" class="w-3 h-3 mr-1.5"></i> {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                            </span>
                        </div>
                        <h2 class="text-feature-heading text-ink font-medium mb-3 group-hover:text-coral transition-colors leading-snug line-clamp-2">
                            {{ $item->judul }}
                        </h2>
                        <p class="text-caption text-muted mb-4 font-normal flex items-start gap-2 leading-relaxed line-clamp-2" title="{{ $item->ringkasan }}">
                            <i data-lucide="file-text" class="w-4 h-4 mt-0.5 text-coral/60 flex-shrink-0"></i>
                            <span>{{ $item->ringkasan }}</span>
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-hairline flex items-center justify-between w-full">
                        <span class="text-caption text-ink font-medium group-hover:text-coral transition-colors flex items-center gap-1.5">
                            Baca Artikel <i data-lucide="arrow-right" class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                    {{-- Hidden Rich Text Content --}}
                    <div id="full-content-{{ $item->id }}" class="hidden">{!! $item->konten !!}</div>
                </article>
            @endforeach
        </div>
    @else
        <div class="bg-canvas border border-card-border p-12 text-center rounded-lg shadow-sm flex flex-col items-center justify-center min-h-[300px]">
            <i data-lucide="inbox" class="w-12 h-12 text-muted mb-4 flex-shrink-0"></i>
            <h2 class="text-card-heading text-ink mb-2">Belum ada artikel edukasi.</h2>
            <p class="text-caption text-muted max-w-[320px]">Silakan isi data edukasi dari panel admin untuk menampilkan materi di halaman ini.</p>
        </div>
    @endif

    <div class="mt-[48px]">
        {{ $edukasi->links() }}
    </div>
</div>

{{-- Sleek Stark White Modal Overlay --}}
<div id="edu-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-6 opacity-0 pointer-events-none transition-opacity duration-300">
    {{-- Modal Backdrop --}}
    <div class="fixed inset-0 bg-black/60 backdrop-blur-md" onclick="closeArticleModal()"></div>
    
    {{-- Modal Content Console --}}
    <div class="bg-canvas border border-hairline w-full max-w-[800px] max-h-[85vh] flex flex-col rounded-lg shadow-2xl relative z-10 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-console">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center p-6 md:p-8 border-b border-hairline bg-canvas">
            <div>
                <span id="modal-category" class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[8px] py-[3px] border border-coral-soft">
                    Kategori
                </span>
            </div>
            <button onclick="closeArticleModal()" class="btn-pill-outline py-1 px-3 border border-border-light hover:bg-soft-stone text-ink text-micro flex items-center gap-1.5">
                <i data-lucide="x" class="w-3.5 h-3.5"></i> Tutup
            </button>
        </div>
        
        {{-- Modal Scrollable Body --}}
        <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            <h2 id="modal-title" class="text-card-heading text-ink font-medium leading-tight">Judul Artikel</h2>
            
            <div id="modal-summary-box" class="p-5 rounded-sm border-l-4 border-coral bg-soft-stone/30 flex items-start gap-3">
                <i data-lucide="file-text" class="w-5 h-5 text-coral mt-0.5 flex-shrink-0"></i>
                <div>
                    <span class="text-micro font-mono uppercase text-muted tracking-wider block mb-1">Ringkasan Materi</span>
                    <p id="modal-summary" class="text-caption text-ink font-medium leading-relaxed">Ringkasan artikel...</p>
                </div>
            </div>
            
            <div class="prose prose-sm max-w-none text-body text-body-muted leading-relaxed space-y-4" id="modal-content">
                Konten artikel penuh...
            </div>
        </div>
        
        {{-- Modal Footer --}}
        <div class="p-6 border-t border-hairline bg-canvas flex justify-end">
            <button onclick="closeArticleModal()" class="btn-primary py-2 px-6">Selesai Membaca</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openArticleModal(id) {
        const card = document.querySelector(`article[onclick*="openArticleModal(${id})"]`);
        if (!card) return;
        
        const title = card.querySelector('h2').innerText;
        const categoryBadge = card.querySelector('span.inline-flex').outerHTML;
        const summary = card.querySelector('p.text-caption span').innerText;
        const fullContent = document.getElementById(`full-content-${id}`).innerHTML;
        
        document.getElementById('modal-title').innerText = title;
        document.getElementById('modal-category').outerHTML = categoryBadge;
        // Re-query the element we just replaced to update its id
        const newBadge = document.querySelector('#edu-modal span.inline-flex');
        if (newBadge) newBadge.id = 'modal-category';
        
        document.getElementById('modal-summary').innerText = summary;
        document.getElementById('modal-content').innerHTML = fullContent;
        
        const modal = document.getElementById('edu-modal');
        const console = document.getElementById('modal-console');
        
        // Show Modal
        modal.classList.remove('opacity-0', 'pointer-events-none');
        setTimeout(() => {
            console.classList.remove('scale-95', 'opacity-0');
        }, 50);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
        
        // Recreate icons in modal
        lucide.createIcons();
    }
    
    function closeArticleModal() {
        const modal = document.getElementById('edu-modal');
        const console = document.getElementById('modal-console');
        
        console.classList.add('scale-95', 'opacity-0');
        modal.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = '';
    }
    
    // Close on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeArticleModal();
        }
    });
</script>
@endpush
@endsection