@extends('layouts.admin')

@section('title', 'Rule CF')
@section('subtitle', 'Kelola rule Certainty Factor')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Data Rule CF</h5>
        <small class="text-muted">Total {{ $rules->count() }} rule</small>
    </div>
    <a href="{{ route('admin.rule.create') }}" class="btn btn-cocoa">
        <i class="bi bi-plus me-1"></i> Tambah Rule
    </a>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- TABEL --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Kriteria</th>
                        <th>Pilihan</th>
                        <th>Grade</th>
                        <th>Nilai CF</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rules as $rule)
                    @php
                        $gradeColors = [
                            'A' => 'success',
                            'B' => 'info',
                            'C' => 'warning',
                            'D' => 'danger',
                        ];
                        $color = $gradeColors[$rule->grade->kode_grade] ?? 'secondary';
                    @endphp
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">
                            {{ $rule->pilihanKriteria->kriteria->nama_kriteria }}
                        </td>
                        <td>
                            <small>{{ $rule->pilihanKriteria->nama_pilihan }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $color }} px-3">
                                Grade {{ $rule->grade->kode_grade }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress" style="height:6px; width:60px;">
                                    <div class="progress-bar bg-{{ $color }}"
                                         style="width:{{ $rule->nilai_cf * 100 }}%">
                                    </div>
                                </div>
                                <small class="fw-semibold">{{ $rule->nilai_cf }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.rule.edit', $rule->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.rule.destroy', $rule->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus rule ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada data rule CF
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection