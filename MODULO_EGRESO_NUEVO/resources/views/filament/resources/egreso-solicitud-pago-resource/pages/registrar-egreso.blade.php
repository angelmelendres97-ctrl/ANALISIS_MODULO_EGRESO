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
                Generación contable
            </x-slot>

            <div x-data="{ tab: 'directorio' }" class="space-y-4">
                <div class="flex flex-wrap gap-2">
                    <button type="button"
                        class="rounded-lg px-3 py-2 text-sm font-semibold"
                        :class="tab === 'directorio' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-700'"
                        @click="tab = 'directorio'">
                        Directorio
                    </button>
                    <button type="button"
                        class="rounded-lg px-3 py-2 text-sm font-semibold"
                        :class="tab === 'diario' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-700'"
                        @click="tab = 'diario'">
                        Diario
                    </button>
                </div>

                <div x-show="tab === 'directorio'">
                    @if (empty($this->directorioEntries))
                        <p class="text-sm text-gray-500">Aún no se han generado líneas de directorio.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($this->directorioEntries as $providerKey => $entries)
                                <div class="rounded-xl border border-slate-200 bg-white p-4">
                                    <div class="text-sm font-semibold text-slate-800">
                                        {{ $this->providerLabels[$providerKey] ?? 'Proveedor' }}
                                    </div>
                                    <div class="mt-3 overflow-x-auto">
                                        <table class="min-w-full text-sm">
                                            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                                                <tr>
                                                    <th class="px-3 py-2 text-left">Factura</th>
                                                    <th class="px-3 py-2 text-left">Vencimiento</th>
                                                    <th class="px-3 py-2 text-left">Detalle</th>
                                                    <th class="px-3 py-2 text-right">Débito</th>
                                                    <th class="px-3 py-2 text-right">Crédito</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach ($entries as $entry)
                                                    <tr>
                                                        <td class="px-3 py-2">{{ $entry['factura'] ?? 'N/D' }}</td>
                                                        <td class="px-3 py-2">
                                                            {{ optional($entry['fecha_vencimiento'] ?? null)->format('Y-m-d') }}
                                                        </td>
                                                        <td class="px-3 py-2">{{ $entry['detalle'] ?? '' }}</td>
                                                        <td class="px-3 py-2 text-right text-emerald-700">
                                                            ${{ number_format((float) ($entry['debito'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-right text-amber-700">
                                                            ${{ number_format((float) ($entry['credito'] ?? 0), 2, '.', ',') }}
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

                <div x-show="tab === 'diario'">
                    @if (empty($this->diarioEntries))
                        <p class="text-sm text-gray-500">Aún no se han generado líneas de diario.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($this->diarioEntries as $providerKey => $entries)
                                <div class="rounded-xl border border-slate-200 bg-white p-4">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <div class="text-sm font-semibold text-slate-800">
                                            {{ $this->providerLabels[$providerKey] ?? 'Proveedor' }}
                                        </div>
                                        <div class="text-xs font-semibold text-emerald-700">
                                            Balance: ${{ number_format($this->getDiarioBalanceForProvider($providerKey), 2, '.', ',') }}
                                        </div>
                                    </div>
                                    <div class="mt-3 overflow-x-auto">
                                        <table class="min-w-full text-sm">
                                            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                                                <tr>
                                                    <th class="px-3 py-2 text-left">Cuenta</th>
                                                    <th class="px-3 py-2 text-left">Descripción</th>
                                                    <th class="px-3 py-2 text-right">Débito</th>
                                                    <th class="px-3 py-2 text-right">Crédito</th>
                                                    <th class="px-3 py-2 text-left">Cheque</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach ($entries as $entry)
                                                    <tr>
                                                        <td class="px-3 py-2">{{ $entry['cuenta'] ?? '' }}</td>
                                                        <td class="px-3 py-2">{{ $entry['descripcion'] ?? '' }}</td>
                                                        <td class="px-3 py-2 text-right text-emerald-700">
                                                            ${{ number_format((float) ($entry['debito'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-right text-amber-700">
                                                            ${{ number_format((float) ($entry['credito'] ?? 0), 2, '.', ',') }}
                                                        </td>
                                                        <td class="px-3 py-2 text-xs text-slate-500">
                                                            @if (!empty($entry['cheque']))
                                                                {{ $entry['cheque'] }}
                                                                @if (!empty($entry['fecha_cheque']))
                                                                    · {{ \Illuminate\Support\Carbon::parse($entry['fecha_cheque'])->format('Y-m-d') }}
                                                                @endif
                                                            @else
                                                                --
                                                            @endif
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
            </div>

            <div class="mt-4 flex flex-wrap items-center justify-end gap-3">
                <x-filament::button
                    color="success"
                    wire:click="registrarEgresoFinal"
                    :disabled="! $this->canRegistrarEgreso() || $this->egresoRegistrado"
                >
                    {{ $this->egresoRegistrado ? 'Egreso preparado' : 'Registrar egreso' }}
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
