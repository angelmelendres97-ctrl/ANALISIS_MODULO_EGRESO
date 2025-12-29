<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">
                Solicitud de pago #{{ $this->solicitud?->id ?? 'N/D' }}
            </x-slot>

            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-amber-800">
                        Estado
                    </div>
                    <div class="mt-2 text-lg font-bold text-amber-900">
                        {{ $this->solicitud?->estado ?? 'N/D' }}
                    </div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-600">
                        Motivo
                    </div>
                    <div class="mt-2 text-sm font-semibold text-slate-900">
                        {{ $this->solicitud?->motivo ?? 'N/D' }}
                    </div>
                </div>
                <div class="rounded-xl border border-emerald-100 bg-emerald-50 p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-emerald-800">
                        Monto aprobado
                    </div>
                    <div class="mt-2 text-lg font-bold text-emerald-900">
                        ${{ number_format((float) ($this->solicitud?->monto_aprobado ?? 0), 2, '.', ',') }}
                    </div>
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Facturas agrupadas por proveedor
            </x-slot>

            <div class="space-y-4">
                @forelse ($this->proveedores as $proveedor)
                    <div class="rounded-xl border border-gray-200 bg-white p-4">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <div class="text-base font-semibold text-gray-900">
                                    {{ $proveedor['proveedor_nombre'] ?? $proveedor['proveedor_codigo'] }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    Código: {{ $proveedor['proveedor_codigo'] ?? 'N/D' }}
                                    @if (!empty($proveedor['proveedor_ruc']))
                                        · RUC: {{ $proveedor['proveedor_ruc'] }}
                                    @endif
                                    <span
                                        class="ml-2 rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">
                                        {{ $proveedor['facturas_count'] ?? 0 }} factura(s)
                                    </span>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-xs uppercase tracking-wide text-gray-500">Total</div>
                                <div class="text-lg font-bold text-gray-800">
                                    ${{ number_format((float) ($proveedor['total'] ?? 0), 2, '.', ',') }}
                                </div>
                            </div>

                            <div>
                                <button type="button"
                                    class="inline-flex items-center justify-center rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-700"
                                    wire:click="mountAction('registrarDirectorioDiario', @js(['proveedor' => $proveedor['proveedor_codigo'] ?? null, 'proveedor_key' => $proveedor['key'] ?? null]))">
                                    Generar Directorio y Diario
                                </button>
                            </div>
                        </div>

                        <div class="mt-4 space-y-3">
                            @foreach ($proveedor['empresas'] ?? [] as $empresa)
                                <div class="rounded-lg border border-gray-100 bg-gray-50 p-3">
                                    <div class="text-sm font-semibold text-gray-700">
                                        {{ $empresa['empresa_nombre'] ?? $empresa['empresa_codigo'] }}
                                    </div>

                                    <div class="mt-2 space-y-2">
                                        @foreach ($empresa['sucursales'] ?? [] as $sucursal)
                                            <div class="rounded-md border border-gray-200 bg-white p-3">
                                                <div class="text-xs font-semibold text-gray-600">
                                                    Sucursal: {{ $sucursal['sucursal_nombre'] ?? $sucursal['sucursal_codigo'] }}
                                                </div>

                                                <div class="mt-2 overflow-x-auto">
                                                    <table class="min-w-full text-sm">
                                                        <thead class="text-left text-xs font-semibold uppercase text-gray-500">
                                                            <tr>
                                                                <th class="px-2 py-1">Factura</th>
                                                                <th class="px-2 py-1">Emisión</th>
                                                                <th class="px-2 py-1">Vencimiento</th>
                                                                <th class="px-2 py-1 text-right">Saldo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-gray-100">
                                                            @foreach ($sucursal['facturas'] ?? [] as $factura)
                                                                <tr>
                                                                    <td class="px-2 py-1 font-semibold text-gray-700">
                                                                        {{ $factura['numero'] ?? 'N/D' }}
                                                                    </td>
                                                                    <td class="px-2 py-1 text-gray-600">
                                                                        @php
                                                                            $fechaEmision = $factura['fecha_emision'] ?? null;
                                                                        @endphp
                                                                        {{ $fechaEmision instanceof \Illuminate\Support\Carbon ? $fechaEmision->format('Y-m-d') : ($fechaEmision ?? 'N/D') }}
                                                                    </td>
                                                                    <td class="px-2 py-1 text-gray-600">
                                                                        @php
                                                                            $fechaVencimiento = $factura['fecha_vencimiento'] ?? null;
                                                                        @endphp
                                                                        {{ $fechaVencimiento instanceof \Illuminate\Support\Carbon ? $fechaVencimiento->format('Y-m-d') : ($fechaVencimiento ?? 'N/D') }}
                                                                    </td>
                                                                    <td class="px-2 py-1 text-right font-semibold text-gray-700">
                                                                        ${{ number_format((float) ($factura['saldo'] ?? 0), 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border border-gray-200 bg-white p-6 text-sm text-gray-600">
                        No existen facturas asociadas a esta solicitud.
                    </div>
                @endforelse
            </div>
        </x-filament::section>
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>
