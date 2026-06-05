@props(['images', 'alt' => ''])

@php
$imageUrls = $images->map(fn($img) => '/' . $img->path)->values();
$count     = $imageUrls->count();
@endphp

@if($count === 0)
    <div class="w-full h-full bg-neutral-100 flex items-center justify-center">
        <i class="ti ti-photo text-3xl text-neutral-300"></i>
    </div>

@elseif($count === 1)
    <img
        src="{{ $imageUrls->first() }}"
        alt="{{ $alt }}"
        class="w-full h-full object-cover"
        loading="lazy"
    >

@else
    <div
        x-data="{
            current: 0,
            paused: false,
            images: {{ $imageUrls->toJson() }},
            next() { this.current = (this.current + 1) % this.images.length; },
            prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; },
            init() { setInterval(() => { if (!this.paused) this.next(); }, 4000); }
        }"
        @mouseenter="paused = true"
        @mouseleave="paused = false"
        class="group/carousel relative w-full h-full"
    >
        {{-- Imágenes con fade --}}
        <template x-for="(src, i) in images" :key="i">
            <img
                :src="src"
                alt="{{ $alt }}"
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                :class="i === current ? 'opacity-100' : 'opacity-0'"
                loading="lazy"
            >
        </template>

        {{-- Flecha anterior --}}
        <button
            @click.prevent="prev()"
            aria-label="Foto anterior"
            class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-8 h-8 rounded-full bg-black/40 hover:bg-black/65 flex items-center justify-center text-white transition-opacity duration-200
                   opacity-100 sm:opacity-0 sm:group-hover/carousel:opacity-100"
        >
            <i class="ti ti-chevron-left text-sm"></i>
        </button>

        {{-- Flecha siguiente --}}
        <button
            @click.prevent="next()"
            aria-label="Foto siguiente"
            class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-8 h-8 rounded-full bg-black/40 hover:bg-black/65 flex items-center justify-center text-white transition-opacity duration-200
                   opacity-100 sm:opacity-0 sm:group-hover/carousel:opacity-100"
        >
            <i class="ti ti-chevron-right text-sm"></i>
        </button>

        {{-- Dots de posición --}}
        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 z-10 flex gap-1.5">
            <template x-for="(_, i) in images" :key="i">
                <button
                    @click.prevent="current = i"
                    class="w-1.5 h-1.5 rounded-full transition-colors duration-300"
                    :class="i === current ? 'bg-white' : 'bg-white/40'"
                ></button>
            </template>
        </div>
    </div>
@endif
