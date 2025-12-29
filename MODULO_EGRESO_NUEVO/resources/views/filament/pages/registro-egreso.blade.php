<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">
                Solicitud de pago aprobada
            </x-slot>

            @php
                $motivoSolicitud = $this->solicitud?->motivo ?? 'N/D';
                $aprobadoPor = $this->solicitud?->aprobador?->name ?? 'N/D';
                $fechaAprobacion = optional($this->solicitud?->aprobada_at ?? now())->format('Y-m-d');
                $montoAprobado = $this->solicitud?->monto_aprobado ?? 0;
            @endphp

            <div class="flex flex-wrap gap-4">
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4 min-w-[220px]">
                    <div class="text-xs font-semibold uppercase tracking-wide text-amber-800">Motivo</div>
                    <div class="mt-1 text-sm font-extrabold text-amber-900">{{ $motivoSolicitud }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4 min-w-[220px]">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-600">Aprobado por</div>
                    <div class="mt-1 text-sm font-extrabold text-slate-900">{{ $aprobadoPor }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4 min-w-[220px]">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-600">Fecha aprobación</div>
                    <div class="mt-1 text-sm font-extrabold text-slate-900">{{ $fechaAprobacion }}</div>
                </div>
                <div class="rounded-xl border border-emerald-100 bg-emerald-50 p-4 min-w-[220px]">
                    <div class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Monto aprobado</div>
                    <div class="mt-1 text-lg font-extrabold text-emerald-900">
                        ${{ number_format((float) $montoAprobado, 2, '.', ',') }}
                    </div>
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Facturas agrupadas por proveedor
            </x-slot>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left font-semibold text-gray-700">Proveedor</th>
                                <th class="px-4 py-2 text-left font-semibold text-gray-700">RUC</th>
                                <th class="px-4 py-2 text-right font-semibold text-gray-700">Total facturas</th>
                                <th class="px-4 py-2 text-right font-semibold text-gray-700">Abono aprobado</th>
                                <th class="px-4 py-2 text-center font-semibold text-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($this->proveedores as $proveedor)
                                @php
                                    $isOpen = $this->openProviders[$proveedor['key']] ?? false;
                                @endphp
                                <tr class="align-top">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-800">
                                            {{ $proveedor['proveedor_nombre'] ?? $proveedor['proveedor_codigo'] }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Código: {{ $proveedor['proveedor_codigo'] ?? 'N/D' }}
                                            <span class="ml-2 rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">
                                                {{ $proveedor['facturas_count'] ?? 0 }} factura(s)
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $proveedor['proveedor_ruc'] ?? 'N/D' }}
                                    </td>
                                    <td class="px-4 py-3 text-right text-gray-700">
                                        ${{ number_format((float) ($proveedor['total_facturas'] ?? 0), 2, '.', ',') }}
                                    </td>
                                    <td class="px-4 py-3 text-right text-gray-700">
                                        ${{ number_format((float) ($proveedor['total_abono'] ?? 0), 2, '.', ',') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col gap-2 sm:flex-row sm:justify-center">
                                            <x-filament::button
                                                size="sm"
                                                color="gray"
                                                wire:click="toggleProvider('{{ $proveedor['key'] }}')"
                                            >
                                                {{ $isOpen ? 'Ocultar facturas' : 'Ver facturas' }}
                                            </x-filament::button>
                                            <x-filament::button
                                                size="sm"
                                                color="primary"
                                                wire:click="openGeneracionModal('{{ $proveedor['key'] }}')"
                                            >
                                                Generar Directorio y Diario
                                            </x-filament::button>
                                        </div>
                                    </td>
                                </tr>
                                @if ($isOpen)
                                    <tr class="bg-gray-50">
                                        <td colspan="5" class="px-4 py-4">
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full divide-y divide-gray-200 text-xs">
                                                    <thead>
                                                        <tr class="text-left text-gray-500">
                                                            <th class="px-3 py-2">Factura</th>
                                                            <th class="px-3 py-2">Emisión</th>
                                                            <th class="px-3 py-2">Vencimiento</th>
                                                            <th class="px-3 py-2 text-right">Monto</th>
                                                            <th class="px-3 py-2 text-right">Abono</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-100 text-gray-700">
                                                        @foreach ($proveedor['empresas'] ?? [] as $empresa)
                                                            @foreach ($empresa['sucursales'] ?? [] as $sucursal)
                                                                @foreach ($sucursal['facturas'] ?? [] as $factura)
                                                                    <tr>
                                                                        <td class="px-3 py-2">{{ $factura['numero'] ?? 'N/D' }}</td>
                                                                        <td class="px-3 py-2">
                                                                            {{ ! empty($factura['fecha_emision']) ? \Illuminate\Support\Carbon::parse($factura['fecha_emision'])->format('Y-m-d') : 'N/D' }}
                                                                        </td>
                                                                        <td class="px-3 py-2">
                                                                            {{ ! empty($factura['fecha_vencimiento']) ? \Illuminate\Support\Carbon::parse($factura['fecha_vencimiento'])->format('Y-m-d') : 'N/D' }}
                                                                        </td>
                                                                        <td class="px-3 py-2 text-right">
                                                                            ${{ number_format((float) ($factura['monto'] ?? 0), 2, '.', ',') }}
                                                                        </td>
                                                                        <td class="px-3 py-2 text-right">
                                                                            ${{ number_format((float) ($factura['abono'] ?? 0), 2, '.', ',') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        No hay facturas disponibles para esta solicitud.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </x-filament::section>
    </div>

    <x-filament::modal
        width="7xl"
        wire:model.defer="showGeneracionModal"
        heading="Generar Directorio y Diario"
    >
        <div class="space-y-6">
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700">
                <div class="font-semibold">Proveedor seleccionado:</div>
                <div>
                    {{ $this->activeProviderContext['proveedor_nombre'] ?? 'N/D' }}
                    @if (!empty($this->activeProviderContext['proveedor_ruc']))
                        · RUC: {{ $this->activeProviderContext['proveedor_ruc'] }}
                    @endif
                </div>
            </div>

            {{ $this->form }}

            <div class="flex flex-wrap justify-end gap-2">
                @if (! $this->pagoTabEnabled)
                    <x-filament::button color="primary" wire:click="habilitarPago">
                        Siguiente
                    </x-filament::button>
                @else
                    <x-filament::button color="primary" wire:click="generarDirectorioDiario">
                        Generar
                    </x-filament::button>
                @endif
                <x-filament::button color="gray" wire:click="closeGeneracionModal">
                    Cerrar
                </x-filament::button>
            </div>
        </div>
    </x-filament::modal>
</x-filament-panels::page>
