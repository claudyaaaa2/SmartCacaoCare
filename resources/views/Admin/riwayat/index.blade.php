@extends('layouts.admin')

@section('title', 'Riwayat Analisis')
@section('subtitle', 'Semua riwayat analisis user')

@section('content')

<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <h5 class="fw-bold mb-1" style="color:#3d2b1f;">Riwayat Analisis</h5>
        <small class="text-muted">Total {{ $riwayat->total() }} analisis</small>
    </div>
</div>

@if($riwayat->count())
    <div class="card border-0 shadow-sm" style="border-radius:12px; overflow:hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">User</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Grade</th>
                            <th class="py-3">Keyakinan</th>
                            <th class="py-3 pe-4">Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $item)
                        @php
                            $gradeColors = [
                                'A' => 'success',
                                'B' => 'info',
                                'C' => 'warning',
                                'D' => 'danger',
                            ];
                            $color = $gradeColors[$item->grade_hasil] ?? 'secondary';
                        @endphp
                        <tr>
                            <td class="ps-4 py-3 text-muted">
                                {{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}
                            </td>
                            <td class="py-3">
                                <div class="fw-semibold">{{ $item->user->name }}</div>
                                <small class="text-muted">{{ $item->user->email }}</small>
                            </td>
                            <td class="py-3">
                                <div>{{ $item->created_at->format('d M Y') }}</div>
                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill bg-{{ $color }} px-3 py-2">
                                    Grade {{ $item->grade_hasil }}
                                </span>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                                    {{ $item->persentase_cf }}% confidence
                                </span>
                            </td>
                            <td class="py-3 pe-4">
                                <small class="text-muted d-block">
                                    {{ Str::limit($item->rekomendasi, 55) }}
                                </small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if($riwayat->hasPages())
        <div class="card-footer bg-white px-4 py-3"
             style="border-radius: 0 0 12px 12px;">
            {{ $riwayat->links() }}
        </div>
        @endif

    </div>
@else
    <div class="card border-0 shadow-sm" style="border-radius:12px;">
        <div class="card-body py-5 text-center">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-light"
                 style="width:72px; height:72px;">
                <i class="bi bi-clock-history fs-3 text-secondary"></i>
            </div>
            <h6 class="fw-bold mb-2" style="color:#3d2b1f;">Belum ada riwayat analisis</h6>
            <p class="text-muted mb-0">Data analisis user akan tampil di sini setelah ada proses analisis.</p>
        </div>
    </div>
@endif

@endsection