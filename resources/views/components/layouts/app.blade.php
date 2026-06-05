<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Hotel Parlamento — Hospedaje en el centro de Buenos Aires. 3 estrellas, Congreso, CABA.' }}">
    <title>{{ $title ?? 'Hotel Parlamento' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">

    <x-nav />

    @if(session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:leave="transition duration-300 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="bg-red-50 border-b border-red-200 text-red-700 text-sm px-4 py-3 text-center"
    >
        <i class="ti ti-alert-circle mr-1"></i>
        {{ session('error') }}
        <button @click="show = false" class="ml-3 font-bold hover:text-red-900">&times;</button>
    </div>
    @endif

    <main>
        {{ $slot }}
    </main>

    <x-footer />

</body>
</html>
