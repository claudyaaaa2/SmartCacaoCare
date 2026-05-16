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
    <section class="shell">
        <div class="promo">
            <div class="mark"><i data-lucide="leaf" style="width:24px;height:24px;color:rgba(255,255,255,.7)"></i></div>
            <div class="badge"><i data-lucide="shield" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Login Petani / Admin</div>
            <h1>Masuk ke SmartCacaoCare</h1>
            <p>Gunakan akun yang sudah terdaftar untuk mengakses dashboard petani atau admin.</p>
            <div class="points">
                <div class="point"><i data-lucide="zap" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Akses cepat ke analisis dan edukasi.</div>
                <div class="point"><i data-lucide="eye" style="width:14px;height:14px;display:inline;vertical-align:middle"></i> Tampilan tenang, fokus ke data dan keputusan.</div>
            </div>
        </div>

        <div class="formbox">
            @if ($errors->any())
                <div class="alert">
                    <i data-lucide="alert-triangle" style="width:14px;height:14px;display:inline;vertical-align:middle"></i>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <h2><i data-lucide="log-in" style="width:20px;height:20px;display:inline;vertical-align:middle"></i> Masuk akun</h2>
            <p class="muted">Isi email dan password untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="email"><i data-lucide="mail" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="field">
                    <label for="password"><i data-lucide="lock" style="width:12px;height:12px;display:inline;vertical-align:middle"></i> Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="actions">
                    <button class="button primary" type="submit"><i data-lucide="log-in" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Masuk</button>
                    <a class="button secondary" href="{{ url('/') }}"><i data-lucide="arrow-left" style="width:16px;height:16px;display:inline;vertical-align:middle"></i> Kembali</a>
                </div>
            </form>

            <div class="footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.
            </div>
        </div>
    </section>
    <script>lucide.createIcons();</script>
</body>
</html>
