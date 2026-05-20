@extends('layouts.admin')

@section('title', 'Kriteria')
@section('subtitle', 'Kelola data kriteria penilaian biji kakao')

@section('content')

<div class="mb-6 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
    <div>
        <div class="mb-2 text-mono-label text-muted">Data Master</div>
        <h2 class="text-section-heading m-0 text-ink">Data Kriteria</h2>
        <p class="mt-2 max-w-2xl text-caption text-muted">Kriteria dipakai sebagai dasar penilaian pada certainty factor dan edukasi kualitas kakao.</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="rounded-full border border-border-light bg-canvas px-4 py-2 text-caption text-muted">
            Total <span class="font-medium text-ink">{{ $kriteria->count() }}</span> kriteria
        </div>
        <a href="{{ route('admin.kriteria.create') }}" class="btn-primary">
            <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
            Tambah Kriteria
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
                    <th class="px-6 py-4 font-medium">Nama Kriteria</th>
                    <th class="px-6 py-4 font-medium">Deskripsi</th>
                    <th class="px-6 py-4 font-medium">Jumlah Pilihan</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-light">
                @forelse($kriteria as $item)
                <tr class="transition-colors hover:bg-soft-stone/30">
                    <td class="px-6 py-5 text-body text-muted">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5">
                        <div class="text-body font-medium text-ink">{{ $item->nama_kriteria }}</div>
                        <div class="text-caption text-muted">Kriteria penilaian</div>
                    </td>
                    <td class="px-6 py-5 text-caption text-muted">{{ Str::limit($item->deskripsi, 80) }}</td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center rounded-full border border-border-light bg-canvas px-3 py-1 text-caption text-ink">
                            {{ $item->pilihanKriteria->count() }} pilihan
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.kriteria.edit', $item->id) }}" class="inline-flex items-center gap-2 rounded-full border border-border-light px-3 py-2 text-caption text-ink transition-colors hover:border-action-blue hover:text-action-blue">
                                <i data-lucide="pencil" class="h-4 w-4"></i>
                                Ubah
                            </a>
                            <form action="{{ route('admin.kriteria.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kriteria ini?')">
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
                    <td colspan="5" class="px-6 py-10 text-center text-body text-muted">Belum ada data kriteria</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection