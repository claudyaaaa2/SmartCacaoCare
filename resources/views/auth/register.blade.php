<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - SmartCacaoCare</title>
    
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
<body class="bg-white text-ink font-body min-h-screen flex items-center justify-center p-0">

    <div class="w-full overflow-hidden">
        <div class="flex flex-col md:flex-row min-h-screen">
            <div class="md:w-1/2 w-full h-screen relative bg-cover bg-center" style="background-image:url('{{ asset('cacao.jpg') }}')">
                <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
            </div>

            <div class="md:w-1/2 w-full bg-white p-8 md:p-12 flex flex-col h-screen justify-center">
                <div class="w-full max-w-[480px] mx-auto">
                    @if ($errors->any())
                        <div class="bg-error/10 text-error p-4 rounded-xs mb-6 text-body">
                            <div class="flex items-center gap-2 mb-2 font-medium"><i data-lucide="alert-triangle" class="w-4 h-4"></i> Terdapat kesalahan</div>
                            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                        </div>
                    @endif

                    <div class="text-center mb-6">
                        <a href="{{ url('/') }}" class="inline-block text-deep-green font-display font-semibold text-sm">SmartCacaoCare</a>
                        <h1 class="text-[28px] font-display font-semibold text-ink mt-3">Buat akun</h1>
                        <p class="text-body text-muted max-w-[36ch] mx-auto mt-2">Daftar untuk mulai melakukan analisis.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                        @csrf
                        <div>
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-input" required autofocus>
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input" required>
                        </div>
                        <div>
                            <label for="password" class="form-label">Password</label>
                            <input id="password" name="password" type="password" class="form-input" required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" required>
                        </div>

                        <div class="mt-4">
                            <button class="btn-primary w-full rounded-full py-3" type="submit">Daftar</button>
                        </div>
                    </form>

                    <div class="text-center mt-6">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-action-blue font-medium hover:underline">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
