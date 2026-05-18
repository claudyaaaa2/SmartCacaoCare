@extends('layouts.admin')

@section('title', 'Riwayat Analisis')
@section('subtitle', 'Semua riwayat analisis user')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0" style="color:#3d2b1f;">Riwayat Analisis</h5>
        <small class="text-muted">Total {{ $riwayat->total() }} analisis</small>
    </div>
</div>

{{-- TABEL --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Grade</th>
                        <th>Keyakinan</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $item)
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
                            {{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ $item->user->name }}</div>
                            <small class="text-muted">{{ $item->user->email }}</small>
                        </td>
                        <td>
                            <div>{{ $item->created_at->format('d M Y') }}</div>
                            <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
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
                                <small class="fw-semibold">{{ $item->persentase_cf }}%</small>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ Str::limit($item->rekomendasi, 50) }}
                            </small>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada riwayat analisis
                        </td>
                    </tr>
                    @endforelse
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

@endsection