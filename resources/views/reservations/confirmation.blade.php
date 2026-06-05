<x-layouts.app title="Reserva generada — Hotel Parlamento">

    @php
        $waNumber = \App\Models\Setting::get('whatsapp_number', '');
        $total    = '$' . number_format($reservation->total_amount, 0, ',', '.');
        $waText   = urlencode(
            "Hola! Acabo de generar la reserva *{$reservation->code}* en Hotel Parlamento.\n\n" .
            "📋 *Detalles*\n" .
            "- Habitación: {$reservation->room->name}\n" .
            "- Check-in: {$reservation->check_in->format('d/m/Y')}\n" .
            "- Check-out: {$reservation->check_out->format('d/m/Y')}\n" .
            "- Noches: {$reservation->nights()}\n" .
            "- Huéspedes: {$reservation->guests_count}\n" .
            "- Total: {$total}\n\n" .
            "👤 *Mis datos*\n" .
            "- Nombre: {$reservation->guest_name}\n" .
            "- Email: {$reservation->guest_email}\n" .
            "- Teléfono: {$reservation->guest_phone}\n\n" .
            "Quería coordinar el pago. ¡Gracias!"
        );
        $waLink = $waNumber ? "https://wa.me/{$waNumber}?text={$waText}" : '';
    @endphp

    <div class="bg-white border-b border-neutral-100 pt-16 lg:pt-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <x-checkout-stepper :current="4" />
        </div>
    </div>

    <section class="bg-neutral-50 min-h-screen py-12 lg:py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">

            {{-- Header --}}
            <div class="text-center mb-8">
                <p class="section-label mb-3">RESERVA GENERADA</p>
                <h1 class="font-serif text-3xl text-neutral-900 font-medium mb-2">Tu reserva está generada</h1>
                <p class="text-sm text-neutral-500">Para confirmarla, coordiná el pago con el hotel por WhatsApp.</p>
            </div>

            {{-- Código --}}
            <div class="bg-white border border-neutral-100 rounded-sm p-6 mb-4 text-center">
                <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-2">Código de reserva</p>
                <p class="font-mono text-3xl font-bold text-neutral-900 tracking-widest">{{ $reservation->code }}</p>
            </div>

            {{-- Bloque de pago --}}
            <div class="bg-white border border-neutral-100 rounded-sm p-6 mb-4 space-y-4">
                <p class="text-sm text-neutral-600 leading-relaxed">
                    Para finalizar tu reserva, coordiná el pago directamente con el hotel por WhatsApp. Hacé click abajo y te abrimos un chat con toda la info de tu reserva ya cargada.
                </p>
                @if($waLink)
                    <a
                        href="{{ $waLink }}"
                        target="_blank"
                        rel="noopener"
                        class="flex items-center justify-center gap-2 w-full bg-navy-700 hover:bg-navy-900 text-white font-semibold py-4 rounded-sm text-sm transition-colors"
                    >
                        <i class="ti ti-brand-whatsapp text-lg"></i>
                        Coordinar pago por WhatsApp
                    </a>
                @else
                    <div class="bg-neutral-50 border border-neutral-200 rounded-sm px-4 py-3 text-sm text-neutral-500">
                        El hotel todavía no configuró el WhatsApp. Contactanos por email para coordinar:
                        <a href="mailto:reservas@hotelparlamento.com.ar" class="text-navy-700 underline hover:text-navy-900">
                            reservas@hotelparlamento.com.ar
                        </a>
                    </div>
                @endif
            </div>

            {{-- Detalle de la reserva --}}
            <div class="bg-white border border-neutral-100 rounded-sm overflow-hidden mb-4">

                <div class="flex gap-4 p-5 border-b border-neutral-100">
                    @if($reservation->room->image_url)
                        <img
                            src="{{ $reservation->room->image_url }}"
                            alt="{{ $reservation->room->name }}"
                            class="w-20 h-20 object-cover rounded-sm shrink-0"
                        >
                    @endif
                    <div>
                        <p class="font-serif text-lg text-neutral-900 font-medium">{{ $reservation->room->name }}</p>
                        <p class="text-sm text-neutral-500 mt-0.5">{{ $reservation->room->short_description }}</p>
                    </div>
                </div>

                <div class="p-5 space-y-2.5 text-sm">
                    <div class="flex justify-between text-neutral-600">
                        <span class="flex items-center gap-1.5">
                            <i class="ti ti-calendar-event text-navy-500"></i> Check-in
                        </span>
                        <span class="font-medium">{{ $reservation->check_in->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between text-neutral-600">
                        <span class="flex items-center gap-1.5">
                            <i class="ti ti-calendar-check text-navy-500"></i> Check-out
                        </span>
                        <span class="font-medium">{{ $reservation->check_out->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between text-neutral-600">
                        <span class="flex items-center gap-1.5">
                            <i class="ti ti-moon text-navy-500"></i> Noches
                        </span>
                        <span class="font-medium">{{ $reservation->nights() }}</span>
                    </div>
                    <div class="flex justify-between text-neutral-600">
                        <span class="flex items-center gap-1.5">
                            <i class="ti ti-users text-navy-500"></i> Huéspedes
                        </span>
                        <span class="font-medium">{{ $reservation->guests_count }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-neutral-900 text-base pt-2.5 border-t border-neutral-100">
                        <span>Total</span>
                        <span>${{ number_format($reservation->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Qué sigue --}}
            <div class="bg-cream-50 border border-cream-200 rounded-sm p-5 mb-8 text-sm">
                <p class="font-semibold text-neutral-800 flex items-center gap-2 mb-3">
                    <i class="ti ti-info-circle text-navy-500"></i> ¿Qué sigue?
                </p>
                <ul class="text-neutral-600 space-y-2">
                    <li class="flex gap-2">
                        <span class="text-navy-500 shrink-0">•</span>
                        Coordiná el pago por WhatsApp con el hotel. Una vez confirmado, te enviamos los detalles finales por email.
                    </li>
                    <li class="flex gap-2">
                        <span class="text-navy-500 shrink-0">•</span>
                        Tu reserva queda guardada como pendiente. Para cancelar o modificar, contactanos con al menos 48 hs de anticipación.
                    </li>
                </ul>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="btn-outline">
                    <i class="ti ti-home"></i>
                    Volver al inicio
                </a>
            </div>

        </div>
    </section>

</x-layouts.app>
