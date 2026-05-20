@extends('layouts.admin')

@section('title', 'Edit Grade Kualitas')
@section('subtitle', 'Edit data grade kualitas')

@section('content')

<div class="mb-6 flex flex-col gap-4">
    <a href="{{ route('admin.grade.index') }}" class="btn-pill-outline w-fit">
        <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
        Kembali
    </a>
    <div>
        <div class="mb-2 text-mono-label text-muted">Data Master</div>
        <h2 class="text-section-heading m-0 text-ink">Edit Grade Kualitas</h2>
        <p class="mt-2 max-w-2xl text-caption text-muted">Perbarui deskripsi, batas CF, dan rekomendasi untuk grade ini.</p>
    </div>
</div>

<div class="contact-form-card">
    <form action="{{ route('admin.grade.update', $grade->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="form-label">Kode Grade</label>
                <input type="text" class="form-input bg-soft-stone text-muted" value="{{ $grade->kode_grade }}" disabled>
                <p class="mt-2 text-caption text-muted">Kode grade tidak bisa diubah.</p>
            </div>

            <div>
                <label class="form-label" for="nama_grade">Nama Grade</label>
                <input id="nama_grade" type="text" name="nama_grade" class="form-input @error('nama_grade') border-error focus:border-error focus:ring-error @enderror" value="{{ old('nama_grade', $grade->nama_grade) }}">
                @error('nama_grade')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="form-label" for="cf_min">CF Minimum</label>
                <input id="cf_min" type="number" name="cf_min" class="form-input @error('cf_min') border-error focus:border-error focus:ring-error @enderror" value="{{ old('cf_min', $grade->cf_min) }}" step="0.01" min="0" max="1">
                @error('cf_min')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="form-label" for="cf_max">CF Maximum</label>
                <input id="cf_max" type="number" name="cf_max" class="form-input @error('cf_max') border-error focus:border-error focus:ring-error @enderror" value="{{ old('cf_max', $grade->cf_max) }}" step="0.01" min="0" max="1">
                @error('cf_max')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label" for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-textarea @error('deskripsi') border-error focus:border-error focus:ring-error @enderror" rows="3">{{ old('deskripsi', $grade->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label" for="rekomendasi">Rekomendasi Penanganan</label>
                <textarea id="rekomendasi" name="rekomendasi" class="form-textarea @error('rekomendasi') border-error focus:border-error focus:ring-error @enderror" rows="4">{{ old('rekomendasi', $grade->rekomendasi) }}</textarea>
                @error('rekomendasi')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap gap-3 border-t border-border-light pt-6">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="mr-2 h-4 w-4"></i>
                Update
            </button>
            <a href="{{ route('admin.grade.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection