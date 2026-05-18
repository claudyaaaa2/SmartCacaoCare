@extends('layouts.app')

@section('title', 'Riwayat Analisis')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color:#3d2b1f;">
            <i class="bi bi-clock-history me-2"></i>Riwayat Analisis
        </h4>
        <p class="text-muted mb-0">Daftar semua analisis kualitas biji kakao Anda</p>
    </div>
    <a href="{{ route('user.analisis') }}" class="btn btn-cocoa px-4">
        <i class="bi bi-plus me-1"></i> Analisis Baru
    </a>
</div>

{{-- TABEL RIWAYAT --}}
@if($riwayat->count() > 0)
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Tanggal</th>
                        <th>Grade</th>
                        <th>Keyakinan</th>
                        <th>Rekomendasi</th>
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
                        <td class="ps-4">
                            {{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}
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
                                {{ Str::limit($item->rekomendasi, 60) }}
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
{{-- KOSONG --}}
<div class="card border-0 shadow-sm text-center p-5" style="border-radius:12px;">
    <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
    <h6 class="text-muted">Belum ada riwayat analisis</h6>
    <p class="text-muted small mb-3">
        Mulai analisis kualitas biji kakao Anda sekarang!
    </p>
    <a href="{{ route('user.analisis') }}" class="btn btn-cocoa px-4">
        Mulai Analisis
    </a>
</div>
@endif

@endsection