@extends('layouts.guest')

@section('title', 'Masuk — Smart Cocoa Care')

@push('styles')
<style>
.navbar-guest { display: none !important; }
.wrapper { display: flex; min-height: 100vh; }
.left {
  width: 42%;
  background: linear-gradient(160deg, #2a1a0e 0%, #3d2b1f 40%, #6b3e1e 80%, #c8860a 100%);
  padding: 32px 28px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.left-brand h2 { color: #fff; font-size: 20px; font-weight: 600; margin-bottom: 4px; }
.left-brand p { color: rgba(255,255,255,0.6); font-size: 12px; }
.left-content { flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 12px; }
.info-card { background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 14px; }
.info-card-title { color: #fff; font-size: 13px; font-weight: 600; margin-bottom: 4px; }
.info-card-desc { color: rgba(255,255,255,0.65); font-size: 12px; line-height: 1.5; }
.left-footer { color: rgba(255,255,255,0.4); font-size: 11px; }
.right { flex: 1; background: #f8f3ee; display: flex; align-items: center; justify-content: center; padding: 40px 32px; }
.form-box { width: 100%; max-width: 380px; }
.form-title { font-size: 24px; font-weight: 600; color: #3d2b1f; margin-bottom: 4px; }
.form-subtitle { font-size: 13px; color: #888; margin-bottom: 24px; }
.form-group { margin-bottom: 16px; }
.form-label { display: block; font-size: 13px; font-weight: 500; color: #3d2b1f; margin-bottom: 6px; }
.input-wrap { display: flex; align-items: center; border: 1px solid #dee2e6; border-radius: 8px; background: #fff; overflow: hidden; }
.input-icon { padding: 0 12px; color: #888; display: flex; align-items: center; height: 42px; }
.form-input { border: none; outline: none; padding: 0 12px 0 0; font-size: 14px; height: 42px; width: 100%; background: transparent; }
.btn-submit { width: 100%; background: #3d2b1f; color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 14px; font-weight: 500; cursor: pointer; margin-top: 4px; margin-bottom: 16px; }
.btn-submit:hover { background: #5c3d2e; }
.divider { border: none; border-top: 1px solid #e0d6cc; margin: 4px 0 16px; }
.form-footer { text-align: center; font-size: 13px; color: #888; }
.form-footer a { color: #c8860a; font-weight: 500; text-decoration: none; }
.footer-guest { display: none !important; }
</style>
@endpush

@section('content')

<div class="wrapper">
  <div class="left">
    <div class="left-brand">
      <h2>🍫 Smart Cocoa Care</h2>
      <p>Sistem Pakar Kualitas Biji Kakao</p>
    </div>

    <div class="left-content">
      <div class="info-card">
        <div class="info-card-title">🔍 Analisis Kualitas Instan</div>
        <div class="info-card-desc">Tentukan grade kualitas biji kakao Anda berdasarkan kondisi fisik dalam hitungan detik.</div>
      </div>
      <div class="info-card">
        <div class="info-card-title">📚 Pusat Edukasi Kakao</div>
        <div class="info-card-desc">Akses panduan perawatan kakao, teknik panen, dan pengolahan pasca panen.</div>
      </div>
      <div class="info-card">
        <div class="info-card-title">📊 Riwayat Analisis</div>
        <div class="info-card-desc">Pantau perkembangan kualitas hasil panen kakao Anda dari waktu ke waktu.</div>
      </div>
    </div>

    <div class="left-footer">© {{ date('Y') }} Smart Cocoa Care — Kelompok 8</div>
  </div>

  <div class="right">
    <div class="form-box">
      <h1 class="form-title">Selamat Datang!</h1>
      <p class="form-subtitle">Masuk ke akun Smart Cocoa Care Anda</p>

      @if($errors->any())
        <div class="alert alert-danger py-2 mb-3">
          <i class="bi bi-exclamation-circle me-1"></i>
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label">Email</label>
          <div class="input-wrap">
            <div class="input-icon"><i class="bi bi-envelope"></i></div>
            <input class="form-input" type="email" name="email"
                   placeholder="nama@email.com"
                   value="{{ old('email') }}" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <div class="input-wrap">
            <div class="input-icon"><i class="bi bi-lock"></i></div>
            <input class="form-input" type="password" name="password"
                   placeholder="Masukkan password" required>
          </div>
        </div>

        <button class="btn-submit" type="submit">
          <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>

        <hr class="divider">

        <div class="form-footer">
          Belum punya akun?
          <a href="{{ route('register') }}">Daftar Gratis</a>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection