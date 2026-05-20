@extends('layouts.admin')

@section('title', 'Rule CF')
@section('subtitle', 'Kelola rule Certainty Factor')

@section('content')

<div class="mb-6 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
    <div>
        <div class="mb-2 text-mono-label text-muted">Data Master</div>
        <h2 class="text-section-heading m-0 text-ink">Data Rule CF</h2>
        <p class="mt-2 max-w-2xl text-caption text-muted">Rule ini menghubungkan pilihan kriteria dengan grade kualitas dan nilai certainty factor.</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="rounded-full border border-border-light bg-canvas px-4 py-2 text-caption text-muted">
            Total <span class="font-medium text-ink">{{ $rules->count() }}</span> rule
        </div>
        <a href="{{ route('admin.rule.create') }}" class="btn-primary">
            <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
            Tambah Rule
        </a>
    </div>
</div>

@if(session('success'))
<div class="contact-form-card mb-6 border border-deep-green/15 bg-pale-green px-5 py-4 text-deep-green">
    <div class="flex items-start gap-3">
        <i data-lucide="check-circle-2" class="mt-0.5 h-5 w-5"></i>
        <div>{{ session('success') }}</div>
    </div>
</div>
@endif

<div class="contact-form-card p-0 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="border-b border-border-light bg-soft-stone/60 text-mono-label text-muted">
                    <th class="px-6 py-4 font-medium">No</th>
                    <th class="px-6 py-4 font-medium">Kriteria</th>
                    <th class="px-6 py-4 font-medium">Pilihan</th>
                    <th class="px-6 py-4 font-medium">Grade</th>
                    <th class="px-6 py-4 font-medium">Nilai CF</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-light">
                @forelse($rules as $rule)
                @php
                    $gradeCode = $rule->grade->kode_grade;
                    $badgeClass = match ($gradeCode) {
                        'A' => 'bg-pale-green text-deep-green',
                        'B' => 'bg-pale-blue text-action-blue',
                        'C' => 'bg-[#fff1ed] text-coral',
                        'D' => 'bg-[#ffecec] text-error',
                        default => 'bg-soft-stone text-ink',
                    };
                @endphp
                <tr class="transition-colors hover:bg-soft-stone/30">
                    <td class="px-6 py-5 text-body text-muted">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5">
                        <div class="text-body font-medium text-ink">{{ $rule->pilihanKriteria->kriteria->nama_kriteria }}</div>
                        <div class="text-caption text-muted">{{ $rule->pilihanKriteria->nama_pilihan }}</div>
                    </td>
                    <td class="px-6 py-5 text-caption text-muted">{{ $rule->pilihanKriteria->nama_pilihan }}</td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-caption font-medium {{ $badgeClass }}">
                            Grade {{ $rule->grade->kode_grade }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center rounded-full border border-border-light bg-canvas px-3 py-1 text-caption font-medium text-ink">
                            CF {{ number_format($rule->nilai_cf, 2) }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.rule.edit', $rule->id) }}" class="inline-flex items-center gap-2 rounded-full border border-border-light px-3 py-2 text-caption text-ink transition-colors hover:border-action-blue hover:text-action-blue">
                                <i data-lucide="pencil" class="h-4 w-4"></i>
                                Ubah
                            </a>
                            <form action="{{ route('admin.rule.destroy', $rule->id) }}" method="POST" onsubmit="return confirm('Yakin hapus rule ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-error/20 px-3 py-2 text-caption text-error transition-colors hover:bg-error hover:text-white">
                                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-body text-muted">Belum ada data rule CF</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection