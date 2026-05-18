@extends('layouts.admin')

@section('title', 'Tambah Grade Kualitas')
@section('subtitle', 'Tambah data grade kualitas baru')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <a href="{{ route('admin.grade.index') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Tambah Grade Kualitas</h5>
</div>

{{-- FORM --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.grade.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kode Grade</label>
                    <input type="text"
                           name="kode_grade"
                           class="form-control @error('kode_grade') is-invalid @enderror"
                           placeholder="Contoh: A, B, C, D"
                           value="{{ old('kode_grade') }}"
                           maxlength="2">
                    @error('kode_grade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Grade</label>
                    <input type="text"
                           name="nama_grade"
                           class="form-control @error('nama_grade') is-invalid @enderror"
                           placeholder="Contoh: Premium, Menengah"
                           value="{{ old('nama_grade') }}">
                    @error('nama_grade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">CF Minimum</label>
                    <input type="number"
                           name="cf_min"
                           class="form-control @error('cf_min') is-invalid @enderror"
                           placeholder="Contoh: 0.75"
                           value="{{ old('cf_min') }}"
                           step="0.01" min="0" max="1">
                    @error('cf_min')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">CF Maximum</label>
                    <input type="number"
                           name="cf_max"
                           class="form-control @error('cf_max') is-invalid @enderror"
                           placeholder="Contoh: 1.00"
                           value="{{ old('cf_max') }}"
                           step="0.01" min="0" max="1">
                    @error('cf_max')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="3"
                              placeholder="Deskripsi grade kualitas...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Rekomendasi Penanganan</label>
                    <textarea name="rekomendasi"
                              class="form-control @error('rekomendasi') is-invalid @enderror"
                              rows="4"
                              placeholder="Rekomendasi penanganan untuk grade ini...">{{ old('rekomendasi') }}</textarea>
                    @error('rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-cocoa px-4">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.grade.index') }}"
                   class="btn btn-outline-secondary px-4">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection