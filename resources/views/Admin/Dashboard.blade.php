@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Ikhtisar aktivitas dan data sistem')

@section('content')

{{-- STATS CARD --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="product-card flex flex-col justify-between min-h-[160px]">
        <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="users" class="w-4 h-4 text-action-blue"></i> TOTAL USER</div>
        <div>
            <div class="text-[48px] font-display font-medium leading-none mb-2 text-ink">{{ $totalUser }}</div>
            <div class="text-caption text-muted">Pengguna terdaftar.</div>
        </div>
    </div>

    <div class="product-card flex flex-col justify-between min-h-[160px]">
        <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="bar-chart-2" class="w-4 h-4 text-primary"></i> ANALISIS</div>
        <div>
            <div class="text-[48px] font-display font-medium leading-none mb-2 text-ink">{{ $totalAnalisis }}</div>
            <div class="text-caption text-muted">Total sesi analisis.</div>
        </div>
    </div>

    <div class="product-card flex flex-col justify-between min-h-[160px]">
        <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="book-open" class="w-4 h-4 text-coral"></i> EDUKASI</div>
        <div>
            <div class="text-[48px] font-display font-medium leading-none mb-2 text-ink">{{ $totalEdukasi }}</div>
            <div class="text-caption text-muted">Artikel materi diterbitkan.</div>
        </div>
    </div>

    <div class="product-card flex flex-col justify-between min-h-[160px]">
        <div class="text-mono-label text-muted flex items-center gap-2 mb-4"><i data-lucide="git-merge" class="w-4 h-4 text-ink"></i> RULE CF</div>
        <div>
            <div class="text-[48px] font-display font-medium leading-none mb-2 text-ink">{{ $totalRule }}</div>
            <div class="text-caption text-muted">Aturan perhitungan aktif.</div>
        </div>
    </div>
</div>

{{-- RIWAYAT TERBARU --}}
<div class="contact-form-card p-0 overflow-hidden">
    <div class="bg-canvas border-b border-border-light py-4 px-6 flex justify-between items-center">
        <h6 class="text-card-heading m-0 flex items-center gap-2">
            <i data-lucide="clock" class="w-5 h-5 text-muted"></i> Riwayat Analisis Terbaru
        </h6>
        <a href="{{ route('admin.riwayat.index') }}" class="btn-pill-outline text-ink hover:bg-soft-stone py-1.5 px-4 text-caption">
            Lihat Semua
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-border-light bg-soft-stone/50 text-mono-label text-muted">
                    <th class="py-4 px-6 font-medium">User</th>
                    <th class="py-4 px-6 font-medium">Tanggal</th>
                    <th class="py-4 px-6 font-medium">Grade</th>
                    <th class="py-4 px-6 font-medium">Keyakinan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-light">
                @forelse($riwayatTerbaru as $item)
                @php
                    $gradeColors = [
                        'A' => 'text-success bg-success/10 border-success/20',
                        'B' => 'text-action-blue bg-action-blue/10 border-action-blue/20',
                        'C' => 'text-coral bg-coral/10 border-coral/20',
                        'D' => 'text-error bg-error/10 border-error/20',
                    ];
                    $barColors = [
                        'A' => 'bg-success',
                        'B' => 'bg-action-blue',
                        'C' => 'bg-coral',
                        'D' => 'bg-error',
                    ];
                    $color = $gradeColors[$item->grade_hasil] ?? 'text-muted bg-soft-stone border-border-light';
                    $barColor = $barColors[$item->grade_hasil] ?? 'bg-muted';
                @endphp
                <tr class="hover:bg-soft-stone/30 transition-colors">
                    <td class="py-4 px-6">
                        <div class="text-body font-medium text-ink">{{ $item->user->name }}</div>
                        <div class="text-caption text-muted">{{ $item->user->email }}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-body text-ink">{{ $item->created_at->format('d M Y') }}</div>
                        <div class="text-caption text-muted">{{ $item->created_at->format('H:i') }}</div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border {{ $color }}">
                            Grade {{ $item->grade_hasil }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-[80px] h-1.5 bg-border-light rounded-full overflow-hidden">
                                <div class="h-full {{ $barColor }} rounded-full" style="width: {{ $item->persentase_cf }}%"></div>
                            </div>
                            <span class="text-body text-ink font-medium">{{ $item->persentase_cf }}%</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-body text-muted">
                        Belum ada riwayat analisis
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection