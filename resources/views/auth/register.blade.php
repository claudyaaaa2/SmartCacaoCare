<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - SmartCacaoCare</title>
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
            <h1 style="font-size:36px;font-weight:800;letter-spacing:-.03em;line-height:1.1">Buat akun baru<br>untuk memulai.</h1>
            <p style="font-size:17px;color:rgba(255,255,255,.56);line-height:1.47">Daftar untuk mulai melakukan analisis, melihat edukasi, dan menyimpan riwayat pengamatan.</p>
            <div style="padding:14px 16px;border-radius:12px;background:rgba(255,255,255,.04);font-size:14px;color:rgba(255,255,255,.7);display:flex;align-items:center;gap:10px"><i data-lucide="info" style="width:16px;height:16px;flex-shrink:0;color:var(--apple-blue)"></i> Pastikan email aktif untuk konfirmasi dan pemulihan akun.</div>
        </div>

        <div class="auth-form">
            <h2><i data-lucide="user-plus" style="width:22px;height:22px;display:inline;vertical-align:middle"></i> Buat akun</h2>
            <p style="font-size:14px;color:var(--apple-text-3)">Form singkat untuk petani atau admin yang akan memakai sistem.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field" style="margin-bottom:12px">
                    <label for="name"><i data-lucide="user" style="width:12px;height:12px"></i> Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="field" style="margin-bottom:12px">
                    <label for="email"><i data-lucide="mail" style="width:12px;height:12px"></i> Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                </div>
                <div class="field" style="margin-bottom:12px">
                    <label for="password"><i data-lucide="lock" style="width:12px;height:12px"></i> Password</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="field" style="margin-bottom:12px">
                    <label for="password_confirmation"><i data-lucide="lock" style="width:12px;height:12px"></i> Konfirmasi password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>
                <div class="actions">
                    <button class="button primary" type="submit"><i data-lucide="check" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Daftar</button>
                </div>
            </form>

            <div style="font-size:13px;color:var(--apple-text-3);margin-top:16px">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
        </div>
    </section>
    <script>lucide.createIcons();</script>
</body>
</html>
