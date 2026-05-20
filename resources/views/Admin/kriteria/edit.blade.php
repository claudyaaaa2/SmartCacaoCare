@extends('layouts.admin')

@section('title', 'Edit Kriteria')
@section('subtitle', 'Edit data kriteria')

@section('content')

<div class="mb-6 flex flex-col gap-4">
    <a href="{{ route('admin.kriteria.index') }}" class="btn-pill-outline w-fit">
        <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
        Kembali
    </a>
    <div>
        <div class="mb-2 text-mono-label text-muted">Data Master</div>
        <h2 class="text-section-heading m-0 text-ink">Edit Kriteria</h2>
        <p class="mt-2 max-w-2xl text-caption text-muted">Perbarui nama dan deskripsi kriteria tanpa mengubah relasinya ke pilihan.</p>
    </div>
</div>

<div class="contact-form-card">
    <form action="{{ route('admin.kriteria.update', $kriteria->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="form-label" for="nama_kriteria">Nama Kriteria</label>
                <input id="nama_kriteria" type="text" name="nama_kriteria" class="form-input @error('nama_kriteria') border-error focus:border-error focus:ring-error @enderror" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}">
                @error('nama_kriteria')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="form-label" for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-textarea @error('deskripsi') border-error focus:border-error focus:ring-error @enderror" rows="4">{{ old('deskripsi', $kriteria->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap gap-3 border-t border-border-light pt-6">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="mr-2 h-4 w-4"></i>
                Update
            </button>
            <a href="{{ route('admin.kriteria.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection