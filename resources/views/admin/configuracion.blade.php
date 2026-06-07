<x-layouts.admin title="Configuración">

    <div class="flex items-center justify-between mb-8">
        <h1 class="font-serif text-2xl text-neutral-900 font-medium">Configuración</h1>
    </div>

    <div class="max-w-xl">
        <div class="bg-white border border-neutral-100 rounded-sm p-6">
            <h2 class="font-semibold text-neutral-900 mb-6 text-sm uppercase tracking-wider">Contacto</h2>

            <form action="{{ route('admin.configuracion.update') }}" method="POST" class="space-y-6">
                @csrf @method('PUT')

                {{-- WhatsApp --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                        Número de WhatsApp para recibir comprobantes
                    </label>
                    <input
                        type="text"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $whatsapp) }}"
                        placeholder="5491176759957"
                        class="w-full border border-neutral-200 rounded-sm px-3 py-2.5 text-sm focus:outline-none focus:border-navy-500 focus:ring-1 focus:ring-navy-500"
                    >
                    @error('whatsapp_number')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-neutral-400 leading-relaxed">
                        Solo dígitos con código de país. Ej: 5491176759957
                    </p>
                </div>

                <button type="submit" class="w-full bg-navy-700 hover:bg-navy-900 text-white font-semibold py-2.5 rounded-sm text-sm transition-colors">
                    Guardar
                </button>
            </form>
        </div>
    </div>

</x-layouts.admin>
