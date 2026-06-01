@extends(auth()->check() ? 'layouts.farmer' : 'layouts.app')
@section('title', 'Analisis Mutu Kakao - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto {{ auth()->check() ? '' : 'px-[24px] py-[80px]' }}">
    <div class="{{ auth()->check() ? 'mb-12 border-b border-hairline pb-8' : 'mb-[64px] border-b border-hairline pb-[40px]' }}">
        <div class="flex items-center gap-2 mb-6">
            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[10px] py-[4px] border border-coral-soft">
                <i data-lucide="search" class="w-3.5 h-3.5 mr-1.5"></i> Analisis Mutu
            </span>
        </div>
        <h1 class="text-section-display mb-6 text-ink">Cek kepastian<br>grade kakao Anda.</h1>
        <p class="text-body-large text-muted max-w-[600px] mb-8">Pilih kondisi kriteria biji kakao Anda saat ini untuk melihat prediksi kualitas dan grade menggunakan metode Certainty Factor.</p>
        
        @auth
            <div>
                <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone py-2.5 px-5" href="{{ route('user.dashboard') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Dashboard</a>
            </div>
        @else
            <div>
                <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone py-2.5 px-5" href="{{ url('/') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Halaman Utama</a>
            </div>
        @endauth
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Section --}}
        <div class="lg:col-span-2">
            <div class="contact-form-card">
                <form action="{{ route('petani.analyze') }}" method="POST" class="flex flex-col gap-6">
                    @csrf
                    
                    @if($errors->any())
                        <div class="bg-error/10 text-error p-4 rounded-xs mb-4 text-body border border-error/20">
                            <div class="flex items-center gap-2 mb-2 font-medium"><i data-lucide="alert-triangle" class="w-4 h-4"></i> Mohon lengkapi semua kriteria</div>
                        </div>
                    @endif

                    @foreach($criteria as $key => $item)
                        <div>
                            <label class="form-label text-ink">{{ $item['label'] }}</label>
                            <p class="text-micro text-muted mb-2">Pilih kondisi yang paling sesuai.</p>
                            
                            <select name="{{ $key }}" class="form-select @error($key) border-error @enderror">
                                <option value="">-- Pilih kondisi --</option>
                                @foreach(($item['options'] ?? $options) as $optionKey => $optionLabel)
                                    <option value="{{ $optionKey }}" {{ (old($key) ?? ($selected[$key] ?? '')) == $optionKey ? 'selected' : '' }}>
                                        {{ $optionLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

                    <div class="mt-8 pt-6 border-t border-hairline">
                        <button type="submit" class="btn-primary w-full md:w-auto"><i data-lucide="search" class="w-4 h-4 mr-2"></i> Analisis Sekarang</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Result Section --}}
        <div>
            @if(isset($result))
                <div class="agent-console-card sticky top-[24px]">
                    <div class="text-mono-label text-action-blue mb-4 flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4"></i> HASIL ANALISIS</div>
                    
                    @if(isset($result['error']))
                        <div class="bg-error/20 text-white p-4 rounded-xs mb-4">
                            <i data-lucide="alert-circle" class="w-5 h-5 mb-2"></i>
                            <p class="text-body">{{ $result['error'] }}</p>
                        </div>
                    @else
                        <h3 class="text-card-heading text-on-dark mb-2">{{ $result['best_grade']['label'] }}</h3>
                        <div class="text-[32px] font-display font-medium text-coral mb-6">{{ number_format($result['best_grade']['confidence'] * 100, 1) }}%</div>
                        
                        <div class="border-t border-ink pt-4 mb-4">
                            <p class="text-caption text-muted mb-3 uppercase tracking-wider">Kemungkinan Lain:</p>
                            <ul class="flex flex-col gap-2">
                                @foreach($result['rankings'] as $grade)
                                    @if($grade['label'] !== $result['best_grade']['label'])
                                        <li class="flex items-center justify-between text-body">
                                            <span class="text-muted">{{ $grade['label'] }}</span>
                                            <span class="text-on-dark">{{ number_format($grade['confidence'] * 100, 1) }}%</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('mainpage.edukasi') }}" class="btn-primary-white w-full text-center">Lihat Rekomendasi Edukasi</a>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-canvas border border-card-border p-12 text-center rounded-lg shadow-sm flex flex-col items-center justify-center min-h-[300px]">
                    <i data-lucide="inbox" class="w-12 h-12 text-muted mb-4 flex-shrink-0"></i>
                    <h3 class="text-body-large text-ink font-medium mb-1">Belum ada hasil</h3>
                    <p class="text-caption text-muted max-w-[280px]">Silakan isi formulir kriteria di samping dan klik analisis untuk melihat hasil.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
