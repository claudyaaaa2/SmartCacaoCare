@extends('layouts.admin')

@section('title', 'Artikel Edukasi')
@section('subtitle', 'Kelola artikel edukasi kakao')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h2 class="text-section-heading text-ink m-0">Artikel Edukasi</h2>
        <p class="text-caption text-muted mt-1">Total {{ $edukasi->total() }} artikel</p>
    </div>
    <a href="{{ route('admin.edukasi.create') }}" class="btn-primary flex items-center gap-2">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Artikel
    </a>
</div>

@if($edukasi->count())
    {{-- TABEL --}}
    <div class="contact-form-card p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-border-light bg-soft-stone/50 text-mono-label text-muted">
                        <th class="py-4 px-6 font-medium w-[80px]">No</th>
                        <th class="py-4 px-6 font-medium w-[120px]">Thumbnail</th>
                        <th class="py-4 px-6 font-medium">Judul & Ringkasan</th>
                        <th class="py-4 px-6 font-medium w-[180px]">Kategori</th>
                        <th class="py-4 px-6 font-medium w-[150px]">Tanggal</th>
                        <th class="py-4 px-6 font-medium text-right w-[120px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    @foreach($edukasi as $artikel)
                    @php
                        $kategoriLabels = [
                            'budidaya'      => ['label' => 'Budidaya',       'color' => 'text-green-700 bg-green-50 border-green-200'],
                            'perawatan'     => ['label' => 'Perawatan',      'color' => 'text-blue-700 bg-blue-50 border-blue-200'],
                            'panen'         => ['label' => 'Panen',          'color' => 'text-amber-700 bg-amber-50 border-amber-200'],
                            'pasca_panen'   => ['label' => 'Pasca Panen',    'color' => 'text-teal-700 bg-teal-50 border-teal-200'],
                            'hama_penyakit' => ['label' => 'Hama & Penyakit','color' => 'text-rose-700 bg-rose-50 border-rose-200'],
                            'kualitas'      => ['label' => 'Kualitas',       'color' => 'text-indigo-700 bg-indigo-50 border-indigo-200'],
                        ];
                        $kat = $kategoriLabels[$artikel->kategori] ?? ['label' => $artikel->kategori, 'color' => 'text-slate bg-soft-stone border-border-light'];
                    @endphp
                    <tr class="hover:bg-soft-stone/30 transition-colors group">
                        <td class="py-4 px-6 text-body text-muted">
                            {{ ($edukasi->currentPage() - 1) * $edukasi->perPage() + $loop->iteration }}
                        </td>
                        <td class="py-4 px-6">
                            @if($artikel->thumbnail)
                                <img src="{{ asset('images/edukasi/' . $artikel->thumbnail) }}"
                                     alt="{{ $artikel->judul }}"
                                     class="rounded border border-border-light object-cover w-[72px] h-[54px]">
                            @else
                                <div class="flex items-center justify-center rounded border border-border-light bg-soft-stone/50 w-[72px] h-[54px]">
                                    <i data-lucide="image" class="text-muted w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-ink leading-snug">{{ Str::limit($artikel->judul, 50) }}</div>
                            <small class="text-caption text-muted mt-1 block max-w-[400px] truncate">{{ $artikel->ringkasan }}</small>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border {{ $kat['color'] }}">
                                {{ $kat['label'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-body text-muted">
                            {{ $artikel->created_at->format('d M Y') }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.edukasi.edit', $artikel->id) }}" class="p-2 text-action-blue hover:bg-action-blue/10 rounded-xs transition-colors" title="Edit">
                                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.edukasi.destroy', $artikel->id) }}"
                                      method="POST"
                                      class="inline m-0"
                                      onsubmit="return confirm('Yakin hapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-xs transition-colors" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($edukasi->hasPages())
        <div class="p-6 border-t border-border-light bg-canvas">
            {{ $edukasi->links() }}
        </div>
        @endif

    </div>
@else
    <div class="contact-form-card py-12 text-center">
        <i data-lucide="book-open" class="w-12 h-12 text-muted mx-auto mb-4"></i>
        <h3 class="text-body-large text-ink font-medium mb-2">Belum ada artikel edukasi</h3>
        <p class="text-caption text-muted mb-6">Tambahkan artikel pertama untuk mulai mengelola konten edukasi.</p>
        <a href="{{ route('admin.edukasi.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Artikel
        </a>
    </div>
@endif

@endsection