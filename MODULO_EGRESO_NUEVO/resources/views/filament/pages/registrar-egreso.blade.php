<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">
                Solicitud de pago aprobada
            </x-slot>

            @php
                $motivo = $this->solicitud?->motivo ?? 'N/D';
                $fecha = optional($this->solicitud?->created_at)->format('Y-m-d');
                $monto = $this->solicitud?->monto_aprobado ?? 0;
                $creador = $this->solicitud?->creador?->name ?? 'N/D';
            @endphp

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">
                    <div class="text-[11px] font-semibold uppercase tracking-wide text-amber-800">Solicitante</div>
                    <div class="mt-1 text-sm font-extrabold text-amber-900">{{ $creador }}</div>
                </div>
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">
                    <div class="text-[11px] font-semibold uppercase tracking-wide text-amber-800">Fecha</div>
                    <div class="mt-1 text-sm font-extrabold text-amber-900">{{ $fecha }}</div>
                </div>
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">
                    <div class="text-[11px] font-semibold uppercase tracking-wide text-amber-800">Motivo</div>
                    <div class="mt-1 text-sm font-extrabold text-amber-900">{{ $motivo }}</div>
                </div>
                <div class="rounded-xl border border-emerald-100 bg-emerald-50 p-4">
                    <div class="text-[11px] font-semibold uppercase tracking-wide text-emerald-800">Monto aprobado</div>
                    <div class="mt-1 text-lg font-extrabold text-emerald-900">
                        ${{ number_format((float) $monto, 2, '.', ',') }}
                    </div>
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Facturas por proveedor
            </x-slot>

            <div class="space-y-4">
                @forelse ($providers as $provider)
                    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <div class="text-base font-semibold text-gray-800">
                                    {{ $provider['proveedor_nombre'] ?? $provider['proveedor_codigo'] ?? 'Proveedor' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    Código: {{ $provider['proveedor_codigo'] ?? 'N/D' }}
                                    @if (!empty($provider['proveedor_ruc']))
                                        · RUC: {{ $provider['proveedor_ruc'] }}
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col gap-1 text-right text-sm text-gray-600">
                                <span>Total facturas: <strong>${{ number_format((float) $provider['total_facturas'], 2, '.', ',') }}</strong></span>
                                <span>Abono aplicado: <strong>${{ number_format((float) $provider['total_abono'], 2, '.', ',') }}</strong></span>
                                <x-filament::button
                                    type="button"
                                    color="primary"
                                    icon="heroicon-o-document-check"
                                    wire:click="mountAction('generarDirectorio', @js(['provider_key' => $provider['key']]))"
                                >
                                    Generar Directorio y Diario
                                </x-filament::button>
                            </div>
                        </div>

                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Factura</th>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Emisión</th>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Vencimiento</th>
                                        <th class="px-4 py-2 text-right font-semibold text-gray-700">Monto</th>
                                        <th class="px-4 py-2 text-right font-semibold text-gray-700">Abono</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach ($provider['facturas'] as $factura)
                                        <tr>
                                            <td class="px-4 py-2 text-gray-700">{{ $factura['numero_factura'] ?? 'N/D' }}</td>
                                            <td class="px-4 py-2 text-gray-500">{{ $factura['fecha_emision'] ?? 'N/D' }}</td>
                                            <td class="px-4 py-2 text-gray-500">{{ $factura['fecha_vencimiento'] ?? 'N/D' }}</td>
                                            <td class="px-4 py-2 text-right text-gray-700">
                                                ${{ number_format((float) $factura['monto_factura'], 2, '.', ',') }}
                                            </td>
                                            <td class="px-4 py-2 text-right text-gray-700">
                                                ${{ number_format((float) $factura['abono_aplicado'], 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6 text-center text-sm text-gray-500">
                        No hay facturas asociadas a esta solicitud.
                    </div>
                @endforelse
            </div>
        </x-filament::section>
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>
