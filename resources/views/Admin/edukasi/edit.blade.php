@extends('layouts.admin')

@section('title', 'Edit Artikel Edukasi')
@section('subtitle', 'Edit artikel edukasi')

@section('content')

{{-- HEADER --}}
<div class="mb-6 flex flex-col items-start gap-4">
    <a href="{{ route('admin.edukasi.index') }}" class="btn-pill-outline text-ink hover:bg-soft-stone py-2 px-4 text-body">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
    </a>
    <h2 class="text-section-heading text-ink m-0">Edit Artikel Edukasi</h2>
</div>

{{-- FORM --}}
<div class="contact-form-card">
    <form action="{{ route('admin.edukasi.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label class="form-label text-ink">Judul Artikel</label>
                <input type="text"
                       name="judul"
                       class="form-input @error('judul') border-error @enderror"
                       value="{{ old('judul', $edukasi->judul) }}">
                @error('judul')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">Kategori</label>
                <select name="kategori"
                        class="form-select @error('kategori') border-error @enderror w-full">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="budidaya"      {{ old('kategori', $edukasi->kategori) == 'budidaya'      ? 'selected' : '' }}>Budidaya</option>
                    <option value="perawatan"     {{ old('kategori', $edukasi->kategori) == 'perawatan'     ? 'selected' : '' }}>Perawatan</option>
                    <option value="panen"         {{ old('kategori', $edukasi->kategori) == 'panen'         ? 'selected' : '' }}>Panen</option>
                    <option value="pasca_panen"   {{ old('kategori', $edukasi->kategori) == 'pasca_panen'   ? 'selected' : '' }}>Pasca Panen</option>
                    <option value="hama_penyakit" {{ old('kategori', $edukasi->kategori) == 'hama_penyakit' ? 'selected' : '' }}>Hama & Penyakit</option>
                    <option value="kualitas"      {{ old('kategori', $edukasi->kategori) == 'kualitas'      ? 'selected' : '' }}>Kualitas</option>
                </select>
                @error('kategori')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label text-ink">Thumbnail</label>

                {{-- PREVIEW THUMBNAIL LAMA --}}
                @if($edukasi->thumbnail)
                <div class="mb-3">
                    <img src="{{ asset('images/edukasi/' . $edukasi->thumbnail) }}"
                         alt="Thumbnail"
                         class="h-20 rounded border border-border-light object-cover">
                    <p class="text-micro text-muted mt-1">Thumbnail saat ini</p>
                </div>
                @endif

                <input type="file"
                       name="thumbnail"
                       class="form-input @error('thumbnail') border-error @enderror"
                       accept="image/jpg, image/jpeg, image/png">
                <p class="text-micro text-muted mt-1">Kosongkan jika tidak ingin mengubah thumbnail</p>
                @error('thumbnail')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label text-ink">Ringkasan</label>
                <textarea name="ringkasan"
                          class="form-input @error('ringkasan') border-error @enderror"
                          rows="2">{{ old('ringkasan', $edukasi->ringkasan) }}</textarea>
                @error('ringkasan')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label text-ink">Konten Artikel</label>
                <textarea name="konten"
                          class="form-input @error('konten') border-error @enderror"
                          rows="10">{{ old('konten', $edukasi->konten) }}</textarea>
                @error('konten')
                    <div class="text-error text-caption mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="mt-4 pt-6 border-t border-border-light flex gap-4">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="w-4 h-4 mr-2"></i> Update
            </button>
            <a href="{{ route('admin.edukasi.index') }}" class="btn-secondary">
                Batal
            </a>
        </div>

    </form>
</div>

@endsection