@extends('layouts.admin')

@section('title', 'Tambah Artikel Edukasi')
@section('subtitle', 'Tambah artikel edukasi baru')

@section('content')

{{-- HEADER --}}
<div class="mb-6 flex flex-col items-start gap-4">
    <a href="{{ route('admin.edukasi.index') }}" class="btn-pill-outline text-ink hover:bg-soft-stone py-2 px-4 text-body">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
    </a>
    <h2 class="text-section-heading text-ink m-0">Tambah Artikel Edukasi</h2>
</div>

{{-- FORM --}}
<div class="contact-form-card">
    <form action="{{ route('admin.edukasi.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label class="form-label text-ink">Judul Artikel</label>
                <input type="text"
                       name="judul"
                       class="form-input @error('judul') border-error @enderror"
                       placeholder="Judul artikel edukasi..."
                       value="{{ old('judul') }}">
                @error('judul')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">Kategori</label>
                <select name="kategori"
                        class="form-select @error('kategori') border-error @enderror w-full">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="budidaya"      {{ old('kategori') == 'budidaya'      ? 'selected' : '' }}>Budidaya</option>
                    <option value="perawatan"     {{ old('kategori') == 'perawatan'     ? 'selected' : '' }}>Perawatan</option>
                    <option value="panen"         {{ old('kategori') == 'panen'         ? 'selected' : '' }}>Panen</option>
                    <option value="pasca_panen"   {{ old('kategori') == 'pasca_panen'   ? 'selected' : '' }}>Pasca Panen</option>
                    <option value="hama_penyakit" {{ old('kategori') == 'hama_penyakit' ? 'selected' : '' }}>Hama & Penyakit</option>
                    <option value="kualitas"      {{ old('kategori') == 'kualitas'      ? 'selected' : '' }}>Kualitas</option>
                </select>
                @error('kategori')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">Thumbnail</label>
                <input type="file"
                       name="thumbnail"
                       class="form-input @error('thumbnail') border-error @enderror"
                       accept="image/jpg, image/jpeg, image/png">
                <p class="text-micro text-muted mt-1">Format: JPG, JPEG, PNG. Maks 2MB</p>
                @error('thumbnail')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label text-ink">Ringkasan</label>
                <textarea name="ringkasan"
                          class="form-input @error('ringkasan') border-error @enderror"
                          rows="2"
                          placeholder="Ringkasan singkat artikel...">{{ old('ringkasan') }}</textarea>
                @error('ringkasan')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label text-ink">Konten Artikel</label>
                <textarea name="konten"
                          class="form-input @error('konten') border-error @enderror"
                          rows="10"
                          placeholder="Isi konten artikel edukasi...">{{ old('konten') }}</textarea>
                @error('konten')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="mt-4 pt-6 border-t border-border-light flex gap-4">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="w-4 h-4 mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.edukasi.index') }}" class="btn-secondary">
                Batal
            </a>
        </div>

    </form>
</div>

@endsection