@extends('layouts.admin')

@section('title', 'Artikel Edukasi')
@section('subtitle', 'Kelola artikel edukasi kakao')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Artikel Edukasi</h5>
        <small class="text-muted">Total {{ $edukasi->total() }} artikel</small>
    </div>
    <a href="{{ route('admin.edukasi.create') }}" class="btn btn-cocoa">
        <i class="bi bi-plus me-1"></i> Tambah Artikel
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
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($edukasi as $artikel)
                    @php
                        $kategoriLabels = [
                            'budidaya'      => ['label' => 'Budidaya',       'color' => 'success'],
                            'perawatan'     => ['label' => 'Perawatan',      'color' => 'primary'],
                            'panen'         => ['label' => 'Panen',          'color' => 'warning'],
                            'pasca_panen'   => ['label' => 'Pasca Panen',    'color' => 'info'],
                            'hama_penyakit' => ['label' => 'Hama & Penyakit','color' => 'danger'],
                            'kualitas'      => ['label' => 'Kualitas',       'color' => 'secondary'],
                        ];
                        $kat = $kategoriLabels[$artikel->kategori] ?? ['label' => $artikel->kategori, 'color' => 'secondary'];
                    @endphp
                    <tr>
                        <td class="ps-4">
                            {{ ($edukasi->currentPage() - 1) * $edukasi->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            @if($artikel->thumbnail)
                                <img src="{{ asset('images/edukasi/' . $artikel->thumbnail) }}"
                                     alt="{{ $artikel->judul }}"
                                     style="width:60px; height:45px; object-fit:cover; border-radius:6px;">
                            @else
                                <div class="d-flex align-items-center justify-content-center"
                                     style="width:60px; height:45px; background:#f0ebe3; border-radius:6px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ Str::limit($artikel->judul, 40) }}</div>
                            <small class="text-muted">{{ Str::limit($artikel->ringkasan, 50) }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $kat['color'] }}">
                                {{ $kat['label'] }}
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $artikel->created_at->format('d M Y') }}
                            </small>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.edukasi.edit', $artikel->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.edukasi.destroy', $artikel->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus artikel ini?')">
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
                            Belum ada artikel edukasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if($edukasi->hasPages())
    <div class="card-footer bg-white px-4 py-3"
         style="border-radius: 0 0 12px 12px;">
        {{ $edukasi->links() }}
    </div>
    @endif

</div>

@endsection