@extends('layouts.admin')

@section('title', 'Tambah Grade Kualitas')
@section('subtitle', 'Tambah data grade kualitas baru')

@section('content')

{{-- HEADER --}}
<div class="mb-6 flex flex-col items-start gap-4">
    <a href="{{ route('admin.grade.index') }}" class="btn-pill-outline text-ink hover:bg-soft-stone py-2 px-4 text-body">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
    </a>
    <h2 class="text-section-heading text-ink m-0">Tambah Grade Kualitas</h2>
</div>

{{-- FORM --}}
<div class="contact-form-card">
    <form action="{{ route('admin.grade.store') }}" method="POST" class="flex flex-col gap-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="form-label text-ink">Kode Grade</label>
                <input type="text"
                       name="kode_grade"
                       class="form-input @error('kode_grade') border-error @enderror"
                       placeholder="Contoh: A, B, C, D"
                       value="{{ old('kode_grade') }}"
                       maxlength="2">
                @error('kode_grade')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">Nama Grade</label>
                <input type="text"
                       name="nama_grade"
                       class="form-input @error('nama_grade') border-error @enderror"
                       placeholder="Contoh: Premium, Menengah"
                       value="{{ old('nama_grade') }}">
                @error('nama_grade')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">CF Minimum</label>
                <input type="number"
                       name="cf_min"
                       class="form-input @error('cf_min') border-error @enderror"
                       placeholder="Contoh: 0.75"
                       value="{{ old('cf_min') }}"
                       step="0.01" min="0" max="1">
                @error('cf_min')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">CF Maximum</label>
                <input type="number"
                       name="cf_max"
                       class="form-input @error('cf_max') border-error @enderror"
                       placeholder="Contoh: 1.00"
                       value="{{ old('cf_max') }}"
                       step="0.01" min="0" max="1">
                @error('cf_max')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label text-ink">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-input @error('deskripsi') border-error @enderror"
                          rows="3"
                          placeholder="Deskripsi grade kualitas...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label text-ink">Rekomendasi Penanganan</label>
                <textarea name="rekomendasi"
                          class="form-input @error('rekomendasi') border-error @enderror"
                          rows="4"
                          placeholder="Rekomendasi penanganan untuk grade ini...">{{ old('rekomendasi') }}</textarea>
                @error('rekomendasi')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4 pt-6 border-t border-border-light flex gap-4">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="w-4 h-4 mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.grade.index') }}" class="btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection