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
    <div class="wrap">
        <div class="left">
            <div class="mark"><i data-lucide="leaf" style="width:24px;height:24px;color:rgba(255,255,255,.7)"></i></div>
            <div class="badge"><i data-lucide="user-plus" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Akun baru</div>
            <h1>Daftar akun baru</h1>
            <p>Daftar untuk mulai melakukan analisis, melihat edukasi, dan menyimpan riwayat pengamatan.</p>
            <div class="note"><i data-lucide="info" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Pastikan email aktif untuk konfirmasi dan pemulihan akun.</div>
        </div>

        <div class="right">
            <h2><i data-lucide="user-plus" style="width:20px;height:20px;display:inline;vertical-align:middle"></i> Buat akun</h2>
            <p class="muted">Form singkat untuk petani atau admin yang akan memakai sistem.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field">
                    <label for="name"><i data-lucide="user" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="field">
                    <label for="email"><i data-lucide="mail" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                </div>
                <div class="field">
                    <label for="password"><i data-lucide="lock" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Password</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="field">
                    <label for="password_confirmation"><i data-lucide="lock" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Konfirmasi password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>
                <div class="actions">
                    <button class="button primary" type="submit"><i data-lucide="check" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Daftar</button>
                </div>
            </form>

            <div class="footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
