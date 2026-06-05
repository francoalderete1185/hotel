@props(['testimonial'])

<blockquote class="bg-white border border-neutral-100 rounded-sm p-6 flex flex-col gap-4">
    {{-- Estrellas --}}
    <div class="flex gap-0.5">
        @for ($i = 1; $i <= 5; $i++)
            <i class="ti ti-star-filled text-sm {{ $i <= $testimonial->rating ? 'text-bordeaux-500' : 'text-neutral-200' }}"></i>
        @endfor
    </div>

    {{-- Texto --}}
    <p class="text-neutral-600 text-sm leading-relaxed flex-1">
        "{{ $testimonial->content }}"
    </p>

    {{-- Autor --}}
    <footer class="flex items-center gap-3 pt-2 border-t border-neutral-50">
        <div class="w-9 h-9 bg-navy-100 rounded-full flex items-center justify-center shrink-0">
            <span class="text-navy-700 font-semibold text-sm">
                {{ mb_strtoupper(mb_substr($testimonial->author_name, 0, 1)) }}
            </span>
        </div>
        <div>
            <p class="font-semibold text-neutral-800 text-sm">{{ $testimonial->author_name }}</p>
            <p class="text-neutral-400 text-xs">{{ $testimonial->author_location }}</p>
        </div>
    </footer>
</blockquote>
