@extends('layouts.app')

@section('title', 'Analisis Kualitas Biji Kakao')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h4 class="fw-bold mb-1" style="color:#3d2b1f;">
        <i class="bi bi-search me-2"></i>Analisis Kualitas Biji Kakao
    </h4>
    <p class="text-muted mb-0">Pilih kondisi biji kakao Anda untuk mendapatkan hasil analisis</p>
</div>

{{-- FORM ANALISIS --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-4">

        <form action="{{ route('user.analisis.proses') }}" method="POST">
            @csrf

            {{-- ERROR --}}
            @if($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    Semua kriteria wajib dipilih!
                </div>
            @endif

            {{-- KRITERIA DROPDOWN --}}
            @foreach($kriteria as $k)
            <div class="mb-4">
                <label class="form-label fw-semibold" style="color:#3d2b1f;">
                    {{ $loop->iteration }}. {{ $k->nama_kriteria }}
                </label>
                <p class="text-muted small mb-2">{{ $k->deskripsi }}</p>
                <select name="pilihan_{{ $k->id }}"
                        class="form-select @error('pilihan_'.$k->id) is-invalid @enderror"
                        style="border-color:#dee2e6;">
                    <option value="">-- Pilih kondisi {{ $k->nama_kriteria }} --</option>
                    @foreach($k->pilihanKriteria as $pilihan)
                        <option value="{{ $pilihan->id }}"
                            {{ old('pilihan_'.$k->id) == $pilihan->id ? 'selected' : '' }}>
                            {{ $pilihan->nama_pilihan }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endforeach

            {{-- DIVIDER --}}
            <hr class="my-4">

            {{-- INFO --}}
            <div class="alert mb-4 py-2"
                 style="background:#fff3e0; border:1px solid #ffe0b2; border-radius:8px;">
                <small style="color:#c8860a;">
                    <i class="bi bi-info-circle me-1"></i>
                    Pastikan semua kondisi dipilih sesuai keadaan nyata biji kakao Anda
                    untuk hasil analisis yang akurat.
                </small>
            </div>

            {{-- SUBMIT --}}
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-cocoa btn-lg px-5">
                    <i class="bi bi-search me-2"></i> Analisis Sekarang
                </button>
                <a href="{{ route('user.dashboard') }}"
                   class="btn btn-outline-secondary btn-lg px-4">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection