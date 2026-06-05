<section
    id="inicio"
    class="relative min-h-screen flex flex-col justify-center bg-navy-900"
>
    {{-- Imagen de fondo con overlay navy 70% --}}
    <div class="absolute inset-0 overflow-hidden">
        <img
            src="/images/hotel/doble-1.jpg"
            alt="Hotel Parlamento"
            class="w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-navy-900/70"></div>
    </div>

    {{-- Contenido --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20 w-full">
        <div class="max-w-2xl">
            <p class="section-label text-cream-200 mb-4">3 ESTRELLAS · CONGRESO, BUENOS AIRES</p>
            <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl text-cream-50 font-medium leading-tight mb-6">
                Hospedaje porteño con la mejor ubicación
            </h1>
            <p class="text-neutral-100 text-lg sm:text-xl leading-relaxed mb-12 max-w-xl">
                A dos cuadras del Congreso Nacional. 53 habitaciones insonorizadas, desayuno continental incluido y recepción las 24 horas.
            </p>
        </div>

        {{-- Formulario de búsqueda --}}
        <div id="reservar" class="bg-white rounded-sm shadow-2xl p-4 sm:p-6 max-w-4xl">
            <form
                action="/reservar"
                method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"
            >
                <div class="flex flex-col gap-1">
                    <label for="check_in" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Check-in</label>
                    <input
                        type="date"
                        id="check_in"
                        name="check_in"
                        class="border border-neutral-200 rounded-sm px-3 py-2.5 text-sm text-neutral-800 focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 transition"
                    >
                </div>

                <div class="flex flex-col gap-1">
                    <label for="check_out" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Check-out</label>
                    <input
                        type="date"
                        id="check_out"
                        name="check_out"
                        class="border border-neutral-200 rounded-sm px-3 py-2.5 text-sm text-neutral-800 focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 transition"
                    >
                </div>

                <div class="flex flex-col gap-1">
                    <label for="guests" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Huéspedes</label>
                    <select
                        id="guests"
                        name="guests"
                        class="border border-neutral-200 rounded-sm px-3 py-2.5 text-sm text-neutral-800 focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 transition bg-white"
                    >
                        <option value="">Seleccioná</option>
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'huésped' : 'huéspedes' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 bg-navy-700 hover:bg-navy-900 text-white font-semibold px-6 py-3 rounded-sm transition-colors duration-200 w-full">
                        <i class="ti ti-search text-base"></i>
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 animate-bounce">
        <i class="ti ti-chevrons-down text-2xl"></i>
    </div>
</section>
