<x-layouts.app
    title="Términos y Condiciones — Hotel Parlamento"
    description="Términos y condiciones de uso y reserva del Hotel Parlamento, Rodríguez Peña 61, CABA, Argentina."
>

    <section class="bg-neutral-50 min-h-screen py-12 lg:py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-10">
                <p class="section-label mb-3">INFORMACIÓN LEGAL</p>
                <h1 class="font-serif text-4xl text-neutral-900 font-medium mb-3">
                    Términos y Condiciones
                </h1>
                <p class="text-sm text-neutral-400">Última actualización: junio de 2025</p>
            </div>

            <div class="space-y-8 text-neutral-700 text-[0.9375rem] leading-relaxed">

                {{-- 1. Política de cancelación (destacada) --}}
                <div class="bg-navy-50 border-l-4 border-navy-500 rounded-sm p-6 lg:p-8">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="ti ti-calendar-x text-navy-500 text-xl"></i>
                        <h2 class="font-serif text-xl text-neutral-900 font-medium">1. Política de Cancelación</h2>
                    </div>

                    <p class="font-semibold text-neutral-900 mb-3">
                        Cancelación sin cargo hasta 24 horas antes de la fecha de check-in.
                        Pasado ese plazo, se cobra el equivalente a la primera noche de estadía.
                    </p>

                    <ul class="space-y-2 text-neutral-700">
                        <li class="flex gap-2">
                            <span class="text-navy-500 shrink-0">•</span>
                            <span>
                                <strong>Con más de 24 horas de anticipación:</strong> el Huésped puede cancelar su
                                reserva sin cargo alguno. En caso de haber abonado un anticipo, se reintegrará el
                                monto total dentro de los 5 (cinco) días hábiles siguientes a la solicitud.
                            </span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-500 shrink-0">•</span>
                            <span>
                                <strong>Con menos de 24 horas de anticipación o no presentación (no-show):</strong>
                                se retendrá o facturará el importe correspondiente a una (1) noche de estadía como
                                penalidad por cancelación tardía.
                            </span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-500 shrink-0">•</span>
                            <span>
                                Las solicitudes de cancelación deben comunicarse por escrito a
                                <a href="mailto:reservas@hotelparlamento.com.ar" class="text-navy-500 hover:text-navy-700 underline">reservas@hotelparlamento.com.ar</a>
                                o por teléfono al +54 11 4371-3789. La hora de recepción del aviso determina si
                                corresponde o no el cargo.
                            </span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-navy-500 shrink-0">•</span>
                            <span>
                                El cómputo del plazo de 24 horas se realiza en función del horario de check-in
                                pactado (15:00 hs, hora de Argentina).
                            </span>
                        </li>
                    </ul>
                </div>

                {{-- 2. Check-in / Check-out --}}
                <div class="bg-white border border-neutral-100 rounded-sm p-6 lg:p-8">
                    <h2 class="font-serif text-xl text-neutral-900 font-medium mb-4">2. Check-in y Check-out</h2>
                    <ul class="space-y-2 list-disc list-inside text-neutral-600">
                        <li><strong>Check-in:</strong> a partir de las 15:00 hs. Presentación de documento de identidad o pasaporte vigente es obligatoria.</li>
                        <li><strong>Check-out:</strong> hasta las 11:00 hs. La demora en la entrega de la habitación puede dar lugar al cobro de una noche adicional.</li>
                        <li>El ingreso anticipado o la salida tardía están sujetos a disponibilidad y pueden tener cargo adicional. Consultá con recepción.</li>
                        <li>La recepción del Hotel opera las 24 horas.</li>
                    </ul>
                </div>

                {{-- 3. Responsabilidades del huésped --}}
                <div class="bg-white border border-neutral-100 rounded-sm p-6 lg:p-8">
                    <h2 class="font-serif text-xl text-neutral-900 font-medium mb-4">3. Responsabilidades del Huésped</h2>
                    <p class="mb-3">El Huésped se compromete a:</p>
                    <ul class="space-y-2 list-disc list-inside text-neutral-600">
                        <li>Respetar el reglamento interno del Hotel y las normas de convivencia.</li>
                        <li>No realizar actividades que generen molestias a otros huéspedes o al personal.</li>
                        <li>Hacerse responsable de los daños que ocasione a las instalaciones, mobiliario o equipamiento del Hotel por uso indebido.</li>
                        <li>No ingresar personas adicionales a la habitación sin previa autorización de la recepción.</li>
                        <li>No fumar en las instalaciones interiores del establecimiento (Ley 3.718, CABA).</li>
                        <li>Hacer entrega de la habitación en las condiciones en que fue recibida.</li>
                    </ul>
                </div>

                {{-- 4. Responsabilidad del hotel --}}
                <div class="bg-white border border-neutral-100 rounded-sm p-6 lg:p-8">
                    <h2 class="font-serif text-xl text-neutral-900 font-medium mb-4">4. Responsabilidad del Hotel</h2>
                    <p>
                        El Hotel se compromete a prestar los servicios contratados en las condiciones pactadas.
                        No obstante, queda eximido de responsabilidad ante:
                    </p>
                    <ul class="mt-3 space-y-2 list-disc list-inside text-neutral-600">
                        <li>Casos fortuitos o de fuerza mayor (cortes de servicios públicos, desastres naturales, disposiciones gubernamentales, etc.).</li>
                        <li>Pérdida, robo o daño de objetos personales no depositados en la caja de seguridad provista en la habitación.</li>
                        <li>Inconvenientes derivados del uso incorrecto de los servicios por parte del Huésped.</li>
                    </ul>
                    <p class="mt-3">
                        En caso de que el Hotel no pueda proveer la habitación reservada por causas imputables al
                        establecimiento, ofrecerá al Huésped una habitación de categoría equivalente o superior en
                        el mismo u otro hotel de características similares, o bien el reintegro íntegro del importe
                        abonado.
                    </p>
                </div>

                {{-- 5. Modificaciones --}}
                <div class="bg-white border border-neutral-100 rounded-sm p-6 lg:p-8">
                    <h2 class="font-serif text-xl text-neutral-900 font-medium mb-4">5. Modificaciones de Reserva</h2>
                    <p>
                        Toda solicitud de modificación de fechas, tipo de habitación o cantidad de huéspedes debe
                        realizarse con al menos 48 horas de anticipación al check-in y está sujeta a disponibilidad.
                        Las modificaciones que impliquen un incremento en el valor de la estadía generarán la
                        correspondiente diferencia de tarifa.
                    </p>
                    <p class="mt-3">
                        El Hotel se reserva el derecho de actualizar los presentes Términos y Condiciones. Las
                        modificaciones entrarán en vigencia desde su publicación en el sitio web oficial.
                        Las reservas ya confirmadas se rigen por las condiciones vigentes al momento de su
                        concreción.
                    </p>
                </div>

                {{-- 6. Ley y jurisdicción --}}
                <div class="bg-white border border-neutral-100 rounded-sm p-6 lg:p-8">
                    <h2 class="font-serif text-xl text-neutral-900 font-medium mb-4">6. Ley Aplicable y Jurisdicción</h2>
                    <p>
                        Los presentes Términos y Condiciones se rigen por las leyes de la República Argentina.
                        Ante cualquier controversia o disputa derivada de la relación entre el Hotel y el Huésped,
                        ambas partes acuerdan someterse a la jurisdicción de los tribunales ordinarios de la
                        Ciudad Autónoma de Buenos Aires, con renuncia expresa a cualquier otro fuero que pudiera
                        corresponderles.
                    </p>
                </div>

                {{-- Contacto --}}
                <div class="bg-cream-50 border border-cream-200 rounded-sm p-6 text-sm">
                    <p class="font-semibold text-neutral-800 mb-2">Consultas</p>
                    <p class="text-neutral-600">
                        Para consultas sobre estos Términos y Condiciones, podés contactarnos en
                        <a href="mailto:reservas@hotelparlamento.com.ar" class="text-navy-500 hover:text-navy-700 underline">reservas@hotelparlamento.com.ar</a>
                        o llamarnos al +54 11 4371-3789.
                    </p>
                </div>

            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('home') }}" class="btn-outline">
                    <i class="ti ti-arrow-left"></i>
                    Volver al inicio
                </a>
            </div>

        </div>
    </section>

</x-layouts.app>
