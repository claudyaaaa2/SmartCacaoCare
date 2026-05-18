<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - SmartCacaoCare</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>body{font-family:'Inter',system-ui,sans-serif;}</style>
    @endif
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body>
    <section class="auth-split">
        <div class="auth-visual">
            <div class="sc-mark" style="width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,.08)"><i data-lucide="leaf" style="width:24px;height:24px;color:rgba(255,255,255,.7)"></i></div>
            <span style="font-size:12px;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em">SmartCacaoCare</span>
            <h1 style="font-size:36px;font-weight:800;letter-spacing:-.03em;line-height:1.1">Masuk untuk<br>melanjutkan.</h1>
            <p style="font-size:17px;color:rgba(255,255,255,.56);line-height:1.47">Gunakan akun yang sudah terdaftar untuk mengakses dashboard petani atau admin.</p>
            <div style="display:grid;gap:8px;margin-top:8px">
                <div style="padding:14px 16px;border-radius:12px;background:rgba(255,255,255,.04);font-size:14px;color:rgba(255,255,255,.7);display:flex;align-items:center;gap:10px"><i data-lucide="zap" style="width:16px;height:16px;flex-shrink:0;color:var(--apple-blue)"></i> Akses cepat ke analisis dan edukasi.</div>
                <div style="padding:14px 16px;border-radius:12px;background:rgba(255,255,255,.04);font-size:14px;color:rgba(255,255,255,.7);display:flex;align-items:center;gap:10px"><i data-lucide="eye" style="width:16px;height:16px;flex-shrink:0;color:var(--apple-blue)"></i> Tampilan tenang, fokus ke keputusan.</div>
                <div style="padding:14px 16px;border-radius:12px;background:rgba(255,255,255,.04);font-size:14px;color:rgba(255,255,255,.7);display:flex;align-items:center;gap:10px"><i data-lucide="shield" style="width:16px;height:16px;flex-shrink:0;color:var(--apple-blue)"></i> Data aman dan terproteksi.</div>
            </div>
        </div>

        <div class="auth-form">
            @if ($errors->any())
                <div class="alert"><i data-lucide="alert-triangle" style="width:14px;height:14px;display:inline;vertical-align:middle"></i>
                    @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <h2><i data-lucide="log-in" style="width:22px;height:22px;display:inline;vertical-align:middle"></i> Masuk akun</h2>
            <p style="font-size:14px;color:var(--apple-text-3)">Isi email dan password untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field" style="margin-bottom:12px">
                    <label for="email"><i data-lucide="mail" style="width:12px;height:12px"></i> Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="field" style="margin-bottom:12px">
                    <label for="password"><i data-lucide="lock" style="width:12px;height:12px"></i> Password</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="actions">
                    <button class="button primary" type="submit"><i data-lucide="log-in" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Masuk</button>
                    <a class="button secondary" href="{{ url('/') }}"><i data-lucide="arrow-left" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Kembali</a>
                </div>
            </form>

            <div style="font-size:13px;color:var(--apple-text-3);margin-top:16px">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.</div>
        </div>
    </section>
    <script>lucide.createIcons();</script>
</body>
</html>
