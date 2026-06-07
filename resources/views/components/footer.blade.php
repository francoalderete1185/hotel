<footer id="contacto" class="bg-neutral-950 text-neutral-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

            {{-- Columna 1: Marca y Contacto --}}
            <div id="ubicacion">
                <div class="flex items-center gap-2 mb-3">
                    <i class="ti ti-building text-navy-500 text-lg"></i>
                    <span class="font-serif text-white text-lg font-medium">Hotel Parlamento</span>
                </div>
                <p class="text-sm leading-relaxed mb-5">
                    Hospedaje en el centro de Buenos Aires desde hace décadas.
                </p>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2.5">
                        <i class="ti ti-map-pin text-navy-500 mt-0.5 shrink-0"></i>
                        <span>Rodríguez Peña 61<br>C1020ADA, CABA</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="ti ti-phone text-navy-500 shrink-0"></i>
                        <a href="tel:+5491176759957" class="hover:text-cream-100 transition-colors">11 7675-9957</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="ti ti-mail text-navy-500 shrink-0"></i>
                        <a href="mailto:reservas@hotelparlamento.com.ar" class="hover:text-cream-100 transition-colors">reservas@hotelparlamento.com.ar</a>
                    </li>
                </ul>
            </div>

            {{-- Columna 2: Hotel --}}
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Hotel</h4>
                <ul class="space-y-3 text-sm">
                    @foreach ([
                        ['#habitaciones', 'Habitaciones'],
                        ['#servicios',    'Servicios'],
                        ['#ubicacion',    'Ubicación'],
                    ] as [$href, $label])
                        <li>
                            <a href="{{ $href }}" class="hover:text-cream-100 transition-colors">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Columna 3: Reservas --}}
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Reservas</h4>
                <ul class="space-y-3 text-sm">
                    @foreach ([
                        ['/mis-reservas', 'Mi reserva'],
                        ['#',            'Cancelación'],
                        ['#',            'FAQ'],
                    ] as [$href, $label])
                        <li>
                            <a href="{{ $href }}" class="hover:text-cream-100 transition-colors">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Columna 4: Legal --}}
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Legal</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('legal.terminos') }}" class="hover:text-cream-100 transition-colors">Términos y condiciones</a></li>
                    <li><a href="{{ route('legal.privacidad') }}" class="hover:text-cream-100 transition-colors">Política de privacidad</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Footer bottom --}}
    <div class="border-t border-neutral-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 text-xs text-center sm:text-left">
            <p>&copy; {{ date('Y') }} Hotel Parlamento · CUIT 30-XXXXXXXX-X · Diseñado en Buenos Aires</p>
        </div>
    </div>
</footer>
