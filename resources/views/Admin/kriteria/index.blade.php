@extends('layouts.admin')

@section('title', 'Kriteria')
@section('subtitle', 'Kelola data kriteria penilaian biji kakao')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Data Kriteria</h5>
        <small class="text-muted">Total {{ $kriteria->count() }} kriteria</small>
    </div>
    <a href="{{ route('admin.kriteria.create') }}" class="btn btn-cocoa">
        <i class="bi bi-plus me-1"></i> Tambah Kriteria
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
                        <th>Nama Kriteria</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Pilihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kriteria as $item)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->nama_kriteria }}</td>
                        <td>
                            <small class="text-muted">
                                {{ Str::limit($item->deskripsi, 60) }}
                            </small>
                        </td>
                        <td>
                            <span class="badge"
                                  style="background:#fff3e0; color:#c8860a;">
                                {{ $item->pilihanKriteria->count() }} pilihan
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kriteria.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.kriteria.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus kriteria ini?')">
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
                        <td colspan="5" class="text-center py-4 text-muted">
                            Belum ada data kriteria
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection