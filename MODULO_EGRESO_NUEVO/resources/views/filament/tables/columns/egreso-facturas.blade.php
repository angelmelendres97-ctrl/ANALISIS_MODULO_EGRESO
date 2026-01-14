@php
    $facturas = $facturas ?? ($getState() ?? []);
@endphp

@if (empty($facturas))
    <span class="text-xs text-slate-500">Sin facturas registradas.</span>
@else
    <div class="overflow-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-xs text-slate-600">
            <thead class="bg-slate-50 text-[11px] uppercase text-slate-500">
                <tr>
                    <th class="px-3 py-2 text-left">Tipo</th>
                    <th class="px-3 py-2 text-left">Factura</th>
                    <th class="px-3 py-2 text-left">Vence</th>
                    <th class="px-3 py-2 text-left">Detalle</th>
                    <th class="px-3 py-2 text-right">Cotización</th>
                    <th class="px-3 py-2 text-right">Débito ML</th>
                    <th class="px-3 py-2 text-right">Crédito ML</th>
                    <th class="px-3 py-2 text-right">Débito ME</th>
                    <th class="px-3 py-2 text-right">Crédito ME</th>
                    <th class="px-3 py-2 text-right">Abono</th>
                    <th class="px-3 py-2 text-right">Saldo</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($facturas as $factura)
                    @php
                        $vence = $factura['fecha_vencimiento'] ?? null;
                    @endphp
                    <tr>
                        <td class="px-3 py-2 font-semibold text-slate-700">{{ $factura['tipo'] ?? 'N/D' }}</td>
                        <td class="px-3 py-2">{{ $factura['numero'] ?? 'N/D' }}</td>
                        <td class="px-3 py-2">{{ $vence ? \Illuminate\Support\Carbon::parse($vence)->format('Y-m-d') : 'N/D' }}</td>
                        <td class="px-3 py-2 text-slate-500">{{ $factura['detalle'] ?? 'N/D' }}</td>
                        <td class="px-3 py-2 text-right">
                            {{ isset($factura['cotizacion']) ? number_format((float) $factura['cotizacion'], 4, '.', ',') : 'N/D' }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            {{ number_format((float) ($factura['debito_local'] ?? 0), 2, '.', ',') }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            {{ number_format((float) ($factura['credito_local'] ?? 0), 2, '.', ',') }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            {{ number_format((float) ($factura['debito_extranjera'] ?? 0), 2, '.', ',') }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            {{ number_format((float) ($factura['credito_extranjera'] ?? 0), 2, '.', ',') }}
                        </td>
                        <td class="px-3 py-2 text-right font-semibold text-emerald-700">
                            {{ number_format((float) ($factura['abono_total'] ?? $factura['abono'] ?? 0), 2, '.', ',') }}
                        </td>
                        <td class="px-3 py-2 text-right text-slate-500">
                            {{ number_format((float) ($factura['saldo_pendiente'] ?? 0), 2, '.', ',') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
