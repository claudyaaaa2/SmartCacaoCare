<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - SmartCacaoCare</title>
    
    {{-- Google Fonts: Outfit (Display) and Inter (Body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @endif
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="bg-deep-green text-ink font-body min-h-screen flex items-center justify-center p-[24px]">

    <div class="contact-form-card w-full max-w-[480px]">
        @if ($errors->any())
            <div class="bg-error/10 text-error p-4 rounded-xs mb-6 text-body">
                <div class="flex items-center gap-2 mb-2 font-medium"><i data-lucide="alert-triangle" class="w-4 h-4"></i> Terdapat kesalahan</div>
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <div class="mb-10 text-center">
            <div class="w-12 h-12 bg-primary text-white rounded-xs flex items-center justify-center mx-auto mb-6">
                <i data-lucide="leaf" class="w-6 h-6"></i>
            </div>
            <h1 class="text-section-heading mb-2">Masuk akun</h1>
            <p class="text-body text-muted">Akses dashboard petani atau admin.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
            @csrf
            <div>
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" required autofocus>
            </div>
            <div>
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-input" required>
            </div>
            
            <div class="flex flex-col gap-4 mt-4">
                <button class="btn-primary w-full" type="submit">Masuk</button>
                <a class="btn-secondary w-full" href="{{ url('/') }}">Kembali ke Beranda</a>
            </div>
        </form>

        <div class="text-center mt-10 text-caption text-muted">
            Belum punya akun? <a href="{{ route('register') }}" class="text-action-blue font-medium hover:underline">Daftar di sini</a>.
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
