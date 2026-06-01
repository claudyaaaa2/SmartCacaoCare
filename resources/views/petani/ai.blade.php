@extends('layouts.farmer')
@section('title', 'Asisten AI Botani Kakao - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto">
    <div class="mb-10 border-b border-hairline pb-6">
        <div class="flex items-center gap-2 mb-3">
            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[10px] py-[4px] border border-coral-soft">
                <i data-lucide="bot" class="w-3.5 h-3.5 mr-1.5"></i> AI Botanical Assistant
            </span>
        </div>
        <h1 class="text-section-display font-medium text-ink mb-2">Asisten AI Kakao</h1>
        <p class="text-body-large text-muted max-w-[700px]">Konsultasi ahli pertanian kakao bertenaga kecerdasan buatan, otomatis mempelajari riwayat mutu batch biji kakao Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        {{-- Left Column: Analysis Context --}}
        <div>
            <div class="p-8 rounded-lg border border-border-light bg-soft-stone/40">
                <h3 class="text-feature-heading text-ink font-medium mb-4 flex items-center gap-2">
                    <i data-lucide="database" class="w-5 h-5 text-coral"></i> Konteks Batch Anda
                </h3>
                
                @if($latestAnalysis)
                    <p class="text-caption text-muted mb-6">AI akan otomatis mengacu pada analisis terakhir Anda di bawah ini untuk memberikan rekomendasi spesifik:</p>
                    
                    <div class="space-y-4">
                        <div class="py-3 border-b border-hairline/60">
                            <span class="text-micro font-mono uppercase text-muted tracking-wider block">Tanggal Analisis</span>
                            <span class="text-body font-medium text-ink block mt-0.5">{{ $latestAnalysis->created_at->format('d M Y') }}</span>
                        </div>

                        <div class="py-3 border-b border-hairline/60 flex justify-between items-center">
                            <div>
                                <span class="text-micro font-mono uppercase text-muted tracking-wider block">Grade Hasil</span>
                                <span class="text-body-large font-bold text-ink block mt-0.5">Grade {{ $latestAnalysis->grade_hasil }}</span>
                            </div>
                            @php
                                $gradeColors = [
                                    'A' => 'text-deep-green border-deep-green/30',
                                    'B' => 'text-action-blue border-action-blue/30',
                                    'C' => 'text-coral border-coral/30',
                                    'D' => 'text-error border-error/30',
                                ];
                                $color = $gradeColors[$latestAnalysis->grade_hasil] ?? 'text-slate border-hairline';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-micro font-mono border uppercase {{ $color }}">
                                Grade {{ $latestAnalysis->grade_hasil }}
                            </span>
                        </div>

                        <div class="py-3 border-b border-hairline/60">
                            <span class="text-micro font-mono uppercase text-muted tracking-wider block">Keyakinan CF</span>
                            <span class="text-body font-medium text-ink block mt-0.5">{{ number_format($latestAnalysis->persentase_cf, 1) }}% CF</span>
                        </div>

                        <div class="py-3">
                            <span class="text-micro font-mono uppercase text-muted tracking-wider block mb-2">Karakteristik Fisik</span>
                            <div class="flex flex-wrap gap-2">
                                @if(is_array($latestAnalysis->pilihan_user))
                                    @foreach($latestAnalysis->pilihan_user as $key => $choice)
                                        <span class="inline-flex items-center bg-canvas text-[11px] text-ink font-mono rounded-sm px-2 py-0.5 border border-hairline capitalize">
                                            {{ str_replace('_', ' ', $choice) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted font-mono">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-6 bg-canvas border border-card-border rounded-lg">
                        <i data-lucide="alert-circle" class="w-8 h-8 text-muted mx-auto mb-2"></i>
                        <h4 class="text-body font-medium text-ink mb-1">Belum ada analisis</h4>
                        <p class="text-caption text-muted px-4 mb-4">Silakan lakukan analisis pertama agar AI dapat membaca kriteria fisik biji Anda secara kontekstual.</p>
                        <a href="{{ route('petani.analysis') }}" class="btn-pill-outline text-micro py-1 px-3">Mulai Analisis</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Chat Console --}}
        <div class="lg:col-span-2 flex flex-col h-[600px] border border-hairline bg-canvas rounded-lg overflow-hidden shadow-[0_8px_32px_rgba(0,0,0,0.01)]">
            {{-- Chat Header --}}
            <div class="bg-canvas border-b border-hairline p-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-coral/10 border border-coral-soft/20 flex items-center justify-center text-coral">
                        <i data-lucide="bot" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-body font-bold text-ink leading-tight">CacaoCare Assistant</h3>
                        <span class="text-micro font-mono text-deep-green flex items-center gap-1 mt-0.5">
                            <span class="w-1.5 h-1.5 bg-deep-green rounded-full"></span> Online
                        </span>
                    </div>
                </div>
                <div class="text-micro font-mono text-muted uppercase tracking-wider">Gemini 1.5 Flash</div>
            </div>

            {{-- Chat Messages Area --}}
            <div class="flex-1 overflow-y-auto p-6 space-y-4" id="chat-box">
                {{-- Initial AI message --}}
                <div class="flex items-start gap-3 max-w-[80%]">
                    <div class="w-8 h-8 rounded-full bg-coral/10 flex items-center justify-center text-coral flex-shrink-0">
                        <i data-lucide="bot" class="w-4 h-4"></i>
                    </div>
                    <div class="bg-soft-stone/40 border border-hairline p-4 rounded-lg text-body text-ink leading-relaxed">
                        @if($latestAnalysis)
                            Halo! Saya asisten botani **CacaoCare AI**. Saya melihat Anda baru saja menganalisis mutu biji kakao Anda pada tanggal **{{ $latestAnalysis->created_at->format('d M Y') }}** dengan hasil **Grade {{ $latestAnalysis->grade_hasil }}**. 
                            
                            Apakah ada aspek botani dari batch tersebut yang ingin Anda konsultasikan (seperti cara memperbaiki aroma atau ukuran biji), atau adakah kendala seputar perkebunan yang ingin ditanyakan? Saya siap membantu!
                        @else
                            Halo! Selamat datang di **Asisten AI Botani Kakao**. Saya siap mendampingi Anda memberikan panduan penanaman, fermentasi, pemangkasan, hingga penjemuran biji kakao secara higienis dan terstandar.
                            
                            Silakan ajukan pertanyaan Anda mengenai pertanian kakao di bawah ini!
                        @endif
                    </div>
                </div>
            </div>

            {{-- Chat Input Form --}}
            <div class="p-4 border-t border-hairline bg-canvas">
                <form id="chat-form" class="flex gap-3">
                    @csrf
                    <input 
                        type="text" 
                        id="user-input" 
                        placeholder="Tanyakan mengenai mutu, fermentasi, atau perawatan pohon kakao..." 
                        class="flex-1 h-[46px] px-4 rounded-xs border border-border-light bg-canvas text-ink text-body placeholder:text-muted focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral/20 transition-colors"
                        required
                        autocomplete="off"
                    >
                    <button type="submit" class="btn-primary h-[46px] px-6 flex items-center gap-2 flex-shrink-0" id="send-btn">
                        <span>Kirim</span>
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const chatBox = document.getElementById('chat-box');
    const sendBtn = document.getElementById('send-btn');

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = userInput.value.trim();
        if (!message) return;

        // 1. Append user message to chat
        appendUserMessage(message);
        userInput.value = '';

        // Disable input during thinking state
        userInput.disabled = true;
        sendBtn.disabled = true;

        // 2. Append thinking bubble
        const thinkingId = appendThinkingBubble();
        chatBox.scrollTop = chatBox.scrollHeight;

        // 3. POST to chat endpoint
        fetch("{{ route('user.ai.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Remove thinking bubble
            document.getElementById(thinkingId).remove();

            // Append AI response
            appendAiMessage(data.reply);
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById(thinkingId).remove();
            appendAiMessage("Maaf, saya gagal terhubung ke server asisten AI. Mohon periksa kembali koneksi internet Anda.");
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .finally(() => {
            userInput.disabled = false;
            sendBtn.disabled = false;
            userInput.focus();
        });
    });

    function appendUserMessage(message) {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex justify-end';
        
        wrapper.innerHTML = `
            <div class="bg-primary text-on-primary p-4 rounded-lg text-body max-w-[80%] leading-relaxed">
                ${escapeHTML(message)}
            </div>
        `;
        chatBox.appendChild(wrapper);
    }

    function appendThinkingBubble() {
        const id = 'thinking-' + Date.now();
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-start gap-3 max-w-[80%]';
        wrapper.id = id;

        wrapper.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-coral/10 flex items-center justify-center text-coral flex-shrink-0">
                <i data-lucide="bot" class="w-4 h-4"></i>
            </div>
            <div class="bg-soft-stone/40 border border-hairline p-4 rounded-lg text-body text-muted flex items-center gap-2">
                <span class="inline-flex h-2 w-2 animate-pulse rounded-full bg-coral"></span>
                <span>Sedang menyusun rekomendasi botani kakao...</span>
            </div>
        `;
        chatBox.appendChild(wrapper);
        lucide.createIcons();
        return id;
    }

    function appendAiMessage(markdownText) {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-start gap-3 max-w-[80%]';

        // Very basic simple markdown parser for bold, lists, headers and formatting
        let formatted = markdownText
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/### (.*?)\n/g, '<h4 class="font-bold text-ink mt-3 mb-1">$1</h4>')
            .replace(/## (.*?)\n/g, '<h3 class="font-bold text-ink mt-4 mb-2">$1</h3>')
            .replace(/\n\n/g, '<br><br>')
            .replace(/- (.*?)\n/g, '<li class="ml-4 list-disc">$1</li>');

        wrapper.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-coral/10 flex items-center justify-center text-coral flex-shrink-0">
                <i data-lucide="bot" class="w-4 h-4"></i>
            </div>
            <div class="bg-soft-stone/40 border border-hairline p-4 rounded-lg text-body text-ink leading-relaxed space-y-2">
                ${formatted}
            </div>
        `;
        chatBox.appendChild(wrapper);
        lucide.createIcons();
    }

    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag] || tag)
        );
    }
</script>
@endpush
@endsection
