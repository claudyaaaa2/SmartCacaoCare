@extends('layouts.admin')

@section('title', 'Edit Artikel Edukasi')
@section('subtitle', 'Edit artikel edukasi')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <a href="{{ route('admin.edukasi.index') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Edit Artikel Edukasi</h5>
</div>

{{-- FORM --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.edukasi.update', $edukasi->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-12">
                    <label class="form-label fw-semibold">Judul Artikel</label>
                    <input type="text"
                           name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $edukasi->judul) }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="kategori"
                            class="form-select @error('kategori') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="budidaya"      {{ old('kategori', $edukasi->kategori) == 'budidaya'      ? 'selected' : '' }}>Budidaya</option>
                        <option value="perawatan"     {{ old('kategori', $edukasi->kategori) == 'perawatan'     ? 'selected' : '' }}>Perawatan</option>
                        <option value="panen"         {{ old('kategori', $edukasi->kategori) == 'panen'         ? 'selected' : '' }}>Panen</option>
                        <option value="pasca_panen"   {{ old('kategori', $edukasi->kategori) == 'pasca_panen'   ? 'selected' : '' }}>Pasca Panen</option>
                        <option value="hama_penyakit" {{ old('kategori', $edukasi->kategori) == 'hama_penyakit' ? 'selected' : '' }}>Hama & Penyakit</option>
                        <option value="kualitas"      {{ old('kategori', $edukasi->kategori) == 'kualitas'      ? 'selected' : '' }}>Kualitas</option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Thumbnail</label>

                    {{-- PREVIEW THUMBNAIL LAMA --}}
                    @if($edukasi->thumbnail)
                    <div class="mb-2">
                        <img src="{{ asset('images/edukasi/' . $edukasi->thumbnail) }}"
                             alt="Thumbnail"
                             style="height:80px; border-radius:8px; object-fit:cover;">
                        <small class="text-muted d-block mt-1">Thumbnail saat ini</small>
                    </div>
                    @endif

                    <input type="file"
                           name="thumbnail"
                           class="form-control @error('thumbnail') is-invalid @enderror"
                           accept="image/jpg, image/jpeg, image/png">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah thumbnail</small>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Ringkasan</label>
                    <textarea name="ringkasan"
                              class="form-control @error('ringkasan') is-invalid @enderror"
                              rows="2">{{ old('ringkasan', $edukasi->ringkasan) }}</textarea>
                    @error('ringkasan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Konten Artikel</label>
                    <textarea name="konten"
                              class="form-control @error('konten') is-invalid @enderror"
                              rows="10">{{ old('konten', $edukasi->konten) }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-cocoa px-4">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.edukasi.index') }}"
                   class="btn btn-outline-secondary px-4">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection