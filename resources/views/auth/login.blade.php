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
        <style>body{font-family:'Nunito',system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;}</style>
    @endif
</head>
<body>
    <section class="shell">
        <div class="promo">
            <div class="mark"></div>
            <div class="badge">Login Petani / Admin</div>
            <h1>Masuk ke SmartCacaoCare</h1>
            <p>Gunakan akun yang sudah terdaftar untuk mengakses dashboard petani atau admin.</p>
            <div class="points">
                <div class="point">Akses cepat ke analisis dan edukasi.</div>
                <div class="point">Tampilan tenang, fokus ke data dan keputusan.</div>
            </div>
        </div>

        <div class="formbox">
            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <h2>Masuk akun</h2>
            <p class="muted">Isi email dan password untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="actions">
                    <button class="button primary" type="submit">Masuk</button>
                    <a class="button secondary" href="{{ url('/') }}">Kembali</a>
                </div>
            </form>

            <div class="footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.
            </div>
        </div>
    </section>
</body>
</html>
