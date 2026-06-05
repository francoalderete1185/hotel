@props(['room'])

<article class="group bg-white border border-neutral-100 rounded-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
    {{-- Imágenes --}}
    <div class="relative overflow-hidden aspect-[4/3]">
        <x-room-carousel :images="$room->images" :alt="$room->name" />
        <div class="absolute top-3 right-3 z-10 bg-white/90 backdrop-blur-sm rounded-sm px-3 py-1.5 text-xs font-semibold text-neutral-700">
            {{ $room->capacity }} {{ $room->capacity === 1 ? 'persona' : 'personas' }}
        </div>
    </div>

    {{-- Contenido --}}
    <div class="p-5 lg:p-6">
        <div class="flex items-start justify-between gap-3 mb-2">
            <h3 class="font-serif text-xl text-neutral-900 font-medium">{{ $room->name }}</h3>
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
                    <li class="text-xs text-neutral-400 px-2.5 py-1">+{{ count($room->features) - 4 }} más</li>
                @endif
            </ul>
        @endif

        {{-- Precio y CTA --}}
        <div class="flex items-center justify-between pt-4 border-t border-neutral-100">
            <div>
                <span class="text-2xl font-semibold text-neutral-900">
                    ${{ number_format($room->price_per_night, 0, ',', '.') }}
                </span>
                <span class="text-xs text-neutral-400 ml-1">/ noche</span>
                <div class="text-xs text-navy-500 flex items-center gap-1 mt-1">
                    <i class="ti ti-coffee text-xs"></i>
                    Desayuno incluido
                </div>
            </div>
            <a
                href="/reservar?room={{ $room->slug }}"
                class="btn-outline text-sm py-2 px-4"
            >
                Reservar
            </a>
        </div>
    </div>
</article>
