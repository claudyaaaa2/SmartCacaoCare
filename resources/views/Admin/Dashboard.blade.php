@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang di panel admin')

@section('content')

{{-- STATS CARD --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#fff3e0;">
                        <i class="bi bi-people fs-4" style="color:#c8860a;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total User</div>
                        <div class="fw-bold fs-4" style="color:#3d2b1f;">{{ $totalUser }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#e8f5e9;">
                        <i class="bi bi-clipboard-data fs-4" style="color:#28a745;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Analisis</div>
                        <div class="fw-bold fs-4" style="color:#3d2b1f;">{{ $totalAnalisis }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#e3f2fd;">
                        <i class="bi bi-journal-richtext fs-4" style="color:#1976d2;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Edukasi</div>
                        <div class="fw-bold fs-4" style="color:#3d2b1f;">{{ $totalEdukasi }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px; background:#fce4ec;">
                        <i class="bi bi-diagram-3 fs-4" style="color:#e91e63;"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Rule CF</div>
                        <div class="fw-bold fs-4" style="color:#3d2b1f;">{{ $totalRule }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- RIWAYAT TERBARU --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center"
         style="border-radius:12px 12px 0 0;">
        <h6 class="fw-bold mb-0" style="color:#3d2b1f;">
            <i class="bi bi-clock-history me-2"></i>Riwayat Analisis Terbaru
        </h6>
        <a href="{{ route('admin.riwayat.index') }}"
           class="btn btn-sm btn-outline-secondary">
            Lihat Semua
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Tanggal</th>
                        <th>Grade</th>
                        <th>Keyakinan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatTerbaru as $item)
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
                        <td class="ps-4">
                            <div class="fw-semibold small">{{ $item->user->name }}</div>
                            <small class="text-muted">{{ $item->user->email }}</small>
                        </td>
                        <td>
                            <small>{{ $item->created_at->format('d M Y H:i') }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $color }} px-3">
                                Grade {{ $item->grade_hasil }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress" style="height:6px; width:80px;">
                                    <div class="progress-bar bg-{{ $color }}"
                                         style="width:{{ $item->persentase_cf }}%">
                                    </div>
                                </div>
                                <small>{{ $item->persentase_cf }}%</small>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Belum ada riwayat analisis
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection