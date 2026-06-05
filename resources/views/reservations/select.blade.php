<x-layouts.app title="Elegí tu habitación — Hotel Parlamento">

    {{-- ── Top bar ────────────────────────────────────────────────── --}}
    <div class="bg-white border-b border-neutral-100 pt-16 lg:pt-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            <x-checkout-stepper :current="2" />

            {{-- Barra de búsqueda / edición --}}
            <div
                x-data="{
                    editing: false,
                    checkIn:  '{{ $checkIn }}',
                    checkOut: '{{ $checkOut }}',
                    guests:   {{ $guests }}
                }"
                class="bg-neutral-50 border border-neutral-200 rounded-sm"
            >
                {{-- Vista resumen --}}
                <div x-show="!editing" class="flex flex-wrap items-center gap-x-6 gap-y-2 px-4 py-3 text-sm">
                    <div class="flex items-center gap-2 text-neutral-700">
                        <i class="ti ti-calendar text-navy-500"></i>
                        <span class="font-medium">
                            {{ \Carbon\Carbon::parse($checkIn)->format('d/m/Y') }}
                            &rarr;
                            {{ \Carbon\Carbon::parse($checkOut)->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-neutral-500">
                        <i class="ti ti-moon text-navy-500"></i>
                        {{ $nights }} {{ $nights === 1 ? 'noche' : 'noches' }}
                    </div>
                    <div class="flex items-center gap-2 text-neutral-500">
                        <i class="ti ti-users text-navy-500"></i>
                        {{ $guests }} {{ $guests === 1 ? 'huésped' : 'huéspedes' }}
                    </div>
                    <button
                        @click="editing = true"
                        class="ml-auto text-bordeaux-500 hover:text-bordeaux-700 font-semibold text-xs uppercase tracking-wider flex items-center gap-1"
                    >
                        <i class="ti ti-pencil text-sm"></i> Editar
                    </button>
                </div>

                {{-- Formulario de edición --}}
                <form
                    x-show="editing"
                    x-transition:enter="transition duration-150 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    action="/reservar"
                    method="GET"
                    class="flex flex-wrap gap-3 items-end px-4 py-4"
                >
                    <div class="flex flex-col gap-1 min-w-0">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Check-in</label>
                        <input
                            type="date"
                            name="check_in"
                            x-model="checkIn"
                            class="border border-neutral-200 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                        >
                    </div>
                    <div class="flex flex-col gap-1 min-w-0">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Check-out</label>
                        <input
                            type="date"
                            name="check_out"
                            x-model="checkOut"
                            class="border border-neutral-200 rounded-sm px-3 py-2 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                        >
                    </div>
                    <div class="flex flex-col gap-1 min-w-0">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Huéspedes</label>
                        <select
                            name="guests"
                            x-model="guests"
                            class="border border-neutral-200 rounded-sm px-3 py-2 text-sm bg-white focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                        >
                            @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'huésped' : 'huéspedes' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="btn-primary text-sm py-2 px-4">
                            Actualizar
                        </button>
                        <button
                            type="button"
                            @click="editing = false"
                            class="text-sm py-2 px-4 border border-neutral-200 rounded-sm text-neutral-600 hover:bg-neutral-50 transition-colors"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── Contenido principal ────────────────────────────────────── --}}
    <section class="bg-neutral-50 min-h-screen py-10 lg:py-14">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="font-serif text-3xl lg:text-4xl text-neutral-900 font-medium mb-2">
                Elegí tu habitación
            </h1>
            <p class="text-neutral-500 text-sm mb-8">
                {{ $rooms->where('selectable', true)->count() }}
                {{ $rooms->where('selectable', true)->count() === 1 ? 'habitación disponible' : 'habitaciones disponibles' }}
                para tus fechas
            </p>

            @if($rooms->where('selectable', true)->isEmpty())
                {{-- Empty state --}}
                <div class="text-center py-20 bg-white border border-neutral-100 rounded-sm">
                    <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-calendar-off text-2xl text-neutral-400"></i>
                    </div>
                    <h2 class="font-serif text-2xl text-neutral-800 mb-2">Sin disponibilidad</h2>
                    <p class="text-neutral-500 text-sm max-w-sm mx-auto mb-6">
                        No hay habitaciones disponibles para las fechas y cantidad de huéspedes seleccionadas.
                        Probá con otras fechas.
                    </p>
                    <a href="/" class="btn-primary text-sm">
                        <i class="ti ti-arrow-left text-sm"></i>
                        Cambiar búsqueda
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    @foreach($rooms as $room)
                        <article class="relative bg-white border border-neutral-100 rounded-sm overflow-hidden
                            {{ $room->selectable ? 'hover:shadow-md transition-shadow duration-300' : 'opacity-80' }}">

                            {{-- Imágenes --}}
                            <div class="relative overflow-hidden aspect-[16/9] {{ $room->selectable ? '' : 'grayscale' }}">
                                <x-room-carousel :images="$room->images" :alt="$room->name" />

                                {{-- Overlay de no disponibilidad --}}
                                @if(! $room->selectable)
                                    <div class="absolute inset-0 bg-neutral-900/60 flex items-center justify-center z-20">
                                        <div class="text-center text-white px-4">
                                            <i class="ti {{ $room->date_available ? 'ti-users-minus' : 'ti-calendar-x' }} text-3xl mb-2 block"></i>
                                            <p class="font-semibold text-sm">
                                                @if(! $room->date_available)
                                                    No disponible para esas fechas
                                                @else
                                                    No disponible para {{ $guests }} {{ $guests === 1 ? 'huésped' : 'huéspedes' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                {{-- Badge de capacidad --}}
                                <div class="absolute top-3 right-3 z-10 bg-white/90 backdrop-blur-sm rounded-sm px-2.5 py-1 text-xs font-semibold text-neutral-700">
                                    Hasta {{ $room->capacity }} {{ $room->capacity === 1 ? 'persona' : 'personas' }}
                                </div>
                            </div>

                            {{-- Contenido --}}
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3 mb-1">
                                    <h2 class="font-serif text-xl text-neutral-900 font-medium">{{ $room->name }}</h2>
                                    <span class="text-xs text-neutral-400 whitespace-nowrap mt-1">{{ $room->size_m2 }} m²</span>
                                </div>
                                <p class="text-sm text-neutral-500 leading-relaxed mb-4">{{ $room->short_description }}</p>

                                {{-- Features --}}
                                @if($room->features)
                                    <ul class="flex flex-wrap gap-1.5 mb-5">
                                        @foreach(array_slice($room->features, 0, 4) as $feature)
                                            <li class="text-xs bg-neutral-50 text-neutral-600 px-2.5 py-1 rounded-sm border border-neutral-100">
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                        @if(count($room->features) > 4)
                                            <li class="text-xs text-neutral-400 px-2 py-1">+{{ count($room->features) - 4 }} más</li>
                                        @endif
                                    </ul>
                                @endif

                                {{-- Badge disponibilidad baja (1–3 unidades) --}}
                                @if($room->date_available && $room->available_units <= 3)
                                    <p class="text-xs font-medium text-bordeaux-500 mb-3 flex items-center gap-1">
                                        <i class="ti ti-alert-circle text-sm"></i>
                                        Quedan {{ $room->available_units }} {{ $room->available_units === 1 ? 'disponible' : 'disponibles' }}
                                    </p>
                                @endif

                                {{-- Precio + subtotal + CTA --}}
                                <div class="flex items-end justify-between pt-4 border-t border-neutral-100 gap-4">
                                    <div>
                                        <div class="text-xl font-semibold text-neutral-900">
                                            ${{ number_format($room->price_per_night, 0, ',', '.') }}
                                            <span class="text-xs font-normal text-neutral-400">/ noche</span>
                                        </div>
                                        <div class="text-sm text-navy-700 font-semibold mt-0.5">
                                            Total {{ $nights }} {{ $nights === 1 ? 'noche' : 'noches' }}:
                                            ${{ number_format($room->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    @if($room->selectable)
                                        <a
                                            href="/pago?room={{ $room->slug }}&check_in={{ $checkIn }}&check_out={{ $checkOut }}&guests={{ $guests }}"
                                            class="btn-primary text-sm py-2.5 px-5 shrink-0"
                                        >
                                            Seleccionar
                                            <i class="ti ti-arrow-right text-sm"></i>
                                        </a>
                                    @else
                                        <span class="text-xs text-neutral-400 italic shrink-0">No disponible</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
