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
    </div>
</x-filament-panels::page>
