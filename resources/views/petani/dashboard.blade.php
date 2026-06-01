@extends('layouts.farmer')
@section('title', 'Dashboard Petani - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto">
    <div class="mb-12">
        <div class="flex items-center gap-2 mb-4">
            <span class="blog-filter-chip"><i data-lucide="layout-dashboard" class="w-4 h-4 mr-2"></i> Dashboard</span>
        </div>
        <h1 class="text-section-display mb-4 text-ink">Selamat datang kembali.</h1>
        <p class="text-body-large text-muted max-w-[600px]">Pantau alur mutu kakao dari satu halaman. Analisis, baca grade, lalu buka edukasi yang relevan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Stats cards --}}
        <div class="agent-console-card flex flex-col justify-between min-h-[200px]">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="clock" class="w-4 h-4 text-coral"></i> TOTAL ANALISIS ANDA</div>
            <div>
                <div class="text-[48px] font-display font-medium leading-none mb-2 text-coral">{{ $totalAnalisis }}</div>
                <div class="text-caption text-muted">Jumlah batch biji kakao yang sudah Anda evaluasi mutunya.</div>
            </div>
        </div>

        <div class="product-card flex flex-col justify-between min-h-[200px] border border-border-light">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="star" class="w-4 h-4 text-coral"></i> GRADE REFERENSI</div>
            <div>
                <div class="text-[48px] font-display font-medium leading-none mb-2 text-ink">{{ $gradeCount }}</div>
                <div class="text-caption text-muted">Jumlah grade yang menjadi acuan penilaian kualitas.</div>
            </div>
        </div>

        <div class="product-card flex flex-col justify-between min-h-[200px] border border-border-light">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="settings" class="w-4 h-4 text-action-blue"></i> PARAMETER</div>
            <div>
                <div class="text-card-heading mb-2 text-ink">{{ implode(' · ', $fieldLabels) }}</div>
                <div class="text-caption text-muted">Parameter utama yang digunakan dalam perhitungan.</div>
            </div>
        </div>

        {{-- Workflow card --}}
        <div class="lg:col-span-2 capability-card bg-canvas border border-card-border p-[32px] rounded-lg">
            <div class="text-mono-label text-muted flex items-center gap-2 mb-6"><i data-lucide="route" class="w-4 h-4 text-primary"></i> LANGKAH KERJA</div>
            <h3 class="text-card-heading text-ink mb-2">Alur analisis mutu kakao</h3>
            <p class="text-body text-muted mb-8 max-w-[500px]">Pakai alur singkat ini saat ingin cek mutu batch kakao.</p>
            <ul class="flex flex-col gap-4">
                <li class="flex items-start gap-4 p-4 rounded-xs hover:bg-soft-stone transition-colors border border-hairline">
                    <i data-lucide="clipboard-check" class="w-6 h-6 text-action-blue flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="block text-body font-medium text-ink">Pilih Kondisi</strong>
                        <span class="text-caption text-muted">Masuk ke halaman analisis dan tentukan kondisi tiap kriteria.</span>
                    </div>
                </li>
                <li class="flex items-start gap-4 p-4 rounded-xs hover:bg-soft-stone transition-colors border border-hairline">
                    <i data-lucide="trophy" class="w-6 h-6 text-coral flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="block text-body font-medium text-ink">Bandingkan Hasil</strong>
                        <span class="text-caption text-muted">Lihat grade tertinggi, lalu bandingkan seluruh ranking kepastian.</span>
                    </div>
                </li>
                <li class="flex items-start gap-4 p-4 rounded-xs hover:bg-soft-stone transition-colors border border-hairline">
                    <i data-lucide="book-open" class="w-6 h-6 text-coral flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="block text-body font-medium text-ink">Tindak Lanjut</strong>
                        <span class="text-caption text-muted">Buka edukasi untuk perbaikan pasca panen jika diperlukan.</span>
                    </div>
                </li>
            </ul>
        </div>

        {{-- Quick actions & Focus --}}
        <div class="flex flex-col gap-6">
            <div class="bg-deep-green text-on-dark p-[32px] rounded-lg border border-ink shadow-xl relative overflow-hidden flex-1 flex flex-col justify-center">
                <div class="absolute top-0 right-0 w-[150px] h-[150px] bg-action-blue opacity-20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
                <div class="text-mono-label text-muted flex items-center gap-2 mb-4 relative z-10"><i data-lucide="zap" class="w-4 h-4 text-action-blue"></i> AKSI CEPAT</div>
                <ul class="flex flex-col gap-3 relative z-10">
                    <li><a href="{{ route('petani.analysis') }}" class="flex items-center gap-3 text-body font-medium hover:text-action-blue transition-colors"><i data-lucide="arrow-right" class="w-4 h-4"></i> Buka Analisis</a></li>
                    <li><a href="{{ route('mainpage.edukasi') }}" class="flex items-center gap-3 text-body font-medium text-coral hover:text-coral-soft transition-colors"><i data-lucide="arrow-right" class="w-4 h-4"></i> Buka Edukasi</a></li>
                </ul>
            </div>
            
            <div class="product-card min-h-[160px] border border-border-light">
                <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="target" class="w-4 h-4 text-coral"></i> FOKUS HARI INI</div>
                <ul class="flex flex-col gap-2 text-body">
                    <li class="flex items-center gap-2"><div class="w-1.5 h-1.5 bg-primary rounded-full"></div> Warna biji</li>
                    <li class="flex items-center gap-2"><div class="w-1.5 h-1.5 bg-primary rounded-full"></div> Ukuran keseragaman</li>
                    <li class="flex items-center gap-2"><div class="w-1.5 h-1.5 bg-primary rounded-full"></div> Aroma & tekstur</li>
                </ul>
            </div>
        </div>
    </div>

    @if($riwayatTerbaru->count())
        <div class="mt-12 border-t border-hairline pt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-card-heading text-ink font-medium">Analisis Terbaru Anda</h2>
                <a href="{{ route('user.riwayat') }}" class="btn-secondary flex items-center gap-1 text-action-blue font-medium hover:underline">
                    Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            
            <div class="contact-form-card p-0 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-border-light bg-soft-stone/50 text-mono-label text-muted">
                                <th class="py-4 px-6 font-medium w-[80px]">No</th>
                                <th class="py-4 px-6 font-medium">Tanggal</th>
                                <th class="py-4 px-6 font-medium">Grade Hasil</th>
                                <th class="py-4 px-6 font-medium">Tingkat Keyakinan</th>
                                <th class="py-4 px-6 font-medium">Rekomendasi Penanganan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light">
                            @foreach($riwayatTerbaru as $item)
                            @php
                                $gradeColors = [
                                    'A' => 'text-green-700 bg-green-50 border-green-200',
                                    'B' => 'text-blue-700 bg-blue-50 border-blue-200',
                                    'C' => 'text-amber-700 bg-amber-50 border-amber-200',
                                    'D' => 'text-red-700 bg-red-50 border-red-200',
                                ];
                                $color = $gradeColors[$item->grade_hasil] ?? 'text-slate bg-soft-stone border-border-light';
                            @endphp
                            <tr class="hover:bg-soft-stone/30 transition-colors">
                                <td class="py-4 px-6 text-body text-muted">{{ $loop->iteration }}</td>
                                <td class="py-4 px-6 text-body text-ink">
                                    <span class="font-medium">{{ $item->created_at->format('d M Y') }}</span>
                                    <span class="text-caption text-muted ml-2">{{ $item->created_at->format('H:i') }} WIB</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border {{ $color }}">
                                        Grade {{ $item->grade_hasil }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border border-border-light bg-soft-stone/50 text-ink">
                                        {{ number_format($item->persentase_cf, 1) }}%
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-caption text-muted max-w-[300px] truncate" title="{{ $item->rekomendasi }}">
                                    {{ $item->rekomendasi }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
