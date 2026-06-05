<x-layouts.app title="Hotel Parlamento — 3 estrellas, Congreso, Buenos Aires" description="Hotel Parlamento, 3 estrellas en el centro de Buenos Aires. 53 habitaciones insonorizadas, desayuno incluido, recepción 24hs. Rodríguez Peña 61, CABA.">

    {{-- Hero --}}
    <x-hero />

    {{-- Habitaciones --}}
    <section id="habitaciones" class="py-20 lg:py-28 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 lg:mb-16">
                <p class="section-label mb-3">NUESTRAS HABITACIONES</p>
                <h2 class="font-serif text-4xl lg:text-5xl text-neutral-900 font-medium mb-4">
                    Cómodas, silenciosas, con todo lo necesario
                </h2>
                <p class="text-neutral-500 text-base max-w-xl mx-auto">
                    Tres opciones para parejas, grupos chicos o familias. Desayuno continental incluido en todas las tarifas.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($rooms as $room)
                    <x-room-card :room="$room" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Servicios --}}
    <section id="servicios" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 lg:mb-16">
                <p class="section-label mb-3">SERVICIOS</p>
                <h2 class="font-serif text-4xl lg:text-5xl text-neutral-900 font-medium">
                    Lo que incluye tu estadía
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 max-w-5xl mx-auto">
                @foreach($amenities as $amenity)
                    <x-amenity-card :amenity="$amenity" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonios --}}
    <section class="py-20 lg:py-28 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 lg:mb-16">
                <p class="section-label mb-3">OPINIONES DE HUÉSPEDES</p>
                <h2 class="font-serif text-4xl lg:text-5xl text-neutral-900 font-medium">
                    Lo que dicen quienes nos eligieron
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <x-testimonial-card :testimonial="$testimonial" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Final --}}
    <section class="py-24 bg-neutral-900 text-center">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-serif text-4xl lg:text-5xl text-white font-medium mb-6">
                Reservá directo y pagá menos
            </h2>
            <p class="text-neutral-400 text-lg mb-10">
                Sin intermediarios. Cancelación gratuita hasta 48 hs antes del check-in.
            </p>
            <a href="#reservar" class="btn-primary text-base px-10 py-4">
                <i class="ti ti-calendar-check text-lg"></i>
                Reservar ahora
            </a>
        </div>
    </section>

</x-layouts.app>
