<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">
                Registro de egreso
            </x-slot>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Solicitud</div>
                    <div class="mt-1 text-lg font-bold text-slate-900">#{{ $this->solicitud->id }}</div>
                    <div class="text-sm text-slate-600">{{ $this->solicitud->motivo ?? 'Sin motivo' }}</div>
                </div>
                @php
                    $estadoSolicitud = strtoupper($this->solicitud->estado ?? '');
                    $estadoLabel = $estadoSolicitud === 'APROBADA'
                        ? 'Aprobada y pendiente de egreso'
                        : ($this->solicitud->estado ?? 'N/D');
                    $estadoColor = $estadoSolicitud === 'APROBADA' ? 'text-amber-600' : 'text-emerald-700';
                @endphp
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Estado</div>
                    <div class="mt-1 text-lg font-bold {{ $estadoColor }}">{{ $estadoLabel }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total facturas</div>
                    <div class="mt-1 text-lg font-bold text-slate-900">{{ $this->totalFacturas }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total a pagar</div>
                    <div class="mt-1 text-lg font-bold text-amber-700">{{ $this->totalAbonoHtml }}</div>
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Facturas agrupadas por proveedor
            </x-slot>

            {{ $this->table }}
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Directorio y Diario generado
            </x-slot>

            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-lg border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total débito</div>
                    <div class="mt-1 text-lg font-bold text-slate-900">${{ number_format($this->totalDebito, 2, '.', ',') }}</div>
                </div>
                <div class="rounded-lg border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total crédito</div>
                    <div class="mt-1 text-lg font-bold text-slate-900">${{ number_format($this->totalCredito, 2, '.', ',') }}</div>
                </div>
                <div class="rounded-lg border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Diferencia</div>
                    <div class="mt-1 text-lg font-bold {{ $this->totalDiferencia === 0.0 ? 'text-emerald-700' : 'text-rose-600' }}">
                        ${{ number_format($this->totalDiferencia, 2, '.', ',') }}
                    </div>
                </div>
            </div>

            <div class="mt-6" x-data="{ tab: 'directorio' }">
                <div class="flex flex-wrap gap-2">
                    <button type="button"
                        class="rounded-lg px-4 py-2 text-sm font-semibold transition"
                        :class="tab === 'directorio' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200'"
                        @click="tab = 'directorio'">
                        Directorio
                    </button>
                    <button type="button"
                        class="rounded-lg px-4 py-2 text-sm font-semibold transition"
                        :class="tab === 'diario' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200'"
                        @click="tab = 'diario'">
                        Diario
                    </button>
                </div>

                <div class="mt-4" x-show="tab === 'directorio'">
                    @if (empty($this->directorioEntries))
                        <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 p-4 text-sm text-slate-500">
                            Aún no se han generado entradas de directorio para esta solicitud.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($this->directorioEntries as $providerKey => $entries)
                                <div class="rounded-xl border border-slate-200 bg-white p-4">
                                    <div class="text-sm font-semibold text-slate-800">
                                        Proveedor {{ $entries[0]['proveedor'] ?? (explode('|', $providerKey)[0] ?? 'N/D') }}
                                    </div>
                                    <div class="mt-3 overflow-auto rounded-lg border border-slate-200">
                                        <table class="w-full text-xs text-slate-600">
                                            <thead class="bg-slate-50 text-[11px] uppercase text-slate-500">
                                                <tr>
                                                    <th class="px-3 py-2 text-left">Proveedor</th>
                                                    <th class="px-3 py-2 text-left">Tipo</th>
                                                    <th class="px-3 py-2 text-left">Factura</th>
                                                    <th class="px-3 py-2 text-left">Vence</th>
                                                    <th class="px-3 py-2 text-left">Detalle</th>
                                                    <th class="px-3 py-2 text-right">Cotización</th>
                                                    <th class="px-3 py-2 text-right">Débito ML</th>
                                                    <th class="px-3 py-2 text-right">Crédito ML</th>
                                                    <th class="px-3 py-2 text-right">Débito ME</th>
                                                    <th class="px-3 py-2 text-right">Crédito ME</th>
                                                    <th class="px-3 py-2 text-center">Diario</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach ($entries as $entry)
                                                    @php
                                                        $vence = $entry['fecha_vencimiento'] ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td class="px-3 py-2 font-semibold text-slate-700">{{ $entry['proveedor'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['tipo'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['factura'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">
                                                            {{ $vence ? \Illuminate\Support\Carbon::parse($vence)->format('Y-m-d') : 'N/D' }}
                                                        </td>
                                                        <td class="px-3 py-2 text-slate-500">{{ $entry['detalle'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2 text-right">
                                                            {{ number_format((float) ($entry['cotizacion'] ?? 1), 4, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-right">
                                                            {{ number_format((float) ($entry['debito_local'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-right">
                                                            {{ number_format((float) ($entry['credito_local'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-right">
                                                            {{ number_format((float) ($entry['debito_extranjera'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-right">
                                                            {{ number_format((float) ($entry['credito_extranjera'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-center text-emerald-700">
                                                            {{ ($entry['diario_generado'] ?? false) ? 'Sí' : 'No' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-4" x-show="tab === 'diario'">
                    @if (empty($this->diarioEntries))
                        <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 p-4 text-sm text-slate-500">
                            Aún no se han generado movimientos en el diario para esta solicitud.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($this->diarioEntries as $providerKey => $entries)
                                <div class="rounded-xl border border-slate-200 bg-white p-4">
                                    <div class="text-sm font-semibold text-slate-800">
                                        Proveedor {{ $entries[0]['beneficiario'] ?? (explode('|', $providerKey)[0] ?? 'N/D') }}
                                    </div>
                                    <div class="mt-3 overflow-auto rounded-lg border border-slate-200">
                                        <table class="w-full text-xs text-slate-600">
                                            <thead class="bg-slate-50 text-[11px] uppercase text-slate-500">
                                                <tr>
                                                    <th class="px-3 py-2 text-left">Fila</th>
                                                    <th class="px-3 py-2 text-left">Cuenta contable</th>
                                                    <th class="px-3 py-2 text-left">Nombre</th>
                                                    <th class="px-3 py-2 text-left">Documento</th>
                                                    <th class="px-3 py-2 text-right">Cotización</th>
                                                    <th class="px-3 py-2 text-right">Débito ML</th>
                                                    <th class="px-3 py-2 text-right">Crédito ML</th>
                                                    <th class="px-3 py-2 text-right">Débito ME</th>
                                                    <th class="px-3 py-2 text-right">Crédito ME</th>
                                                    <th class="px-3 py-2 text-left">Beneficiario</th>
                                                    <th class="px-3 py-2 text-left">Cuenta bancaria</th>
                                                    <th class="px-3 py-2 text-left">Banco/Cheque</th>
                                                    <th class="px-3 py-2 text-left">Fecha venc.</th>
                                                    <th class="px-3 py-2 text-left">Formato cheque</th>
                                                    <th class="px-3 py-2 text-left">Código contable</th>
                                                    <th class="px-3 py-2 text-left">Detalle</th>
                                                    <th class="px-3 py-2 text-left">Centro costo</th>
                                                    <th class="px-3 py-2 text-left">Centro actividad</th>
                                                    <th class="px-3 py-2 text-left">Directorio</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach ($entries as $entry)
                                                    @php
                                                        $vence = $entry['fecha_vencimiento'] ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td class="px-3 py-2 font-semibold text-slate-700">{{ $entry['fila'] ?? '-' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['cuenta'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2 text-slate-500">{{ $entry['cuenta_nombre'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['documento'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2 text-right">{{ number_format((float) ($entry['cotizacion'] ?? 1), 4, '.', ',') }}</td>
                                                        <td class="px-3 py-2 text-right">{{ number_format((float) ($entry['debito'] ?? 0), 2, '.', ',') }}</td>
                                                        <td class="px-3 py-2 text-right">{{ number_format((float) ($entry['credito'] ?? 0), 2, '.', ',') }}</td>
                                                        <td class="px-3 py-2 text-right">{{ number_format((float) ($entry['debito_extranjera'] ?? 0), 2, '.', ',') }}</td>
                                                        <td class="px-3 py-2 text-right">{{ number_format((float) ($entry['credito_extranjera'] ?? 0), 2, '.', ',') }}</td>
                                                        <td class="px-3 py-2">{{ $entry['beneficiario'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['cuenta_bancaria'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['banco_cheque'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">
                                                            {{ $vence ? \Illuminate\Support\Carbon::parse($vence)->format('Y-m-d') : 'N/D' }}
                                                        </td>
                                                        <td class="px-3 py-2">{{ $entry['formato_cheque'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['codigo_contable'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2 text-slate-500">{{ $entry['detalle'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['centro_costo'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['centro_actividad'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['directorio'] ?? 'N/D' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
