<x-layouts.admin :title="$room->name">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.habitaciones') }}" class="text-neutral-400 hover:text-neutral-600 transition-colors">
            <i class="ti ti-arrow-left text-xl"></i>
        </a>
        <h1 class="font-serif text-2xl text-neutral-900 font-medium">{{ $room->name }}</h1>
        <span class="text-xs text-neutral-400 bg-neutral-100 px-2 py-1 rounded-sm">{{ $room->slug }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        {{-- ── Columna izquierda: datos ──────────────────── --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-neutral-100 rounded-sm p-6">
                <h2 class="font-semibold text-neutral-900 mb-5 text-sm uppercase tracking-wider">Datos de la habitación</h2>

                <form action="{{ route('admin.habitaciones.update', $room) }}" method="POST" class="space-y-5">
                    @csrf @method('PATCH')

                    @if(session('success'))
                        <p class="text-green-700 bg-green-50 border border-green-200 rounded-sm px-3 py-2 text-xs">{{ session('success') }}</p>
                    @endif

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Nombre</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $room->name) }}"
                            maxlength="100"
                            class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                        >
                        @error('name')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Precio por noche ($)</label>
                        <input
                            type="number"
                            name="price_per_night"
                            value="{{ old('price_per_night', (int) $room->price_per_night) }}"
                            step="1"
                            min="0"
                            class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                        >
                        @error('price_per_night')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Descripción corta</label>
                        <textarea
                            name="short_description"
                            rows="2"
                            maxlength="200"
                            class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 resize-none"
                        >{{ old('short_description', $room->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Descripción completa</label>
                        <textarea
                            name="description"
                            rows="5"
                            maxlength="1000"
                            class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 resize-none"
                        >{{ old('description', $room->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Capacidad</label>
                            <input
                                type="number"
                                name="capacity"
                                value="{{ old('capacity', $room->capacity) }}"
                                min="1"
                                max="10"
                                class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                            >
                            @error('capacity')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Tamaño m²</label>
                            <input
                                type="number"
                                name="size_m2"
                                value="{{ old('size_m2', $room->size_m2) }}"
                                min="1"
                                class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                            >
                            @error('size_m2')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Unidades</label>
                            <input
                                type="number"
                                name="total_units"
                                value="{{ old('total_units', $room->total_units) }}"
                                min="1"
                                max="50"
                                class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                            >
                            @error('total_units')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                            Amenidades <span class="normal-case font-normal text-neutral-400">(una por línea)</span>
                        </label>
                        <textarea
                            name="features_text"
                            rows="6"
                            placeholder="WiFi gratis&#10;Aire acondicionado&#10;Desayuno continental"
                            class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 resize-none font-mono"
                        >{{ old('features_text', implode("\n", $room->features ?? [])) }}</textarea>
                        @error('features')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-navy-700 hover:bg-navy-900 text-white font-semibold py-2.5 rounded-sm text-sm transition-colors">
                        Guardar cambios
                    </button>
                </form>
            </div>
        </div>

        {{-- ── Columna derecha: fotos ─────────────────────── --}}
        <div class="lg:col-span-3 space-y-6">

            {{-- Upload --}}
            <div class="bg-white border border-neutral-100 rounded-sm p-6">
                <h2 class="font-semibold text-neutral-900 mb-4 text-sm uppercase tracking-wider">Subir fotos</h2>

                <form
                    action="{{ route('admin.habitaciones.fotos.upload', $room) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    x-data="{ count: 0 }"
                    class="space-y-4"
                >
                    @csrf

                    <label class="flex flex-col items-center gap-2 border-2 border-dashed border-neutral-200 hover:border-navy-300 rounded-sm p-6 cursor-pointer transition-colors">
                        <i class="ti ti-cloud-upload text-3xl text-neutral-300"></i>
                        <span class="text-sm text-neutral-500" x-text="count > 0 ? count + ' archivo(s) seleccionado(s)' : 'Clic para seleccionar fotos'"></span>
                        <span class="text-xs text-neutral-400">JPG, PNG, WEBP · máx. 4 MB por foto</span>
                        <input
                            type="file"
                            name="fotos[]"
                            accept="image/jpeg,image/jpg,image/png,image/webp"
                            multiple
                            class="hidden"
                            @change="count = $event.target.files.length"
                        >
                    </label>

                    @error('fotos')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    @error('fotos.*')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        x-bind:disabled="count === 0"
                        class="w-full bg-navy-700 hover:bg-navy-900 disabled:opacity-40 disabled:cursor-not-allowed text-white font-semibold py-2.5 rounded-sm text-sm transition-colors"
                    >
                        Subir fotos
                    </button>
                </form>
            </div>

            {{-- Grid de fotos --}}
            <div class="bg-white border border-neutral-100 rounded-sm p-6">
                <h2 class="font-semibold text-neutral-900 mb-4 text-sm uppercase tracking-wider">
                    Fotos actuales
                    <span class="font-normal text-neutral-400 normal-case">({{ $room->images->count() }})</span>
                </h2>

                @if($room->images->isEmpty())
                    <p class="text-sm text-neutral-400 text-center py-8">No hay fotos cargadas aún.</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($room->images as $i => $image)
                            <div class="space-y-2">
                                {{-- Thumbnail --}}
                                <div class="relative aspect-[4/3] rounded-sm overflow-hidden bg-neutral-100">
                                    <img
                                        src="{{ '/' . $image->path }}"
                                        alt="Foto {{ $i + 1 }}"
                                        class="w-full h-full object-cover"
                                    >
                                    @if($image->is_primary)
                                        <span class="absolute top-1.5 left-1.5 bg-navy-700 text-white text-xs px-2 py-0.5 rounded-sm font-semibold">
                                            Principal
                                        </span>
                                    @endif
                                </div>

                                {{-- Controles --}}
                                <div class="flex items-center gap-1 flex-wrap">
                                    {{-- Reorder --}}
                                    @if($i > 0)
                                        <form action="{{ route('admin.fotos.order', $image) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="direction" value="up">
                                            <button type="submit" title="Subir" class="w-7 h-7 flex items-center justify-center border border-neutral-200 rounded-sm hover:bg-neutral-50 text-neutral-500 transition-colors">
                                                <i class="ti ti-chevron-up text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($i < $room->images->count() - 1)
                                        <form action="{{ route('admin.fotos.order', $image) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="direction" value="down">
                                            <button type="submit" title="Bajar" class="w-7 h-7 flex items-center justify-center border border-neutral-200 rounded-sm hover:bg-neutral-50 text-neutral-500 transition-colors">
                                                <i class="ti ti-chevron-down text-xs"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Marcar principal --}}
                                    @if(! $image->is_primary)
                                        <form action="{{ route('admin.fotos.primary', $image) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" title="Marcar como principal" class="w-7 h-7 flex items-center justify-center border border-neutral-200 rounded-sm hover:bg-navy-50 hover:border-navy-300 text-neutral-400 hover:text-navy-600 transition-colors">
                                                <i class="ti ti-star text-xs"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="w-7 h-7 flex items-center justify-center text-navy-500">
                                            <i class="ti ti-star-filled text-xs"></i>
                                        </span>
                                    @endif

                                    {{-- Eliminar con confirmación Alpine --}}
                                    <div x-data="{ confirming: false }" class="ml-auto">
                                        <button
                                            x-show="!confirming"
                                            @click="confirming = true"
                                            title="Eliminar"
                                            class="w-7 h-7 flex items-center justify-center border border-neutral-200 rounded-sm hover:bg-red-50 hover:border-red-200 text-neutral-400 hover:text-red-500 transition-colors"
                                        >
                                            <i class="ti ti-trash text-xs"></i>
                                        </button>
                                        <div x-show="confirming" class="flex items-center gap-1">
                                            <form action="{{ route('admin.fotos.delete', $image) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-xs text-red-600 font-semibold hover:text-red-800 px-1">
                                                    Sí
                                                </button>
                                            </form>
                                            <button @click="confirming = false" class="text-xs text-neutral-400 hover:text-neutral-600 px-1">
                                                No
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layouts.admin>
