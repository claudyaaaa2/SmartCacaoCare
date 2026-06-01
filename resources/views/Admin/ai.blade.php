@extends('layouts.admin')
@section('title', 'Konsol AI Editor Konten')
@section('subtitle', 'Hasilkan draf materi edukasi secara instan menggunakan kecerdasan buatan Google Gemini')

@section('content')
<div class="max-w-[1000px] mx-auto space-y-8">
    {{-- Topic Generator Card --}}
    <div class="contact-form-card">
        <h3 class="text-feature-heading text-ink font-medium mb-4 flex items-center gap-2">
            <i data-lucide="sparkles" class="w-5 h-5 text-coral animate-pulse"></i> Tulis Artikel Edukasi Baru dengan AI
        </h3>
        <p class="text-caption text-muted mb-6">Masukkan topik spesifik pertanian kakao yang ingin Anda bahas. AI akan merumuskan draf artikel terstruktur secara ilmiah dan taktis.</p>
        
        <form id="generator-form" class="flex flex-col sm:flex-row gap-4">
            @csrf
            <div class="flex-1">
                <label for="topic" class="sr-only">Topik Artikel</label>
                <input 
                    type="text" 
                    id="topic" 
                    placeholder="Contoh: Pemangkasan Daun Kakao, Fermentasi Kotak Kayu, Mencegah Hama Kanker Batang..." 
                    class="w-full h-[46px] px-4 rounded-xs border border-border-light bg-canvas text-ink text-body placeholder:text-muted focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral/20"
                    required
                >
            </div>
            <button type="submit" class="btn-primary h-[46px] px-6 flex items-center justify-center gap-2 flex-shrink-0" id="generate-btn">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Generasikan Draf</span>
            </button>
        </form>
    </div>

    {{-- Editor and Commit Form (Hidden by default, shown after generation) --}}
    <div id="editor-card" class="contact-form-card hidden">
        <h3 class="text-feature-heading text-ink font-medium mb-6 pb-3 border-b border-hairline flex items-center gap-2">
            <i data-lucide="edit-3" class="w-5 h-5 text-coral"></i> Pratinjau & Sunting Draf Konten
        </h3>

        <form action="{{ route('admin.edukasi.store') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Title Input --}}
            <div>
                <label for="title-input" class="form-label">Judul Artikel</label>
                <input 
                    type="text" 
                    name="judul" 
                    id="title-input" 
                    class="form-input"
                    required
                >
            </div>

            {{-- Summary Input --}}
            <div>
                <label for="summary-input" class="form-label">Ringkasan Ringkas</label>
                <textarea 
                    name="ringkasan" 
                    id="summary-input" 
                    rows="2"
                    class="form-textarea"
                    required
                ></textarea>
            </div>

            {{-- Category Select --}}
            <div>
                <label for="category-input" class="form-label">Kategori Materi</label>
                <select name="kategori" id="category-input" class="form-select" required>
                    <option value="budidaya">Budidaya & Perawatan</option>
                    <option value="hama_penyakit">Hama & Penyakit</option>
                    <option value="pasca_panen">Penanganan Pasca Panen</option>
                </select>
            </div>

            {{-- Rich HTML Content Area --}}
            <div>
                <label for="content-input" class="form-label">Konten Artikel (Format HTML)</label>
                <textarea 
                    name="konten" 
                    id="content-input" 
                    rows="15"
                    class="form-textarea font-mono text-sm leading-relaxed"
                    required
                ></textarea>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 border-t border-hairline flex flex-wrap gap-4">
                <button type="submit" class="btn-primary flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Draf ke Pustaka Edukasi</span>
                </button>
                <button type="button" class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone py-2 px-5 text-body" onclick="resetEditor()">
                    <span>Batal</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const generatorForm = document.getElementById('generator-form');
    const generateBtn = document.getElementById('generate-btn');
    const topicInput = document.getElementById('topic');
    const editorCard = document.getElementById('editor-card');

    const titleInput = document.getElementById('title-input');
    const summaryInput = document.getElementById('summary-input');
    const contentInput = document.getElementById('content-input');
    const categoryInput = document.getElementById('category-input');

    generatorForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const topic = topicInput.value.trim();
        if (!topic) return;

        // Set Loading State
        generateBtn.disabled = true;
        generateBtn.innerHTML = `
            <span class="inline-flex h-3 w-3 animate-pulse rounded-full bg-white mr-2"></span>
            <span>Sedang menyusun materi kakao...</span>
        `;

        fetch("{{ route('admin.ai.generate') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ topic: topic })
        })
        .then(response => response.json())
        .then(data => {
            // Populate form fields
            titleInput.value = data.title;
            summaryInput.value = data.summary;
            contentInput.value = data.content;

            // Automatically try to match categories based on topic text
            const topicLower = topic.toLowerCase();
            if (topicLower.includes('panen') || topicLower.includes('fermentasi') || topicLower.includes('kering') || topicLower.includes('jemur') || topicLower.includes('aroma')) {
                categoryInput.value = 'pasca_panen';
            } else if (topicLower.includes('hama') || topicLower.includes('penyakit') || topicLower.includes('jamur') || topicLower.includes('kanker') || topicLower.includes('ulat')) {
                categoryInput.value = 'hama_penyakit';
            } else {
                categoryInput.value = 'budidaya';
            }

            // Show Editor
            editorCard.classList.remove('hidden');
            editorCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Gagal merumuskan materi edukasi kakao otomatis. Silakan coba kembali beberapa saat lagi.");
        })
        .finally(() => {
            // Restore button state
            generateBtn.disabled = false;
            generateBtn.innerHTML = `
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Generasikan Draf</span>
            `;
            lucide.createIcons();
        });
    });

    function resetEditor() {
        editorCard.classList.add('hidden');
        topicInput.value = '';
        topicInput.focus();
    }
</script>
@endpush
@endsection
