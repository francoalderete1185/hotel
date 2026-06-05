<x-layouts.admin title="Reservas">

    <div class="flex items-center justify-between mb-6">
        <h1 class="font-serif text-2xl text-neutral-900 font-medium">Reservas</h1>
        <span class="text-sm text-neutral-400">{{ $counts['all'] }} en total</span>
    </div>

    {{-- Tabs de estado --}}
    <div class="flex gap-1 mb-6 border-b border-neutral-200">
        @foreach([
            ['all',       'Todas',      $counts['all']],
            ['pending',   'Pendientes', $counts['pending']],
            ['confirmed', 'Confirmadas',$counts['confirmed']],
            ['cancelled', 'Canceladas', $counts['cancelled']],
        ] as [$val, $label, $count])
            <a
                href="{{ route('admin.reservas', ['status' => $val]) }}"
                class="px-4 py-2.5 text-sm font-medium border-b-2 -mb-px transition-colors
                    {{ $status === $val
                        ? 'border-navy-700 text-navy-700'
                        : 'border-transparent text-neutral-500 hover:text-neutral-800' }}"
            >
                {{ $label }}
                <span class="ml-1 text-xs {{ $status === $val ? 'text-navy-500' : 'text-neutral-400' }}">
                    {{ $count }}
                </span>
            </a>
        @endforeach
    </div>

    @if($reservations->isEmpty())
        <div class="bg-white border border-neutral-100 rounded-sm py-16 text-center">
            <i class="ti ti-calendar-off text-3xl text-neutral-300 mb-3 block"></i>
            <p class="text-neutral-400 text-sm">No hay reservas
                {{ $status !== 'all' ? 'con ese estado' : 'registradas aún' }}.
            </p>
        </div>
    @else
        <div class="bg-white border border-neutral-100 rounded-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-neutral-100 bg-neutral-50 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Huésped</th>
                            <th class="px-4 py-3">Habitación</th>
                            <th class="px-4 py-3">Check-in</th>
                            <th class="px-4 py-3">Check-out</th>
                            <th class="px-4 py-3 text-right">Noches</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Creada</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-50">
                        @foreach($reservations as $reservation)
                            <tr class="hover:bg-neutral-50 transition-colors">
                                <td class="px-4 py-3 font-mono text-xs font-semibold text-neutral-700">
                                    {{ $reservation->code }}
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-neutral-900">{{ $reservation->guest_name }}</p>
                                    <p class="text-xs text-neutral-400">{{ $reservation->guest_email }}</p>
                                </td>
                                <td class="px-4 py-3 text-neutral-600">
                                    {{ $reservation->room->name }}
                                </td>
                                <td class="px-4 py-3 text-neutral-600 whitespace-nowrap">
                                    {{ $reservation->check_in->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-neutral-600 whitespace-nowrap">
                                    {{ $reservation->check_out->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-right text-neutral-600">
                                    {{ $reservation->nights() }}
                                </td>
                                <td class="px-4 py-3 text-right font-semibold text-neutral-900 whitespace-nowrap">
                                    ${{ number_format($reservation->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('admin.reservas.status', $reservation) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <select
                                            name="status"
                                            onchange="this.form.submit()"
                                            class="text-xs border rounded-sm px-2 py-1 focus:outline-none focus:ring-1 focus:ring-navy-500 cursor-pointer
                                                {{ $reservation->status === 'confirmed' ? 'bg-green-50 border-green-200 text-green-700' : '' }}
                                                {{ $reservation->status === 'pending'   ? 'bg-yellow-50 border-yellow-200 text-yellow-700' : '' }}
                                                {{ $reservation->status === 'cancelled' ? 'bg-neutral-100 border-neutral-200 text-neutral-500' : '' }}"
                                        >
                                            <option value="pending"   {{ $reservation->status === 'pending'   ? 'selected' : '' }}>Pendiente</option>
                                            <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                                            <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-xs text-neutral-400 whitespace-nowrap">
                                    {{ $reservation->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</x-layouts.admin>
