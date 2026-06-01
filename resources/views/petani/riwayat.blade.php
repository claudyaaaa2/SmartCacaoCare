@extends('layouts.farmer')
@section('title', 'Riwayat Analisis Anda - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto">
    <div class="mb-12 border-b border-hairline pb-8">
        <div class="flex items-center gap-2 mb-6">
            <span class="inline-flex items-center justify-center bg-transparent text-coral text-micro uppercase tracking-wider font-mono rounded-sm px-[10px] py-[4px] border border-coral-soft">
                <i data-lucide="clock" class="w-3.5 h-3.5 mr-1.5"></i> Riwayat Console
            </span>
        </div>
        <h1 class="text-section-display mb-6 text-ink">Riwayat Analisis Anda</h1>
        <p class="text-body-large text-muted max-w-[600px]">Daftar seluruh riwayat penilaian kualitas biji kakao Anda yang dihitung menggunakan Certainty Factor.</p>
    </div>

    @if($riwayat->count())
        <div class="border border-hairline bg-canvas rounded-lg overflow-hidden shadow-[0_8px_32px_rgba(0,0,0,0.01)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-hairline bg-soft-stone/10 text-mono-label text-muted">
                            <th class="py-4 px-6 font-medium w-[80px]">No</th>
                            <th class="py-4 px-6 font-medium">Tanggal</th>
                            <th class="py-4 px-6 font-medium">Karakteristik Biji</th>
                            <th class="py-4 px-6 font-medium">Grade Hasil</th>
                            <th class="py-4 px-6 font-medium">Tingkat Keyakinan</th>
                            <th class="py-4 px-6 font-medium">Rekomendasi Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hairline">
                        @foreach($riwayat as $item)
                        @php
                            $gradeColors = [
                                'A' => 'text-deep-green border-deep-green/30 bg-transparent',
                                'B' => 'text-action-blue border-action-blue/30 bg-transparent',
                                'C' => 'text-coral border-coral/30 bg-transparent',
                                'D' => 'text-error border-error/30 bg-transparent',
                            ];
                            $color = $gradeColors[$item->grade_hasil] ?? 'text-slate border-hairline bg-transparent';
                        @endphp
                        <tr class="hover:bg-soft-stone/20 transition-colors">
                            <td class="py-5 px-6 text-body text-muted font-mono">
                                {{ sprintf('%02d', ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration) }}
                            </td>
                            <td class="py-5 px-6 text-body text-ink">
                                <div class="font-medium">{{ $item->created_at->format('d M Y') }}</div>
                                <div class="text-caption text-muted mt-0.5">{{ $item->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="py-5 px-6 text-caption text-muted">
                                @if(is_array($item->pilihan_user))
                                    <div class="flex flex-wrap gap-2 max-w-[320px]">
                                        @foreach($item->pilihan_user as $key => $choice)
                                            <span class="inline-flex items-center bg-soft-stone/30 text-[11px] text-ink font-mono rounded-sm px-2 py-0.5 border border-hairline/60 capitalize" title="{{ str_replace('_', ' ', $key) }}">
                                                {{ str_replace('_', ' ', $key) }}: <strong class="text-coral ml-1">{{ str_replace('_', ' ', $choice) }}</strong>
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted font-mono">-</span>
                                @endif
                            </td>
                            <td class="py-5 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-micro font-mono border uppercase {{ $color }}">
                                    Grade {{ $item->grade_hasil }}
                                </span>
                            </td>
                            <td class="py-5 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-micro font-mono border border-hairline bg-soft-stone/20 text-ink">
                                    {{ number_format($item->persentase_cf, 1) }}% CF
                                </span>
                            </td>
                            <td class="py-5 px-6 text-caption text-muted max-w-[320px] leading-relaxed" title="{{ $item->rekomendasi }}">
                                {{ $item->rekomendasi }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($riwayat->hasPages())
            <div class="p-6 border-t border-hairline bg-canvas">
                {{ $riwayat->links() }}
            </div>
            @endif

        </div>
    @else
        <div class="bg-canvas border border-card-border p-12 text-center rounded-lg shadow-sm flex flex-col items-center justify-center min-h-[300px]">
            <i data-lucide="clock" class="w-12 h-12 text-muted mb-4 flex-shrink-0"></i>
            <h3 class="text-body-large text-ink font-medium mb-1">Belum ada riwayat analisis</h3>
            <p class="text-caption text-muted mb-6 max-w-[320px]">Silakan lakukan analisis pertama Anda untuk melihat riwayat penilaian batch biji kakao Anda.</p>
            <a href="{{ route('petani.analysis') }}" class="btn-primary">Mulai Analisis</a>
        </div>
    @endif
</div>
@endsection
