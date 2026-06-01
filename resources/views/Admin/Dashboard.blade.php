@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Ikhtisar aktivitas dan data sistem')

@section('content')
<div class="max-w-[1200px] mx-auto">
    {{-- Left-Aligned Stacked Editorial Header --}}
    <div class="mb-12 pb-8 border-b border-hairline">
        <div class="flex items-center gap-2 mb-3">
            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[10px] py-[4px] border border-coral-soft">
                <i data-lucide="layout-dashboard" class="w-3.5 h-3.5 mr-1.5"></i> Admin Console
            </span>
        </div>
        <h1 class="text-section-display font-medium text-ink mb-3">Ikhtisar Sistem Kakao.</h1>
        <p class="text-body-large text-muted max-w-[750px]">Pantau aktivitas pengguna terdaftar, total sesi pengujian Certainty Factor, manajemen draf materi edukasi perkebunan, serta optimasi rule data master.</p>
    </div>

{{-- Unframed Technical Metrics Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 border border-hairline bg-canvas rounded-lg overflow-hidden mb-16 shadow-[0_8px_32px_rgba(0,0,0,0.01)]">
    
    {{-- Metric 1: Total User --}}
    <div class="p-8 border-b md:border-b-0 md:border-r border-hairline flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
        <div class="text-mono-label text-muted flex items-center gap-2"><span class="text-coral">01 /</span> TOTAL USER</div>
        <div class="mt-4">
            <div class="text-[64px] font-display font-normal leading-none mb-2 text-coral tracking-tighter">{{ $totalUser }}</div>
            <div class="text-caption text-muted">Pengguna perkebunan aktif.</div>
        </div>
    </div>

    {{-- Metric 2: Analisis --}}
    <div class="p-8 border-b md:border-b-0 md:border-r border-hairline flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
        <div class="text-mono-label text-muted flex items-center gap-2"><span>02 /</span> TOTAL ANALISIS</div>
        <div class="mt-4">
            <div class="text-[64px] font-display font-normal leading-none mb-2 text-ink tracking-tighter">{{ $totalAnalisis }}</div>
            <div class="text-caption text-muted">Sesi pengujian Certainty Factor.</div>
        </div>
    </div>

    {{-- Metric 3: Edukasi --}}
    <div class="p-8 border-b md:border-b-0 md:border-r border-hairline flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
        <div class="text-mono-label text-muted flex items-center gap-2"><span>03 /</span> MATERI EDUKASI</div>
        <div class="mt-4">
            <div class="text-[64px] font-display font-normal leading-none mb-2 text-ink tracking-tighter">{{ $totalEdukasi }}</div>
            <div class="text-caption text-muted">Artikel panduan pasca panen.</div>
        </div>
    </div>

    {{-- Metric 4: Rule CF --}}
    <div class="p-8 flex flex-col justify-between min-h-[180px] hover:bg-soft-stone/10 transition-colors">
        <div class="text-mono-label text-muted flex items-center gap-2"><span>04 /</span> ATURAN RULE CF</div>
        <div class="mt-4">
            <div class="text-[64px] font-display font-normal leading-none mb-2 text-ink tracking-tighter">{{ $totalRule }}</div>
            <div class="text-caption text-muted">Formula penentu grade aktif.</div>
        </div>
    </div>

</div>

{{-- Two-Column Asymmetric Layout --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
    
    {{-- Left Column (65%): Riwayat Analisis Terbaru (Row-based list style) --}}
    <div class="xl:col-span-2 flex flex-col gap-6">
        <div class="flex justify-between items-center pb-4 border-b border-hairline">
            <h2 class="text-card-heading text-ink font-medium flex items-center gap-2.5">
                <i data-lucide="history" class="w-5.5 h-5.5 text-coral"></i> Riwayat Analisis Terbaru
            </h2>
            <a href="{{ route('admin.riwayat.index') }}" class="text-caption text-action-blue hover:underline font-medium flex items-center gap-1">
                Lihat Semua Riwayat <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        @if($riwayatTerbaru->count())
            <div class="flex flex-col">
                @foreach($riwayatTerbaru as $item)
                @php
                    $gradeColors = [
                        'A' => 'text-deep-green border-deep-green/30 bg-transparent',
                        'B' => 'text-action-blue border-action-blue/30 bg-transparent',
                        'C' => 'text-coral border-coral/30 bg-transparent',
                        'D' => 'text-error border-error/30 bg-transparent',
                    ];
                    $color = $gradeColors[$item->grade_hasil] ?? 'text-slate border-hairline bg-transparent';
                @endphp
                
                {{-- Rule separated flex row --}}
                <div class="py-5 border-b border-hairline flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:px-2 hover:bg-soft-stone/20 rounded-xs transition-all">
                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-micro font-mono border uppercase {{ $color }}">
                                Grade {{ $item->grade_hasil }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-micro font-mono border border-hairline bg-soft-stone/30 text-ink">
                                {{ number_format($item->persentase_cf, 1) }}% CF
                              </span>
                              <span class="text-caption text-ink font-medium">oleh {{ $item->user->name }}</span>
                          </div>
                          <p class="text-caption text-muted max-w-[450px] line-clamp-1" title="{{ $item->rekomendasi }}">
                              {{ $item->rekomendasi }}
                          </p>
                      </div>
                      <div class="text-left sm:text-right flex-shrink-0">
                          <div class="text-caption text-ink font-medium">{{ $item->created_at->format('d M Y') }}</div>
                          <div class="text-micro text-muted mt-0.5">{{ $item->created_at->format('H:i') }} WIB</div>
                      </div>
                  </div>
                  @endforeach
              </div>
          @else
              <div class="bg-canvas border border-card-border p-12 text-center rounded-lg shadow-sm flex flex-col items-center justify-center min-h-[250px]">
                  <i data-lucide="inbox" class="w-12 h-12 text-muted mb-4"></i>
                  <h3 class="text-body-large text-ink font-medium mb-1">Belum ada riwayat</h3>
                  <p class="text-caption text-muted max-w-[320px]">Data pengujian Certainty Factor akan muncul di sini secara otomatis.</p>
              </div>
          @endif
      </div>
  
      {{-- Right Column (35%): Alur Kerja & Status Sistem --}}
      <div class="flex flex-col gap-8">
          
          {{-- Alur Kerja Perawatan Sistem (Timeline Style) --}}
          <div class="contact-form-card p-8 bg-canvas">
              <h3 class="text-feature-heading text-ink font-medium mb-6 flex items-center gap-2">
                  <i data-lucide="route" class="w-5 h-5 text-coral"></i> Protokol Operasional Admin
              </h3>
              <ul class="flex flex-col gap-6 pl-4 border-l border-hairline">
                  <li class="relative">
                      <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-coral rounded-full ring-4 ring-coral/20"></div>
                      <div class="pl-2">
                          <span class="text-mono-label text-micro text-coral">Protokol 01</span>
                          <strong class="block text-body font-medium text-ink mt-0.5">Monitoring Sesi Analisis</strong>
                          <span class="text-caption text-muted mt-1 block">Tinjau kelayakan kriteria fisik yang diuji oleh petani di dashboard.</span>
                      </div>
                  </li>
                  <li class="relative">
                      <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-ink rounded-full ring-4 ring-ink/10"></div>
                      <div class="pl-2">
                          <span class="text-mono-label text-micro text-muted">Protokol 02</span>
                          <strong class="block text-body font-medium text-ink mt-0.5">Optimasi Rule CF</strong>
                          <span class="text-caption text-muted mt-1 block">Kelola bobot keyakinan Certainty Factor berdasarkan data riset.</span>
                      </div>
                  </li>
                  <li class="relative">
                      <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-ink rounded-full ring-4 ring-ink/10"></div>
                      <div class="pl-2">
                          <span class="text-mono-label text-micro text-muted">Protokol 03</span>
                          <strong class="block text-body font-medium text-ink mt-0.5">Penyusunan Edukasi (AI)</strong>
                          <span class="text-caption text-muted mt-1 block">Rilis draf panduan pasca panen terbaru menggunakan asisten AI.</span>
                      </div>
                  </li>
              </ul>
          </div>
  
          {{-- Fokus Sistem Hari Ini --}}
          <div class="p-8 rounded-lg border border-border-light bg-soft-stone/40">
              <h3 class="text-feature-heading text-ink font-medium mb-4 flex items-center gap-2">
                  <i data-lucide="shield-check" class="w-5 h-5 text-coral"></i> Status Konsol & Keamanan
              </h3>
              <p class="text-caption text-muted mb-6">Status operasional komponen utama SmartCacaoCare hari ini:</p>
              <div class="flex flex-col gap-3">
                  <div class="flex items-center gap-3 py-2 border-b border-hairline/60">
                      <i data-lucide="check" class="w-4 h-4 text-coral flex-shrink-0"></i>
                      <span class="text-body text-ink">Certainty Factor Engine (Aktif)</span>
                  </div>
                  <div class="flex items-center gap-3 py-2 border-b border-hairline/60">
                      <i data-lucide="check" class="w-4 h-4 text-coral flex-shrink-0"></i>
                      <span class="text-body text-ink">Google Gemini API (Terhubung)</span>
                  </div>
                  <div class="flex items-center gap-3 py-2">
                      <i data-lucide="check" class="w-4 h-4 text-coral flex-shrink-0"></i>
                      <span class="text-body text-ink">Database Registry (Sehat)</span>
                  </div>
              </div>
        </div>

    </div>

</div>
</div>
@endsection