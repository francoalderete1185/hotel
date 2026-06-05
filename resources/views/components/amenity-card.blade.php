@props(['amenity'])

<div class="flex items-start gap-4 p-5 bg-white border border-neutral-100 rounded-sm hover:border-navy-200 hover:shadow-sm transition-all duration-200">
    <div class="shrink-0 w-11 h-11 bg-cream-50 rounded-sm flex items-center justify-center">
        <i class="ti {{ $amenity->icon }} text-xl text-navy-500"></i>
    </div>
    <div>
        <h3 class="font-semibold text-neutral-900 text-sm mb-1">{{ $amenity->title }}</h3>
        <p class="text-neutral-500 text-sm leading-relaxed">{{ $amenity->description }}</p>
    </div>
</div>
