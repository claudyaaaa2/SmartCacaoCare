@extends('layouts.admin')

@section('title', 'Tambah Kriteria')
@section('subtitle', 'Tambah data kriteria baru')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <a href="{{ route('admin.kriteria.index') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Tambah Kriteria</h5>
</div>

{{-- FORM --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.kriteria.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-12">
                    <label class="form-label fw-semibold">Nama Kriteria</label>
                    <input type="text"
                           name="nama_kriteria"
                           class="form-control @error('nama_kriteria') is-invalid @enderror"
                           placeholder="Contoh: Warna Biji, Aroma, Tekstur"
                           value="{{ old('nama_kriteria') }}">
                    @error('nama_kriteria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="3"
                              placeholder="Deskripsi kriteria...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-cocoa px-4">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.kriteria.index') }}"
                   class="btn btn-outline-secondary px-4">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection