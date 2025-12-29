<?php

namespace App\Filament\Pages;

use App\Filament\Resources\SolicitudPagoEgresoResource;
use App\Models\SolicitudPago;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class RegistrarEgreso extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.registrar-egreso';

    protected static ?string $title = 'Registrar egreso';

    public ?SolicitudPago $solicitud = null;

    public array $providers = [];

    public function mount(): void
    {
        $recordId = request()->integer('record');

        if ($recordId) {
            $this->solicitud = SolicitudPago::with('detalles')->find($recordId);
        }

        if (! $this->solicitud) {
            Notification::make()
                ->title('Solicitud de pago no encontrada.')
                ->danger()
                ->send();

            $this->redirect(SolicitudPagoEgresoResource::getUrl());

            return;
        }

        if (strtoupper((string) $this->solicitud->estado) !== 'APROBADA') {
            Notification::make()
                ->title('La solicitud debe estar aprobada para registrar el egreso.')
                ->warning()
                ->send();

            $this->redirect(SolicitudPagoEgresoResource::getUrl());

            return;
        }

        $this->providers = $this->buildProviders($this->solicitud);
    }

    protected function getActions(): array
    {
        return [
            Action::make('generarDirectorio')
                ->label('Generar Directorio y Diario')
                ->icon('heroicon-o-document-check')
                ->modalWidth('3xl')
                ->modalHeading(function (array $arguments): string {
                    $provider = $this->findProvider(Arr::get($arguments, 'provider_key'));

                    if (! $provider) {
                        return 'Generar Directorio y Diario';
                    }

                    $label = $provider['proveedor_nombre']
                        ?: ($provider['proveedor_codigo'] ?? 'Proveedor');

                    return "Generar Directorio y Diario · {$label}";
                })
                ->form([
                    Wizard::make([
                        Step::make('Datos contables')
                            ->schema([
                                Select::make('moneda')
                                    ->label('Moneda')
                                    ->options([
                                        'USD' => 'USD',
                                        'EUR' => 'EUR',
                                        'PEN' => 'PEN',
                                    ])
                                    ->required(),
                                Select::make('formato')
                                    ->label('Formato')
                                    ->options([
                                        'NORMAL' => 'Normal',
                                        'COMPACTO' => 'Compacto',
                                        'RETENCION' => 'Retención',
                                    ])
                                    ->required(),
                                Textarea::make('detalle')
                                    ->label('Detalle')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->required(),
                                TextInput::make('cotizacion')
                                    ->label('Cotización')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(),
                                TextInput::make('cotizacion_externa')
                                    ->label('Cotización externa')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(),
                            ])
                            ->columns(2),
                        Step::make('Pagos y cuentas')
                            ->schema([
                                Select::make('opcion_pago')
                                    ->label('Opciones de pago')
                                    ->options([
                                        'transferencia' => 'Transferencia',
                                        'cheque' => 'Cheque',
                                        'efectivo' => 'Efectivo',
                                    ])
                                    ->required(),
                                Select::make('cuenta_contable')
                                    ->label('Selección de cuentas')
                                    ->options([
                                        'cta-001' => 'Cuenta 001',
                                        'cta-002' => 'Cuenta 002',
                                        'cta-003' => 'Cuenta 003',
                                    ])
                                    ->required(),
                                Select::make('cheque')
                                    ->label('Selección de cheques')
                                    ->options([
                                        'cheque-0001' => 'Cheque 0001',
                                        'cheque-0002' => 'Cheque 0002',
                                        'cheque-0003' => 'Cheque 0003',
                                    ])
                                    ->required(),
                            ])
                            ->columns(2),
                    ]),
                ])
                ->action(function (array $data, array $arguments): void {
                    $provider = $this->findProvider(Arr::get($arguments, 'provider_key'));
                    $label = $provider['proveedor_nombre']
                        ?: ($provider['proveedor_codigo'] ?? 'Proveedor');

                    Notification::make()
                        ->title('Directorio y diario generados')
                        ->body("Proveedor: {$label} · Moneda: {$data['moneda']} · Formato: {$data['formato']}")
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function buildProviders(SolicitudPago $solicitud): array
    {
        return $solicitud
            ->detalles
            ->groupBy(function ($detalle) {
                return $detalle->proveedor_codigo
                    ?: ($detalle->proveedor_nombre ?: (string) $detalle->id);
            })
            ->map(function (Collection $items, $key) {
                $first = $items->first();

                return [
                    'key' => (string) $key,
                    'proveedor_codigo' => $first->proveedor_codigo,
                    'proveedor_nombre' => $first->proveedor_nombre,
                    'proveedor_ruc' => $first->proveedor_ruc,
                    'total_facturas' => $items->sum(fn($detalle) => (float) $detalle->monto_factura),
                    'total_abono' => $items->sum(fn($detalle) => (float) $detalle->abono_aplicado),
                    'facturas' => $items->map(function ($detalle) {
                        return [
                            'numero_factura' => $detalle->numero_factura,
                            'fecha_emision' => $this->formatDate($detalle->fecha_emision),
                            'fecha_vencimiento' => $this->formatDate($detalle->fecha_vencimiento),
                            'monto_factura' => (float) $detalle->monto_factura,
                            'abono_aplicado' => (float) $detalle->abono_aplicado,
                        ];
                    })->values()->all(),
                ];
            })
            ->values()
            ->all();
    }

    protected function formatDate($value): ?string
    {
        if (! $value) {
            return null;
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

    protected function findProvider(?string $providerKey): ?array
    {
        if (! $providerKey) {
            return null;
        }

        return collect($this->providers)
            ->first(fn(array $provider) => $provider['key'] === $providerKey);
    }
}
