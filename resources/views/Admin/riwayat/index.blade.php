@extends('layouts.admin')

@section('title', 'Riwayat Analisis')
@section('subtitle', 'Semua riwayat analisis user')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-section-heading text-ink m-0">Riwayat Analisis</h2>
        <p class="text-caption text-muted mt-1">Total {{ $riwayat->total() }} analisis</p>
    </div>
</div>

@if($riwayat->count())
    <div class="contact-form-card p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-border-light bg-soft-stone/50 text-mono-label text-muted">
                        <th class="py-4 px-6 font-medium w-[80px]">No</th>
                        <th class="py-4 px-6 font-medium">User</th>
                        <th class="py-4 px-6 font-medium">Tanggal</th>
                        <th class="py-4 px-6 font-medium">Grade</th>
                        <th class="py-4 px-6 font-medium">Keyakinan</th>
                        <th class="py-4 px-6 font-medium">Rekomendasi</th>
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
                        <td class="py-4 px-6">
                            <div class="font-medium text-ink">{{ $item->user->name }}</div>
                            <small class="text-caption text-muted">{{ $item->user->email }}</small>
                        </td>
                        <td class="py-4 px-6 text-body">
                            <div class="text-ink">{{ $item->created_at->format('d M Y') }}</div>
                            <small class="text-caption text-muted">{{ $item->created_at->format('H:i') }} WIB</small>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border {{ $color }}">
                                Grade {{ $item->grade_hasil }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border border-border-light bg-soft-stone/50 text-ink">
                                {{ number_format($item->persentase_cf, 1) }}% confidence
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

        {{-- PAGINATION --}}
        @if($riwayat->hasPages())
        <div class="p-6 border-t border-border-light bg-canvas">
            {{ $riwayat->links() }}
        </div>
        @endif

    </div>
@else
    <div class="contact-form-card py-12 text-center">
        <i data-lucide="clock" class="w-12 h-12 text-muted mx-auto mb-4"></i>
        <h3 class="text-body-large text-ink font-medium mb-2">Belum ada riwayat analisis</h3>
        <p class="text-caption text-muted">Data analisis user akan tampil di sini setelah ada proses analisis.</p>
    </div>
@endif

@endsection