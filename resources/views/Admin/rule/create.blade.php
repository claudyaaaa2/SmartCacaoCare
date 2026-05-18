@extends('layouts.admin')

@section('title', 'Tambah Rule CF')
@section('subtitle', 'Tambah rule Certainty Factor baru')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <a href="{{ route('admin.rule.index') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Tambah Rule CF</h5>
</div>

{{-- FORM --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.rule.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pilihan Kriteria</label>
                    <select name="pilihan_kriteria_id"
                            class="form-select @error('pilihan_kriteria_id') is-invalid @enderror">
                        <option value="">-- Pilih Kondisi --</option>
                        @foreach($pilihan as $p)
                        <option value="{{ $p->id }}"
                            {{ old('pilihan_kriteria_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->kriteria->nama_kriteria }} —
                            {{ $p->nama_pilihan }}
                        </option>
                        @endforeach
                    </select>
                    @error('pilihan_kriteria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Grade Kualitas</label>
                    <select name="grade_id"
                            class="form-select @error('grade_id') is-invalid @enderror">
                        <option value="">-- Pilih Grade --</option>
                        @foreach($grades as $grade)
                        <option value="{{ $grade->id }}"
                            {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                            Grade {{ $grade->kode_grade }} — {{ $grade->nama_grade }}
                        </option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nilai CF</label>
                    <input type="number"
                           name="nilai_cf"
                           class="form-control @error('nilai_cf') is-invalid @enderror"
                           placeholder="Contoh: 0.90"
                           value="{{ old('nilai_cf') }}"
                           step="0.01" min="0" max="1">
                    <small class="text-muted">Nilai antara 0.00 - 1.00</small>
                    @error('nilai_cf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- INFO --}}
                <div class="col-12">
                    <div class="alert py-2 mb-0"
                         style="background:#fff3e0; border:1px solid #ffe0b2; border-radius:8px;">
                        <small style="color:#c8860a;">
                            <i class="bi bi-info-circle me-1"></i>
                            Nilai CF mendekati <strong>1.0</strong> artinya kondisi ini
                            <strong>sangat mengarah</strong> ke grade tersebut.
                            Nilai mendekati <strong>0.0</strong> artinya
                            <strong>tidak mengarah</strong> ke grade tersebut.
                        </small>
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-cocoa px-4">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.rule.index') }}"
                   class="btn btn-outline-secondary px-4">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection