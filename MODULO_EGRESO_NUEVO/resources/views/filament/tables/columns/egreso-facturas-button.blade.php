@php
    $facturas = $getState() ?? [];
    $count = is_countable($facturas) ? count($facturas) : 0;
@endphp

<div class="flex items-center justify-center">
    <x-filament::button
        type="button"
        size="sm"
        color="gray"
        class="whitespace-nowrap"
        wire:click="mountTableAction('verFacturas', {{ \Illuminate\Support\Js::from($record->getKey()) }})"
    >
        Ver facturas {{ $count ? "({$count})" : '' }}
    </x-filament::button>
</div>
