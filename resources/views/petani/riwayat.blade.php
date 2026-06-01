@extends('layouts.farmer')
@section('title', 'Riwayat Analisis Anda - SmartCacaoCare')

@section('content')
<div class="max-w-[1200px] mx-auto">
    <div class="mb-12 border-b border-hairline pb-8">
        <div class="flex items-center gap-2 mb-6">
            <span class="blog-filter-chip"><i data-lucide="clock" class="w-4 h-4 mr-2"></i> Riwayat</span>
        </div>
        <h1 class="text-section-display mb-6 text-ink">Riwayat Analisis Anda</h1>
        <p class="text-body-large text-muted max-w-[600px]">Daftar seluruh riwayat penilaian kualitas biji kakao Anda yang dihitung menggunakan Certainty Factor.</p>
    </div>

    @if($riwayat->count())
        <div class="contact-form-card p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-border-light bg-soft-stone/50 text-mono-label text-muted">
                            <th class="py-4 px-6 font-medium w-[80px]">No</th>
                            <th class="py-4 px-6 font-medium">Tanggal</th>
                            <th class="py-4 px-6 font-medium">Karakteristik Biji</th>
                            <th class="py-4 px-6 font-medium">Grade Hasil</th>
                            <th class="py-4 px-6 font-medium">Tingkat Keyakinan</th>
                            <th class="py-4 px-6 font-medium">Rekomendasi Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @foreach($riwayat as $item)
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
                            <td class="py-4 px-6 text-body text-muted">
                                {{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}
                            </td>
                            <td class="py-4 px-6 text-body text-ink">
                                <div class="font-medium">{{ $item->created_at->format('d M Y') }}</div>
                                <div class="text-caption text-muted">{{ $item->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="py-4 px-6 text-caption text-muted max-w-[250px]">
                                @if(is_array($item->pilihan_user))
                                    <div class="flex flex-col gap-1">
                                        @foreach($item->pilihan_user as $key => $choice)
                                            <div>
                                                <span class="font-medium text-ink capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                <span class="italic">"{{ $choice }}"</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    -
                                @endif
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
                            <td class="py-4 px-6 text-caption text-muted max-w-[320px]" title="{{ $item->rekomendasi }}">
                                {{ $item->rekomendasi }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($riwayat->hasPages())
            <div class="p-6 border-t border-border-light bg-canvas">
                {{ $riwayat->links() }}
            </div>
            @endif

        </div>
    @else
        <div class="product-card min-h-[300px] flex flex-col items-center justify-center text-center">
            <i data-lucide="clock" class="w-12 h-12 text-muted mb-4"></i>
            <h3 class="text-body-large text-ink font-medium mb-2">Belum ada riwayat analisis</h3>
            <p class="text-caption text-muted mb-6">Silakan lakukan analisis pertama Anda untuk melihat riwayat penilaian batch biji kakao Anda.</p>
            <a href="{{ route('petani.analysis') }}" class="btn-primary">Mulai Analisis</a>
        </div>
    @endif
</div>
@endsection
