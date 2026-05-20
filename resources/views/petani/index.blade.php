@extends('layouts.app')
@section('title', 'Analisis Mutu Kakao - SmartCacaoCare')

@section('nav')
<nav class="hidden md:flex items-center gap-6 text-body font-medium">
    <a href="{{ route('petani.analysis') }}" class="text-coral hover:text-coral-soft transition-colors flex items-center gap-2"><i data-lucide="search" class="w-4 h-4"></i> Analisis</a>
    <a href="{{ route('mainpage.edukasi') }}" class="text-ink hover:text-action-blue transition-colors flex items-center gap-2"><i data-lucide="book-open" class="w-4 h-4"></i> Edukasi</a>
</nav>
@endsection

@section('content')
<div class="max-w-[1200px] mx-auto px-[24px] py-[80px]">
    <div class="mb-[64px] border-b border-hairline pb-[40px]">
        <div class="flex items-center gap-2 mb-6">
            <span class="blog-filter-chip border-action-blue text-action-blue hover:bg-action-blue hover:text-white"><i data-lucide="search" class="w-4 h-4 mr-2"></i> Analisis Mutu</span>
        </div>
        <h1 class="text-section-display mb-6 text-ink">Cek kepastian<br>grade kakao Anda.</h1>
        <p class="text-body-large text-muted max-w-[600px] mb-8">Pilih kondisi kriteria biji kakao Anda saat ini untuk melihat prediksi kualitas dan grade menggunakan metode Certainty Factor.</p>
        
        @auth
            <div>
                <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone" href="{{ route('user.dashboard') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Dashboard</a>
            </div>
        @else
            <div>
                <a class="btn-pill-outline border-border-light text-ink hover:bg-soft-stone" href="{{ url('/') }}"><i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Halaman Utama</a>
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
                                @foreach($options as $optionKey => $option)
                                    <option value="{{ $optionKey }}" {{ (old($key) ?? ($selected[$key] ?? '')) == $optionKey ? 'selected' : '' }}>
                                        {{ $option['label'] }}
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
                        <h3 class="text-card-heading text-on-dark mb-2">Grade {{ $result['best_grade']['name'] }}</h3>
                        <div class="text-[32px] font-display font-medium text-coral mb-6">{{ number_format($result['best_grade']['cf'] * 100, 1) }}%</div>
                        
                        <div class="border-t border-ink pt-4 mb-4">
                            <p class="text-caption text-muted mb-3 uppercase tracking-wider">Kemungkinan Lain:</p>
                            <ul class="flex flex-col gap-2">
                                @foreach($result['all_grades'] as $grade)
                                    @if($grade['name'] !== $result['best_grade']['name'])
                                        <li class="flex items-center justify-between text-body">
                                            <span class="text-muted">Grade {{ $grade['name'] }}</span>
                                            <span class="text-on-dark">{{ number_format($grade['cf'] * 100, 1) }}%</span>
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
                <div class="product-card min-h-[300px] flex flex-col items-center justify-center text-center">
                    <i data-lucide="inbox" class="w-12 h-12 text-muted mb-4"></i>
                    <h3 class="text-body-large text-ink font-medium mb-2">Belum ada hasil</h3>
                    <p class="text-caption text-muted">Silakan isi formulir kriteria di samping dan klik analisis untuk melihat hasil.</p>
                </div>
            @endif
        </div>
    </div>
</div>
<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
@endsection
