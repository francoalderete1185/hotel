<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Hotel Parlamento</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream-50 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 mb-2">
                <i class="ti ti-building text-navy-500 text-xl"></i>
                <span class="font-serif text-2xl text-navy-700 font-medium">Hotel Parlamento</span>
            </div>
            <p class="text-xs text-neutral-400 uppercase tracking-widest font-semibold">Panel de administración</p>
        </div>

        {{-- Card --}}
        <div class="bg-white border border-neutral-100 rounded-sm shadow-sm p-8">

            @if($errors->any())
                <div class="mb-5 text-sm text-red-600 bg-red-50 border border-red-100 rounded-sm px-4 py-3 flex items-center gap-2">
                    <i class="ti ti-alert-circle shrink-0"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@hotelparlamento.com.ar"
                        autofocus
                        class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 @error('email') border-red-300 @enderror"
                    >
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-navy-700 hover:bg-navy-900 text-white font-semibold py-3 rounded-sm text-sm transition-colors duration-200"
                >
                    Ingresar
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-neutral-300 mt-6">
            &larr; <a href="/" class="hover:text-neutral-500 transition-colors">Volver al sitio</a>
        </p>

    </div>

</body>
</html>
