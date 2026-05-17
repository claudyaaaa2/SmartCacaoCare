@extends('layouts.guest')

@section('title', 'Smart Cocoa Care — Sistem Pakar Kualitas Biji Kakao')

@section('content')

{{-- HERO SECTION --}}
<section style="background: linear-gradient(135deg, #3d2b1f 0%, #7a5240 50%, #c8860a 100%); min-height: 90vh;" class="d-flex align-items-center">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white mb-5 mb-lg-0">
                <span class="badge mb-3 px-3 py-2" style="background: rgba(255,255,255,0.2); font-size: 13px;">
                    🤖 Sistem Pakar Berbasis Certainty Factor
                </span>
                <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">
                    Tentukan Kualitas <span style="color: #ffc107;">Biji Kakao</span> Anda Secara Cepat & Akurat
                </h1>
                <p class="lead mb-4" style="color: rgba(255,255,255,0.85);">
                    Smart Cocoa Care membantu petani kakao menentukan grade kualitas biji kakao
                    berdasarkan kondisi fisik menggunakan teknologi sistem pakar.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg fw-bold px-4">
                        <i class="bi bi-person-plus"></i> Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width:45px; height:45px; background:#28a745;">
                                <i class="bi bi-check-lg text-white fs-5"></i>
                            </div>
                            <div>
                                <small class="text-muted">Hasil Analisis</small>
                                <h6 class="mb-0 fw-bold">Analisis Selesai!</h6>
                            </div>
                        </div>
                        <div class="p-3 rounded mb-3" style="background:#f8f3ee;">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Grade Kualitas</span>
                                <span class="badge bg-success px-3">A — Premium</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Tingkat Keyakinan</span>
                                <span class="fw-bold text-success">89.5%</span>
                            </div>
                            <div class="progress mt-2" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 89.5%"></div>
                            </div>
                        </div>
                        <div class="p-3 rounded" style="background:#fff8e1; border-left: 4px solid #ffc107;">
                            <small class="fw-semibold" style="color:#c8860a;">
                                <i class="bi bi-lightbulb"></i> Rekomendasi:
                            </small>
                            <p class="mb-0 small mt-1">
                                Biji kakao Anda memenuhi standar ekspor.
                                Segera hubungi eksportir untuk harga terbaik!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FITUR SECTION --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:#3d2b1f;">Fitur Unggulan</h2>
            <p class="text-muted">Semua yang Anda butuhkan dalam satu platform</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4 border-0 shadow-sm" style="border-radius:16px;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                         style="width:70px; height:70px; background:#fff3e0;">
                        <i class="bi bi-search fs-2" style="color:#c8860a;"></i>
                    </div>
                    <h5 class="fw-bold" style="color:#3d2b1f;">Analisis Kualitas</h5>
                    <p class="text-muted small">
                        Tentukan grade kualitas biji kakao berdasarkan
                        warna, ukuran, aroma, tekstur, dan kondisi fisik
                        menggunakan algoritma Certainty Factor.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4 border-0 shadow-sm" style="border-radius:16px;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                         style="width:70px; height:70px; background:#e8f5e9;">
                        <i class="bi bi-journal-richtext fs-2" style="color:#28a745;"></i>
                    </div>
                    <h5 class="fw-bold" style="color:#3d2b1f;">Edukasi Pertanian</h5>
                    <p class="text-muted small">
                        Akses artikel edukasi lengkap seputar perawatan
                        tanaman kakao, teknik panen, pengolahan pasca
                        panen, dan pencegahan hama & penyakit.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4 border-0 shadow-sm" style="border-radius:16px;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                         style="width:70px; height:70px; background:#e3f2fd;">
                        <i class="bi bi-clock-history fs-2" style="color:#1976d2;"></i>
                    </div>
                    <h5 class="fw-bold" style="color:#3d2b1f;">Riwayat Analisis</h5>
                    <p class="text-muted small">
                        Pantau semua riwayat analisis kualitas biji kakao
                        Anda. Lacak perkembangan kualitas hasil panen
                        dari waktu ke waktu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CARA KERJA SECTION --}}
<section class="py-5" style="background:#f0ebe3;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:#3d2b1f;">Cara Kerja Sistem</h2>
            <p class="text-muted">Hanya 3 langkah mudah</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:60px; height:60px; background:#3d2b1f;">
                    <span class="text-white fw-bold fs-4">1</span>
                </div>
                <h6 class="fw-bold" style="color:#3d2b1f;">Daftar & Login</h6>
                <p class="text-muted small">Buat akun gratis dan masuk ke sistem Smart Cocoa Care</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:60px; height:60px; background:#c8860a;">
                    <span class="text-white fw-bold fs-4">2</span>
                </div>
                <h6 class="fw-bold" style="color:#3d2b1f;">Pilih Kondisi Biji</h6>
                <p class="text-muted small">Pilih kondisi biji kakao Anda dari dropdown yang tersedia</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:60px; height:60px; background:#28a745;">
                    <span class="text-white fw-bold fs-4">3</span>
                </div>
                <h6 class="fw-bold" style="color:#3d2b1f;">Lihat Hasil</h6>
                <p class="text-muted small">Sistem menampilkan grade kualitas beserta rekomendasi penanganan</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-5 text-center text-white"
         style="background: linear-gradient(135deg, #3d2b1f 0%, #5c3d2e 100%);">
    <div class="container">
        <h2 class="fw-bold mb-3">Mulai Analisis Sekarang!</h2>
        <p class="mb-4" style="color:rgba(255,255,255,0.8);">
            Gratis, mudah, dan akurat. Bantu tingkatkan kualitas hasil panen kakao Anda.
        </p>
        <a href="{{ route('register') }}" class="btn btn-warning btn-lg fw-bold px-5">
            <i class="bi bi-person-plus"></i> Daftar Sekarang — Gratis!
        </a>
    </div>
</section>

@endsection