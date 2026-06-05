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
<body class="bg-cream-50 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <div class="inline-flex items-center gap-2 mb-4">
            <i class="ti ti-building text-navy-500 text-xl"></i>
            <span class="font-serif text-2xl text-navy-700 font-medium">Hotel Parlamento · Admin</span>
        </div>
        <p class="text-neutral-500 text-sm mb-6">Sesión iniciada como <strong>{{ auth()->user()->email }}</strong></p>
        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-sm text-bordeaux-500 hover:text-bordeaux-700 font-medium transition-colors">
                Cerrar sesión
            </button>
        </form>
    </div>
</body>
</html>
