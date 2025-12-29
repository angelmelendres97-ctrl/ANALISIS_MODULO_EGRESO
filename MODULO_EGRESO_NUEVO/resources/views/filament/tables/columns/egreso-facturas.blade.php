@php
    $state = $getState() ?? [];
    $facturas = $state['facturas'] ?? $state;
    $payment = $state['payment'] ?? [];
    $moneda = $payment['moneda'] ?? null;
    $monedaBase = $payment['moneda_base'] ?? null;
    $cotizacion = (float) ($payment['cotizacion'] ?? 1);
    $cotizacionExterna = (float) ($payment['cotizacion_externa'] ?? 1);
    $usarBase = $monedaBase !== null && $moneda !== null && $moneda === $monedaBase;
    $cotizacionUsada = $usarBase ? ($cotizacionExterna ?: 1) : ($cotizacion ?: 1);
@endphp

@if (empty($facturas))
    <span class="text-xs text-slate-500">Sin facturas registradas.</span>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full text-xs text-slate-600">
            <thead class="bg-slate-50 text-[11px] uppercase text-slate-500">
                <tr>
                    <th class="px-3 py-2 text-left">Tipo (CAN | FACTURAS | DB)</th>
                    <th class="px-3 py-2 text-left">Factura</th>
                    <th class="px-3 py-2 text-left">Vence</th>
                    <th class="px-3 py-2 text-left">Detalle</th>
                    <th class="px-3 py-2 text-right">Cotización</th>
                    <th class="px-3 py-2 text-right">Débito ML</th>
                    <th class="px-3 py-2 text-right">Crédito ML</th>
                    <th class="px-3 py-2 text-right">Débito ME</th>
                    <th class="px-3 py-2 text-right">Crédito ME</th>
                    <th class="px-3 py-2 text-right">Abono</th>
                    <th class="px-3 py-2 text-right">Saldo pendiente</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($facturas as $factura)
                    @php
                        $abono = (float) ($factura['abono'] ?? 0);
                        $saldo = (float) ($factura['saldo'] ?? 0);
                        $saldoPendiente = max(0, $saldo - $abono);
                        if ($usarBase) {
                            $debitoMl = $abono;
                            $creditoMl = 0;
                            $debitoMe = $cotizacionUsada > 0 ? round($abono / $cotizacionUsada, 2) : 0;
                            $creditoMe = 0;
                        } else {
                            $debitoMl = $abono * $cotizacionUsada;
                            $creditoMl = 0;
                            $debitoMe = $abono;
                            $creditoMe = 0;
                        }
                    @endphp
                    <tr>
                        <td class="px-3 py-2 font-semibold text-slate-700">{{ $factura['tipo'] ?? 'N/D' }}</td>
                        <td class="px-3 py-2">{{ $factura['numero'] ?? 'N/D' }}</td>
                        <td class="px-3 py-2">{{ optional($factura['fecha_vencimiento'] ?? null)->format('Y-m-d') ?? 'N/D' }}</td>
                        <td class="px-3 py-2">{{ $factura['detalle'] ?? ($payment['detalle'] ?? 'N/D') }}</td>
                        <td class="px-3 py-2 text-right">{{ number_format($cotizacionUsada, 4, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right text-emerald-700">{{ number_format($debitoMl, 2, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right text-rose-600">{{ number_format($creditoMl, 2, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right">{{ number_format($debitoMe, 2, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right">{{ number_format($creditoMe, 2, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right font-semibold text-emerald-700">{{ number_format($abono, 2, '.', ',') }}</td>
                        <td class="px-3 py-2 text-right">{{ number_format($saldoPendiente, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
