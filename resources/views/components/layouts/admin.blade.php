@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — Hotel Parlamento · Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 min-h-screen font-sans text-neutral-800 antialiased">

    {{-- Topbar --}}
    <header class="bg-navy-700 text-white h-14 flex items-center px-6 sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-2 shrink-0">
            <i class="ti ti-building text-navy-300 text-lg"></i>
            <span class="text-sm font-semibold">Hotel Parlamento</span>
            <span class="text-navy-400 text-sm font-normal">· Admin</span>
        </div>

        <nav class="flex gap-6 ml-10">
            <a href="{{ route('admin.habitaciones') }}"
               class="text-sm transition-colors {{ request()->routeIs('admin.habitaciones*') ? 'text-white font-semibold' : 'text-navy-300 hover:text-white' }}">
                Habitaciones
            </a>
            <a href="{{ route('admin.reservas') }}"
               class="text-sm transition-colors {{ request()->routeIs('admin.reservas*') ? 'text-white font-semibold' : 'text-navy-300 hover:text-white' }}">
                Reservas
            </a>
            <a href="{{ route('admin.configuracion') }}"
               class="text-sm transition-colors {{ request()->routeIs('admin.configuracion*') ? 'text-white font-semibold' : 'text-navy-300 hover:text-white' }}">
                Configuración
            </a>
        </nav>

        <div class="ml-auto flex items-center gap-5">
            <a href="{{ route('home') }}" target="_blank"
               class="text-sm text-navy-300 hover:text-white transition-colors flex items-center gap-1">
                <i class="ti ti-external-link text-xs"></i>
                Ver sitio
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-navy-300 hover:text-white transition-colors">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </header>

    {{-- Flash --}}
    @if(session('success'))
        <div class="bg-green-50 border-b border-green-200 text-green-700 text-sm px-6 py-3 flex items-center gap-2">
            <i class="ti ti-circle-check shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-b border-red-100 text-red-600 text-sm px-6 py-3 flex items-center gap-2">
            <i class="ti ti-alert-circle shrink-0"></i>
            {{ session('error') }}
        </div>
    @endif

    <main class="max-w-6xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>

</body>
</html>
