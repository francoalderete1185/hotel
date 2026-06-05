@props(['current' => 2])

@php
$steps = [
    1 => ['label' => 'Búsqueda',     'icon' => 'ti-search'],
    2 => ['label' => 'Habitación',   'icon' => 'ti-bed'],
    3 => ['label' => 'Pago',         'icon' => 'ti-credit-card'],
    4 => ['label' => 'Confirmación', 'icon' => 'ti-check'],
];
@endphp

<nav aria-label="Progreso de reserva" class="flex items-center justify-center gap-0">
    @foreach($steps as $num => $step)
        @php
            $done    = $num < $current;
            $active  = $num === $current;
            $pending = $num > $current;
        @endphp

        {{-- Step --}}
        <div class="flex items-center">
            <div class="flex flex-col items-center gap-1.5">
                <div @class([
                    'w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold transition-colors',
                    'bg-navy-700 text-white'                          => $done,
                    'bg-navy-700 text-white ring-4 ring-navy-100'     => $active,
                    'bg-neutral-100 text-neutral-400'                 => $pending,
                ])>
                    @if($done)
                        <i class="ti ti-check text-base"></i>
                    @else
                        <i class="ti {{ $step['icon'] }} text-base"></i>
                    @endif
                </div>
                <span @class([
                    'text-xs font-medium hidden sm:block',
                    'text-navy-700'      => $done || $active,
                    'text-neutral-400'   => $pending,
                ])>{{ $step['label'] }}</span>
            </div>

            {{-- Connector (not after last step) --}}
            @if($num < count($steps))
                <div @class([
                    'h-px w-12 sm:w-20 mx-2 mb-5',
                    'bg-navy-500'       => $done,
                    'bg-neutral-200'    => !$done,
                ])></div>
            @endif
        </div>
    @endforeach
</nav>
