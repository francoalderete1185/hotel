<x-layouts.admin title="Habitaciones">

    <div class="flex items-center justify-between mb-8">
        <h1 class="font-serif text-2xl text-neutral-900 font-medium">Habitaciones</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach($rooms as $room)
            <a href="{{ route('admin.habitaciones.show', $room) }}"
               class="bg-white border border-neutral-100 rounded-sm hover:shadow-md transition-shadow duration-200 overflow-hidden group">

                {{-- Thumbnail --}}
                <div class="aspect-[16/9] overflow-hidden bg-neutral-100">
                    @if($room->images->isNotEmpty())
                        <img
                            src="{{ $room->primaryImage }}"
                            alt="{{ $room->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="ti ti-photo text-3xl text-neutral-300"></i>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-4">
                    <h2 class="font-semibold text-neutral-900 mb-1">{{ $room->name }}</h2>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-neutral-500">
                            ${{ number_format($room->price_per_night, 0, ',', '.') }}<span class="text-xs"> / noche</span>
                        </span>
                        <span class="text-neutral-400 text-xs">
                            {{ $room->images->count() }} {{ $room->images->count() === 1 ? 'foto' : 'fotos' }}
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

</x-layouts.admin>
