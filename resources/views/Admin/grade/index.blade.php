@extends('layouts.admin')

@section('title', 'Grade Kualitas')
@section('subtitle', 'Kelola data grade kualitas biji kakao')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-section-heading text-ink m-0">Data Grade Kualitas</h2>
        <p class="text-caption text-muted mt-1">Total {{ $grades->count() }} grade</p>
    </div>
    <a href="{{ route('admin.grade.create') }}" class="btn-primary flex items-center gap-2">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Grade
    </a>
</div>

{{-- TABEL --}}
<div class="contact-form-card p-0 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-border-light bg-soft-stone/50 text-mono-label text-muted">
                    <th class="py-4 px-6 font-medium w-[80px]">No</th>
                    <th class="py-4 px-6 font-medium">Kode</th>
                    <th class="py-4 px-6 font-medium">Nama Grade</th>
                    <th class="py-4 px-6 font-medium">CF Min</th>
                    <th class="py-4 px-6 font-medium">CF Max</th>
                    <th class="py-4 px-6 font-medium">Deskripsi</th>
                    <th class="py-4 px-6 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-light">
                @forelse($grades as $grade)
                <tr class="hover:bg-soft-stone/30 transition-colors group">
                    <td class="py-4 px-6 text-body text-muted">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        @php
                            $gradeColors = [
                                'A' => 'text-success bg-success/10 border-success/20',
                                'B' => 'text-action-blue bg-action-blue/10 border-action-blue/20',
                                'C' => 'text-coral bg-coral/10 border-coral/20',
                                'D' => 'text-error bg-error/10 border-error/20',
                            ];
                            $color = $gradeColors[$grade->kode_grade] ?? 'text-muted bg-soft-stone border-border-light';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium border {{ $color }}">
                            {{ $grade->kode_grade }}
                        </span>
                    </td>
                    <td class="py-4 px-6 font-medium text-ink">{{ $grade->nama_grade }}</td>
                    <td class="py-4 px-6 text-body text-muted">{{ $grade->cf_min }}</td>
                    <td class="py-4 px-6 text-body text-muted">{{ $grade->cf_max }}</td>
                    <td class="py-4 px-6 text-caption text-muted">
                        {{ Str::limit($grade->deskripsi, 50) }}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.grade.edit', $grade->id) }}" class="p-2 text-action-blue hover:bg-action-blue/10 rounded-xs transition-colors" title="Edit">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.grade.destroy', $grade->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Yakin hapus grade ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-xs transition-colors" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-body text-muted">
                        Belum ada data grade
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection