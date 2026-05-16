<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Daftar akun SmartCacaoCare untuk mulai analisis mutu kakao.">
    <title>Daftar - SmartCacaoCare</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <div class="wrap">
        <div class="left">
            <div class="mark"></div>
            <div class="badge">Akun baru</div>
            <h1>Daftar akun baru</h1>
            <p>Daftar untuk mulai melakukan analisis, melihat edukasi, dan menyimpan riwayat pengamatan.</p>
            <div class="note">Pastikan email aktif untuk konfirmasi dan pemulihan akun.</div>
        </div>

        <div class="right">
            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <h2>Buat akun</h2>
            <p class="muted">Form singkat untuk petani atau admin yang akan memakai sistem.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field">
                    <label for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="field">
                    <label for="password_confirmation">Konfirmasi password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>
                <div class="actions">
                    <button class="sc-btn primary" type="submit">Daftar</button>
                    <a class="sc-btn secondary" href="{{ route('login') }}">Sudah punya akun</a>
                </div>
            </form>

            <div class="footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
        </div>
    </div>
</body>
</html>
