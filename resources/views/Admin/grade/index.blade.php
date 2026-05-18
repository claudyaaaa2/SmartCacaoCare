@extends('layouts.admin')

@section('title', 'Grade Kualitas')
@section('subtitle', 'Kelola data grade kualitas biji kakao')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Data Grade Kualitas</h5>
        <small class="text-muted">Total {{ $grades->count() }} grade</small>
    </div>
    <a href="{{ route('admin.grade.create') }}" class="btn btn-cocoa">
        <i class="bi bi-plus me-1"></i> Tambah Grade
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
                        <th>Kode</th>
                        <th>Nama Grade</th>
                        <th>CF Min</th>
                        <th>CF Max</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grades as $grade)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td>
                            @php
                                $gradeColors = [
                                    'A' => 'success',
                                    'B' => 'info',
                                    'C' => 'warning',
                                    'D' => 'danger',
                                ];
                                $color = $gradeColors[$grade->kode_grade] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} px-3">
                                {{ $grade->kode_grade }}
                            </span>
                        </td>
                        <td class="fw-semibold">{{ $grade->nama_grade }}</td>
                        <td>{{ $grade->cf_min }}</td>
                        <td>{{ $grade->cf_max }}</td>
                        <td>
                            <small class="text-muted">
                                {{ Str::limit($grade->deskripsi, 50) }}
                            </small>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.grade.edit', $grade->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.grade.destroy', $grade->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus grade ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada data grade
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection