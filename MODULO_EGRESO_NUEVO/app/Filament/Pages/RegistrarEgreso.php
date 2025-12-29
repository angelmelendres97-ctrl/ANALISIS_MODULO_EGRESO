<?php

namespace App\Filament\Pages;

use App\Filament\Resources\SolicitudPagoResource;
use App\Models\SolicitudPago;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class RegistrarEgreso extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Registrar egreso';

    protected static string $view = 'filament.pages.registrar-egreso';

    public ?SolicitudPago $solicitud = null;

    public array $proveedores = [];

    public ?array $modalData = [];

    public function mount(): void
    {
        $recordId = request()->integer('record');

        if (! $recordId) {
            Notification::make()
                ->title('No se encontró la solicitud de pago.')
                ->danger()
                ->send();
            $this->redirect(RegistroEgresos::getUrl());

            return;
        }

        $this->solicitud = SolicitudPago::with(['detalles'])->find($recordId);

        if (! $this->solicitud) {
            Notification::make()
                ->title('No se encontró la solicitud de pago.')
                ->danger()
                ->send();
            $this->redirect(RegistroEgresos::getUrl());

            return;
        }

        if (strtoupper((string) $this->solicitud->estado) !== 'APROBADA') {
            Notification::make()
                ->title('Solo se pueden registrar egresos de solicitudes aprobadas.')
                ->warning()
                ->send();
            $this->redirect(RegistroEgresos::getUrl());

            return;
        }

        $this->proveedores = $this->buildFacturasDesdeSolicitud($this->solicitud);
    }

    public function registrarDirectorioDiarioAction(): Action
    {
        return Action::make('registrarDirectorioDiario')
            ->label('Generar Directorio y Diario')
            ->color('primary')
            ->modalHeading('Generar Directorio y Diario')
            ->form($this->getEgresoWizardSchema())
            ->action(fn () => null);
    }

    public function guardarEgreso(): void
    {
        Notification::make()
            ->title('Egreso registrado (pendiente de integración contable).')
            ->success()
            ->send();

        $this->dispatch('close-modal', id: "{$this->getId()}-action");
    }

    protected function buildFacturasDesdeSolicitud(SolicitudPago $solicitud): array
    {
        $registros = collect();
        $conexionNombres = [];
        $empresaOptionsCache = [];
        $sucursalOptionsCache = [];

        foreach ($solicitud->detalles as $detalle) {
            $conexionId = (int) ($detalle->erp_conexion ?? $solicitud->id_empresa);
            $empresaCodigo = (string) ($detalle->erp_empresa_id ?? '');
            $sucursalCodigo = (string) ($detalle->erp_sucursal ?? '');
            $numeroFactura = (string) ($detalle->numero_factura ?? '');
            $esCompra = strtoupper((string) $detalle->erp_tabla) === 'COMPRA' || str_starts_with($numeroFactura, 'COMPRA-');

            if (! isset($conexionNombres[$conexionId])) {
                $conexionNombres[$conexionId] = \App\Models\Empresa::query()
                    ->where('id', $conexionId)
                    ->value('nombre_empresa') ?? (string) $conexionId;
            }

            if (! isset($empresaOptionsCache[$conexionId])) {
                $empresaOptionsCache[$conexionId] = SolicitudPagoResource::getEmpresasOptions($conexionId);
            }

            $empresaOptions = $empresaOptionsCache[$conexionId];

            if (! isset($sucursalOptionsCache[$conexionId][$empresaCodigo])) {
                $sucursalOptionsCache[$conexionId][$empresaCodigo] = SolicitudPagoResource::getSucursalesOptions($conexionId, array_filter([$empresaCodigo]));
            }

            $sucursalOptions = $sucursalOptionsCache[$conexionId][$empresaCodigo] ?? [];

            $registros->push([
                'key' => $detalle->erp_clave,
                'conexion_id' => $conexionId,
                'conexion_nombre' => $conexionNombres[$conexionId],
                'empresa_codigo' => $empresaCodigo,
                'empresa_nombre' => $empresaOptions[$empresaCodigo] ?? $empresaCodigo,
                'sucursal_codigo' => $sucursalCodigo,
                'sucursal_nombre' => $sucursalOptions[$sucursalCodigo] ?? $sucursalCodigo,
                'proveedor_codigo' => $detalle->proveedor_codigo ?? '',
                'proveedor_nombre' => $detalle->proveedor_nombre ?? ($detalle->proveedor_codigo ?? ''),
                'proveedor_ruc' => $detalle->proveedor_ruc,
                'numero' => $numeroFactura,
                'fecha_emision' => $detalle->fecha_emision,
                'fecha_vencimiento' => $detalle->fecha_vencimiento,
                'total' => (float) ($detalle->monto_factura ?? 0),
                'saldo' => (float) ($detalle->saldo_al_crear ?? 0),
                'abono' => (float) ($detalle->abono_aplicado ?? 0),
                'estado_abono' => $detalle->estado_abono ?? $this->resolveEstadoAbono((float) ($detalle->monto_factura ?? 0), (float) ($detalle->abono_aplicado ?? 0)),
                'tipo' => $esCompra ? 'compra' : null,
            ]);
        }

        return $this->groupByProveedor($registros);
    }

    protected function buildFacturaKey(?string $conexion, ?string $empresa, ?string $sucursal, ?string $proveedor, ?string $numero, ?string $ruc = null): string
    {
        $raw = trim(($conexion ?? '') . '|' . ($empresa ?? '') . '|' . ($sucursal ?? '') . '|' . ($proveedor ?? '') . '|' . ($numero ?? '') . '|' . ($ruc ?? ''));

        return hash('sha256', $raw);
    }

    protected function buildProveedorKey(?string $codigo, ?string $ruc, ?string $nombre): string
    {
        $ruc = preg_replace('/\\s+/', '', (string) $ruc);
        $ruc = preg_replace('/[^0-9A-Za-z]/', '', $ruc);

        if (! empty($ruc)) {
            return 'ruc:' . mb_strtolower($ruc);
        }

        $nombre = mb_strtolower(trim((string) $nombre));
        $nombre = preg_replace('/\\s+/', ' ', $nombre);

        if ($nombre !== '') {
            return 'nom:' . md5($nombre);
        }

        return 'cod:' . mb_strtolower(trim((string) $codigo));
    }

    protected function groupByProveedor($registros): array
    {
        $agrupado = [];

        foreach ($registros as $row) {
            $proveedorKey = $this->buildProveedorKey($row['proveedor_codigo'] ?? '', $row['proveedor_ruc'] ?? '', $row['proveedor_nombre'] ?? '');
            $empresaKey = ($row['conexion_id'] ?? '') . '|' . ($row['empresa_codigo'] ?? '');
            $sucursalKey = $empresaKey . '|' . ($row['sucursal_codigo'] ?? '');
            $esCompra = ($row['tipo'] ?? null) === 'compra';

            if (! isset($agrupado[$proveedorKey])) {
                $agrupado[$proveedorKey] = [
                    'key' => $proveedorKey,
                    'proveedor_codigo' => $row['proveedor_codigo'] ?? null,
                    'proveedor_nombre' => $row['proveedor_nombre'] ?? null,
                    'proveedor_ruc' => $row['proveedor_ruc'] ?? null,
                    'proveedor_actividad' => $row['proveedor_actividad'] ?? null,
                    'total' => 0,
                    'facturas_count' => 0,
                    'es_compra' => $esCompra,
                    'empresas' => [],
                ];
            } elseif ($esCompra) {
                $agrupado[$proveedorKey]['es_compra'] = true;
            }

            if (! isset($agrupado[$proveedorKey]['empresas'][$empresaKey])) {
                $agrupado[$proveedorKey]['empresas'][$empresaKey] = [
                    'conexion_id' => $row['conexion_id'] ?? null,
                    'conexion_nombre' => $row['conexion_nombre'] ?? null,
                    'empresa_codigo' => $row['empresa_codigo'] ?? null,
                    'empresa_nombre' => $row['empresa_nombre'] ?? null,
                    'sucursales' => [],
                ];
            }

            if (! isset($agrupado[$proveedorKey]['empresas'][$empresaKey]['sucursales'][$sucursalKey])) {
                $agrupado[$proveedorKey]['empresas'][$empresaKey]['sucursales'][$sucursalKey] = [
                    'sucursal_codigo' => $row['sucursal_codigo'] ?? null,
                    'sucursal_nombre' => $row['sucursal_nombre'] ?? null,
                    'facturas' => [],
                ];
            }

            $facturaKey = $this->buildFacturaKey(
                $row['conexion_id'] ?? null,
                $row['empresa_codigo'] ?? null,
                $row['sucursal_codigo'] ?? null,
                $row['proveedor_codigo'] ?? null,
                $row['numero'] ?? null,
                $row['proveedor_ruc'] ?? null
            );

            $agrupado[$proveedorKey]['empresas'][$empresaKey]['sucursales'][$sucursalKey]['facturas'][] = [
                'key' => $facturaKey,
                'numero' => $row['numero'] ?? '',
                'fecha_emision' => $row['fecha_emision'] ?? null,
                'fecha_vencimiento' => $row['fecha_vencimiento'] ?? null,
                'saldo' => (float) ($row['saldo'] ?? 0),
                'total' => (float) ($row['total'] ?? $row['saldo'] ?? 0),
                'empresa_codigo' => $row['empresa_codigo'] ?? null,
                'empresa_nombre' => $row['empresa_nombre'] ?? null,
                'sucursal_codigo' => $row['sucursal_codigo'] ?? null,
                'sucursal_nombre' => $row['sucursal_nombre'] ?? null,
                'conexion_id' => $row['conexion_id'] ?? null,
                'conexion_nombre' => $row['conexion_nombre'] ?? null,
                'tipo' => $row['tipo'] ?? null,
            ];

            $agrupado[$proveedorKey]['total'] += (float) ($row['saldo'] ?? 0);
            $agrupado[$proveedorKey]['facturas_count']++;
        }

        foreach ($agrupado as &$proveedor) {
            foreach ($proveedor['empresas'] as &$empresa) {
                foreach ($empresa['sucursales'] as &$sucursal) {
                    $sucursal['facturas'] = collect($sucursal['facturas'])
                        ->sortBy('fecha_emision')
                        ->values()
                        ->all();
                }
                unset($sucursal);
                $empresa['sucursales'] = array_values($empresa['sucursales']);
            }
            unset($empresa);
            $proveedor['empresas'] = array_values($proveedor['empresas']);
        }
        unset($proveedor);

        return collect($agrupado)
            ->sortBy('proveedor_nombre')
            ->values()
            ->all();
    }

    protected function resolveEstadoAbono(float $total, float $abono): string
    {
        if ($abono <= 0) {
            return 'PENDIENTE';
        }

        if ($abono < $total) {
            return 'PARCIAL';
        }

        return 'COMPLETO';
    }

    protected function getEgresoWizardSchema(): array
    {
        return [
            Wizard::make([
                Step::make('Datos del egreso')
                    ->schema([
                        Section::make()
                            ->schema([
                                Select::make('moneda')
                                    ->label('Moneda')
                                    ->options([
                                        'USD' => 'USD',
                                        'EUR' => 'EUR',
                                        'LOCAL' => 'Moneda local',
                                    ])
                                    ->required(),
                                Select::make('formato')
                                    ->label('Formato')
                                    ->options([
                                        'CHEQUE' => 'Cheque',
                                        'TRANSFERENCIA' => 'Transferencia',
                                        'EFECTIVO' => 'Efectivo',
                                    ])
                                    ->required(),
                                TextInput::make('detalle')
                                    ->label('Detalle')
                                    ->required(),
                                TextInput::make('cotizacion')
                                    ->label('Cotización')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('cotizacion_externa')
                                    ->label('Cotización externa')
                                    ->numeric(),
                            ])
                            ->columns(2),
                    ]),
                Step::make('Opciones de pago')
                    ->schema([
                        Section::make('Opciones de pago')
                            ->schema([
                                Select::make('opcion_pago')
                                    ->label('Opción de pago')
                                    ->options([
                                        'CHEQUE' => 'Cheque',
                                        'TRANSFERENCIA' => 'Transferencia',
                                        'EFECTIVO' => 'Efectivo',
                                    ])
                                    ->required(),
                                Select::make('cuenta_bancaria')
                                    ->label('Cuenta')
                                    ->options([
                                        'CTA-001' => 'Cuenta 001',
                                        'CTA-002' => 'Cuenta 002',
                                    ])
                                    ->required(),
                                Select::make('cheque')
                                    ->label('Cheque')
                                    ->options([
                                        'CH-0001' => 'Cheque 0001',
                                        'CH-0002' => 'Cheque 0002',
                                    ]),
                            ])
                            ->columns(2),
                    ]),
            ])
                ->statePath('modalData')
                ->submitAction(
                    Action::make('guardarEgreso')
                        ->label('Guardar')
                        ->action(fn () => $this->guardarEgreso())
                ),
        ];
    }
}
