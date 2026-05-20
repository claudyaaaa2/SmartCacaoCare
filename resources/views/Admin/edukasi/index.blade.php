@extends('layouts.admin')

@section('title', 'Artikel Edukasi')
@section('subtitle', 'Kelola artikel edukasi kakao')

@section('content')

<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <h5 class="fw-bold mb-1" style="color:#3d2b1f;">Artikel Edukasi</h5>
        <small class="text-muted">Total {{ $edukasi->total() }} artikel</small>
    </div>
    <a href="{{ route('admin.edukasi.create') }}" class="btn btn-cocoa align-self-start align-self-lg-center">
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

@if($edukasi->count())
    {{-- TABEL --}}
    <div class="card border-0 shadow-sm" style="border-radius:12px; overflow:hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Thumbnail</th>
                            <th class="py-3">Judul</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3 pe-4 text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($edukasi as $artikel)
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
                            <td class="ps-4 py-3 text-muted">
                                {{ ($edukasi->currentPage() - 1) * $edukasi->perPage() + $loop->iteration }}
                            </td>
                            <td class="py-3">
                                @if($artikel->thumbnail)
                                    <img src="{{ asset('images/edukasi/' . $artikel->thumbnail) }}"
                                         alt="{{ $artikel->judul }}"
                                         class="rounded-2 border"
                                         style="width:72px; height:54px; object-fit:cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center rounded-2 border bg-light"
                                         style="width:72px; height:54px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3">
                                <div class="fw-semibold">{{ Str::limit($artikel->judul, 40) }}</div>
                                <small class="text-muted">{{ Str::limit($artikel->ringkasan, 50) }}</small>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill bg-{{ $kat['color'] }}">
                                    {{ $kat['label'] }}
                                </span>
                            </td>
                            <td class="py-3">
                                <small class="text-muted">
                                    {{ $artikel->created_at->format('d M Y') }}
                                </small>
                            </td>
                            <td class="py-3 pe-4">
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.edukasi.edit', $artikel->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.edukasi.destroy', $artikel->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
@else
    <div class="card border-0 shadow-sm" style="border-radius:12px;">
        <div class="card-body py-5 text-center">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-light"
                 style="width:72px; height:72px;">
                <i class="bi bi-journal-text fs-3 text-secondary"></i>
            </div>
            <h6 class="fw-bold mb-2" style="color:#3d2b1f;">Belum ada artikel edukasi</h6>
            <p class="text-muted mb-4">Tambahkan artikel pertama untuk mulai mengelola konten edukasi.</p>
            <a href="{{ route('admin.edukasi.create') }}" class="btn btn-cocoa px-4">
                <i class="bi bi-plus me-1"></i> Tambah Artikel
            </a>
        </div>
    </div>
@endif

@endsection