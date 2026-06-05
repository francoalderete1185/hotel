<x-layouts.app title="Datos del huésped — Hotel Parlamento">

    {{-- Top bar --}}
    <div class="bg-white border-b border-neutral-100 pt-16 lg:pt-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <x-checkout-stepper :current="3" />
        </div>
    </div>

    <section class="bg-neutral-50 min-h-screen py-10 lg:py-14">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

                {{-- ── Columna izquierda: resumen ──────────────────── --}}
                <aside class="lg:col-span-2 space-y-4">

                    <div class="bg-white border border-neutral-100 rounded-sm overflow-hidden">
                        <img
                            src="{{ $room->image_url }}"
                            alt="{{ $room->name }}"
                            class="w-full aspect-[4/3] object-cover"
                        >
                        <div class="p-5 space-y-4">
                            <div>
                                <h2 class="font-serif text-xl text-neutral-900 font-medium">{{ $room->name }}</h2>
                                <p class="text-sm text-neutral-500 mt-1">{{ $room->short_description }}</p>
                            </div>

                            <ul class="flex flex-wrap gap-1.5">
                                @foreach(array_slice($room->features, 0, 5) as $feature)
                                    <li class="text-xs bg-neutral-50 border border-neutral-100 text-neutral-600 px-2.5 py-1 rounded-sm">
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="border-t border-neutral-100 pt-4 space-y-2 text-sm">
                                <div class="flex justify-between text-neutral-600">
                                    <span class="flex items-center gap-1.5">
                                        <i class="ti ti-calendar-event text-navy-500"></i>
                                        Check-in
                                    </span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($checkIn)->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex justify-between text-neutral-600">
                                    <span class="flex items-center gap-1.5">
                                        <i class="ti ti-calendar-check text-navy-500"></i>
                                        Check-out
                                    </span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($checkOut)->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex justify-between text-neutral-600">
                                    <span class="flex items-center gap-1.5">
                                        <i class="ti ti-moon text-navy-500"></i>
                                        Noches
                                    </span>
                                    <span class="font-medium">{{ $nights }}</span>
                                </div>
                                <div class="flex justify-between text-neutral-600">
                                    <span class="flex items-center gap-1.5">
                                        <i class="ti ti-users text-navy-500"></i>
                                        Huéspedes
                                    </span>
                                    <span class="font-medium">{{ $guests }}</span>
                                </div>
                            </div>

                            <div class="border-t border-neutral-100 pt-4 space-y-1.5 text-sm">
                                <div class="flex justify-between text-neutral-500">
                                    <span>${{ number_format($room->price_per_night, 0, ',', '.') }} × {{ $nights }} {{ $nights === 1 ? 'noche' : 'noches' }}</span>
                                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-semibold text-neutral-900 text-base pt-1 border-t border-neutral-100">
                                    <span>Total</span>
                                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-xs text-neutral-400 flex items-start gap-2 px-1">
                        <i class="ti ti-shield-check text-navy-500 mt-0.5 shrink-0"></i>
                        Cancelación gratuita hasta 48 hs antes del check-in. Sin cargos ocultos.
                    </div>

                </aside>

                {{-- ── Columna derecha: formulario ─────────────────── --}}
                <div class="lg:col-span-3">
                    <form action="{{ route('reservation.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="room_slug"  value="{{ $room->slug }}">
                        <input type="hidden" name="check_in"   value="{{ $checkIn }}">
                        <input type="hidden" name="check_out"  value="{{ $checkOut }}">
                        <input type="hidden" name="guests"     value="{{ $guests }}">

                        {{-- Datos del huésped --}}
                        <div class="bg-white border border-neutral-100 rounded-sm p-6 space-y-4">
                            <h3 class="font-semibold text-neutral-900 text-base">Datos del huésped</h3>

                            <div class="space-y-1">
                                <label for="guest_name" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                                    Nombre completo
                                </label>
                                <input
                                    type="text"
                                    id="guest_name"
                                    name="guest_name"
                                    value="{{ old('guest_name') }}"
                                    placeholder="Ej: María González"
                                    class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 @error('guest_name') border-red-400 @enderror"
                                >
                                @error('guest_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="guest_email" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                                        Email
                                    </label>
                                    <input
                                        type="email"
                                        id="guest_email"
                                        name="guest_email"
                                        value="{{ old('guest_email') }}"
                                        placeholder="tu@email.com"
                                        class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 @error('guest_email') border-red-400 @enderror"
                                    >
                                    @error('guest_email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="guest_phone" class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                                        Teléfono
                                    </label>
                                    <input
                                        type="tel"
                                        id="guest_phone"
                                        name="guest_phone"
                                        value="{{ old('guest_phone') }}"
                                        placeholder="+54 11 0000-0000"
                                        class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500 @error('guest_phone') border-red-400 @enderror"
                                    >
                                    @error('guest_phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="space-y-3">
                            @if(session('error'))
                                <p class="text-sm text-red-600 flex items-center gap-2">
                                    <i class="ti ti-alert-circle"></i>
                                    {{ session('error') }}
                                </p>
                            @endif

                            <button type="submit" class="btn-primary w-full py-4 text-base justify-center">
                                <i class="ti ti-check text-base"></i>
                                Generar reserva
                            </button>
                            <p class="text-xs text-neutral-400 text-center">
                                Al confirmar generamos tu código de reserva. El pago se realiza por Mercado Pago en el siguiente paso.
                            </p>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>

</x-layouts.app>
