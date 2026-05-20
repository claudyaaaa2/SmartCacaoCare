@extends('layouts.admin')

@section('title', 'Edit Rule CF')
@section('subtitle', 'Edit rule Certainty Factor')

@section('content')

<div class="mb-6 flex flex-col gap-4">
    <a href="{{ route('admin.rule.index') }}" class="btn-pill-outline w-fit">
        <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
        Kembali
    </a>
    <div>
        <div class="mb-2 text-mono-label text-muted">Data Master</div>
        <h2 class="text-section-heading m-0 text-ink">Edit Rule CF</h2>
        <p class="mt-2 max-w-2xl text-caption text-muted">Perbarui hubungan antara pilihan kriteria, grade, dan nilai certainty factor.</p>
    </div>
</div>

<div class="contact-form-card">
    <form action="{{ route('admin.rule.update', $rule->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="form-label" for="pilihan_kriteria_id">Pilihan Kriteria</label>
                <select id="pilihan_kriteria_id" name="pilihan_kriteria_id" class="form-select @error('pilihan_kriteria_id') border-error focus:border-error focus:ring-error @enderror">
                    <option value="">-- Pilih Kondisi --</option>
                    @foreach($pilihan as $p)
                    <option value="{{ $p->id }}" {{ old('pilihan_kriteria_id', $rule->pilihan_kriteria_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->kriteria->nama_kriteria }} — {{ $p->nama_pilihan }}
                    </option>
                    @endforeach
                </select>
                @error('pilihan_kriteria_id')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="form-label" for="grade_id">Grade Kualitas</label>
                <select id="grade_id" name="grade_id" class="form-select @error('grade_id') border-error focus:border-error focus:ring-error @enderror">
                    <option value="">-- Pilih Grade --</option>
                    @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ old('grade_id', $rule->grade_id) == $grade->id ? 'selected' : '' }}>
                        Grade {{ $grade->kode_grade }} — {{ $grade->nama_grade }}
                    </option>
                    @endforeach
                </select>
                @error('grade_id')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="form-label" for="nilai_cf">Nilai CF</label>
                <input id="nilai_cf" type="number" name="nilai_cf" class="form-input @error('nilai_cf') border-error focus:border-error focus:ring-error @enderror" value="{{ old('nilai_cf', $rule->nilai_cf) }}" step="0.01" min="0" max="1">
                <p class="mt-2 text-caption text-muted">Nilai berada di rentang 0.00 - 1.00.</p>
                @error('nilai_cf')
                    <p class="mt-2 text-caption text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 rounded-lg border border-border-light bg-pale-blue px-5 py-4 text-action-blue">
                <div class="flex items-start gap-3">
                    <i data-lucide="info" class="mt-0.5 h-5 w-5"></i>
                    <p class="text-caption leading-6">
                        Nilai CF mendekati <strong>1.0</strong> berarti kondisi ini sangat mengarah ke grade tersebut. Nilai mendekati <strong>0.0</strong> berarti tidak mengarah ke grade tersebut.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 border-t border-border-light pt-6">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="mr-2 h-4 w-4"></i>
                Update
            </button>
            <a href="{{ route('admin.rule.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection