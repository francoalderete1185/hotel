<header
    x-data="{ scrolled: false, menuOpen: false }"
    x-on:scroll.window="scrolled = window.scrollY > 40"
    :class="scrolled ? 'bg-white shadow-sm' : 'bg-transparent'"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 shrink-0">
                <span class="text-navy-500 text-xl" aria-hidden="true"><i class="ti ti-building"></i></span>
                <span
                    :class="scrolled ? 'text-neutral-900' : 'text-white'"
                    class="font-serif text-xl font-semibold tracking-wide transition-colors duration-300"
                >Hotel Parlamento</span>
                <span
                    :class="scrolled ? 'text-neutral-400' : 'text-white/60'"
                    class="font-sans text-xs font-normal tracking-normal transition-colors duration-300"
                >★★★</span>
            </a>

            {{-- Nav links desktop --}}
            <nav class="hidden lg:flex items-center gap-8">
                @foreach ([
                    ['#habitaciones', 'Habitaciones'],
                    ['#servicios',    'Servicios'],
                    ['#ubicacion',    'Ubicación'],
                    ['#contacto',     'Contacto'],
                ] as [$href, $label])
                    <a
                        href="{{ $href }}"
                        :class="scrolled ? 'text-neutral-700 hover:text-navy-500' : 'text-white/90 hover:text-white'"
                        class="text-sm font-medium transition-colors duration-200"
                    >{{ $label }}</a>
                @endforeach
            </nav>

            {{-- CTA + hamburger --}}
            <div class="flex items-center gap-4">
                <a href="#reservar" class="hidden lg:inline-flex btn-primary text-sm py-2 px-5">
                    Reservar
                </a>
                <button
                    x-on:click="menuOpen = !menuOpen"
                    :class="scrolled ? 'text-neutral-800' : 'text-white'"
                    class="lg:hidden p-2 rounded-md transition-colors"
                    aria-label="Menú"
                >
                    <i x-show="!menuOpen" class="ti ti-menu-2 text-2xl"></i>
                    <i x-show="menuOpen"  class="ti ti-x text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div
        x-show="menuOpen"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-t border-neutral-100 shadow-lg"
    >
        <nav class="flex flex-col px-4 py-4 gap-1">
            @foreach ([
                ['#habitaciones', 'Habitaciones'],
                ['#servicios',    'Servicios'],
                ['#ubicacion',    'Ubicación'],
                ['#contacto',     'Contacto'],
            ] as [$href, $label])
                <a
                    href="{{ $href }}"
                    x-on:click="menuOpen = false"
                    class="text-neutral-700 hover:text-navy-500 font-medium py-2.5 border-b border-neutral-50 text-sm transition-colors"
                >{{ $label }}</a>
            @endforeach
            <a href="#reservar" class="btn-primary mt-3 text-sm">Reservar ahora</a>
        </nav>
    </div>
</header>
