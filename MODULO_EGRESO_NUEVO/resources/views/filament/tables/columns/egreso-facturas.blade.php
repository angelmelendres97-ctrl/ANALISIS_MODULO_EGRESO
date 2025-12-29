@php
    $facturas = $getState() ?? [];
@endphp

@if (empty($facturas))
    <span class="text-xs text-slate-500">Sin facturas registradas.</span>
@else
    <div class="space-y-1">
        @foreach ($facturas as $factura)
            <div class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-700">
                <div class="flex items-center justify-between">
                    <span class="font-semibold">Factura {{ $factura['numero'] ?? 'N/D' }}</span>
                    <span class="font-semibold text-emerald-700">
                        ${{ number_format((float) ($factura['abono'] ?? 0), 2, '.', ',') }}
                    </span>
                </div>
                <div class="mt-1 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Emisión: {{ optional($factura['fecha_emision'] ?? null)->format('Y-m-d') }}</span>
                    <span>Vence: {{ optional($factura['fecha_vencimiento'] ?? null)->format('Y-m-d') }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endif
