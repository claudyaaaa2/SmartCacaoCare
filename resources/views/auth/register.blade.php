<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - SmartCacaoCare</title>
    <style>
        :root {
            --bg: #07111f;
            --panel: rgba(255, 255, 255, 0.96);
            --border: rgba(15, 23, 42, 0.10);
            --text: #102033;
            --muted: #5b687a;
            --primary: #0f766e;
            --primary-dark: #115e59;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(217, 119, 6, 0.26), transparent 28%),
                radial-gradient(circle at right 20%, rgba(15, 118, 110, 0.22), transparent 24%),
                linear-gradient(135deg, #07111f 0%, #0f172a 50%, #111827 100%);
            color: var(--text);
            padding: 24px;
        }

        .card {
            width: min(100%, 560px);
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 28px;
            box-shadow: 0 28px 80px rgba(2, 6, 23, 0.28);
            overflow: hidden;
        }

        .hero {
            padding: 28px 28px 20px;
            color: #fff;
            background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
        }

        .hero .badge {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            font-size: 0.875rem;
            font-weight: 700;
        }

        .hero h1 {
            margin: 14px 0 8px;
            font-size: 1.9rem;
            line-height: 1.05;
        }

        .hero p {
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.65;
        }

        .body {
            padding: 26px 28px 28px;
        }

        .alert {
            border-radius: 16px;
            padding: 12px 14px;
            margin-bottom: 16px;
            background: #fff1f2;
            color: #9f1239;
        }

        .field {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #1e293b;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            outline: none;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 18px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 18px;
            border-radius: 14px;
            border: 0;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
        }

        .button.primary {
            background: linear-gradient(135deg, var(--primary) 0%, #14b8a6 100%);
            color: #fff;
            flex: 1;
        }

        .button.secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        .footer {
            margin-top: 16px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .footer a {
            color: var(--primary-dark);
            font-weight: 800;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <section class="card">
        <div class="hero">
            <div class="badge">Registrasi Petani</div>
            <h1>Buat akun SmartCacaoCare</h1>
            <p>Pendaftar baru akan otomatis menjadi user/petani dan bisa langsung memakai halaman analisis.</p>
        </div>

        <div class="body">
            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label for="name">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="field">
                    <label for="password_confirmation">Ulangi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                <div class="actions">
                    <button class="button primary" type="submit">Daftar</button>
                    <a class="button secondary" href="{{ route('login') }}">Masuk</a>
                </div>
            </form>

            <div class="footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>.
            </div>
        </div>
    </section>
</body>
</html>