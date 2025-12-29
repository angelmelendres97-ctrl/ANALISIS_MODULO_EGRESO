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
                <div class="rounded-xl border border-slate-200 bg-white p-4">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Estado</div>
                    <div class="mt-1 text-lg font-bold text-emerald-700">{{ $this->solicitud->estado }}</div>
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
                                        Proveedor {{ explode('|', $providerKey)[0] ?? 'N/D' }}
                                    </div>
                                    <div class="mt-3 space-y-2">
                                        @foreach ($entries as $entry)
                                            @php
                                                $vence = $entry['fecha_vencimiento'] ?? null;
                                                $venceLabel = $vence ? \Illuminate\Support\Carbon::parse($vence)->format('Y-m-d') : 'N/D';
                                            @endphp
                                            <div class="rounded-lg border border-slate-100 bg-slate-50 p-3 text-sm text-slate-700">
                                                <div class="flex items-center justify-between font-semibold">
                                                    <span>Factura {{ $entry['factura'] ?? 'N/D' }}</span>
                                                    <span class="text-amber-700">${{ number_format((float) ($entry['abono'] ?? 0), 2, '.', ',') }}</span>
                                                </div>
                                                <div class="mt-1 text-xs text-slate-500">
                                                    Vence: {{ $venceLabel }}
                                                    · Moneda: {{ $entry['moneda'] ?? 'N/D' }}
                                                    · Cotización: {{ number_format((float) ($entry['cotizacion'] ?? 1), 4, '.', ',') }}
                                                </div>
                                                <div class="mt-1 text-xs text-slate-500">
                                                    Detalle: {{ $entry['detalle'] ?? 'N/D' }}
                                                </div>
                                            </div>
                                        @endforeach
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
                                        Proveedor {{ explode('|', $providerKey)[0] ?? 'N/D' }}
                                    </div>
                                    <div class="mt-3 space-y-2">
                                        @foreach ($entries as $entry)
                                            <div class="grid gap-2 rounded-lg border border-slate-100 bg-slate-50 p-3 text-sm text-slate-700 md:grid-cols-4">
                                                <div>
                                                    <div class="text-xs uppercase text-slate-500">Cuenta</div>
                                                    <div class="font-semibold">{{ $entry['cuenta'] ?? 'N/D' }}</div>
                                                    <div class="text-xs text-slate-500">{{ $entry['cuenta_nombre'] ?? '' }}</div>
                                                </div>
                                                <div class="md:col-span-2">
                                                    <div class="text-xs uppercase text-slate-500">Detalle</div>
                                                    <div class="font-semibold">{{ $entry['detalle'] ?? 'N/D' }}</div>
                                                    @if (!empty($entry['cheque']))
                                                        <div class="text-xs text-slate-500">
                                                            Cheque: {{ $entry['cheque'] }} · Formato: {{ $entry['formato_cheque'] ?? 'N/D' }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-xs uppercase text-slate-500">Débito / Crédito</div>
                                                    <div class="font-semibold text-emerald-700">
                                                        ${{ number_format((float) ($entry['debito'] ?? 0), 2, '.', ',') }}
                                                    </div>
                                                    <div class="font-semibold text-rose-600">
                                                        ${{ number_format((float) ($entry['credito'] ?? 0), 2, '.', ',') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
