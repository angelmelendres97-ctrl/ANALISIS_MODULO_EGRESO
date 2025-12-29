<?php

namespace App\Filament\Resources\EgresoSolicitudPagoResource\Pages;

use App\Filament\Resources\EgresoSolicitudPagoResource;
use App\Filament\Resources\SolicitudPagoResource;
use App\Models\SolicitudPago;
use App\Models\SolicitudPagoDetalle;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class RegistrarEgreso extends Page implements HasTable
{
    use InteractsWithRecord;
    use InteractsWithTable;

    protected static string $resource = EgresoSolicitudPagoResource::class;

    protected static string $view = 'filament.resources.egreso-solicitud-pago-resource.pages.registrar-egreso';

    protected static ?string $title = 'Registrar egreso';

    protected static bool $shouldRegisterNavigation = false;

    public array $facturasByProvider = [];

    public array $providerContexts = [];

    public array $providerLabels = [];

    public array $directorioEntries = [];

    public array $diarioEntries = [];

    public array $generacionData = [];

    public bool $egresoRegistrado = false;

    protected array $catalogCache = [];

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->hydrateProviderData();
    }

    public function getSolicitudProperty(): SolicitudPago
    {
        return $this->record;
    }

    protected function hydrateProviderData(): void
    {
        $detalles = $this->record->loadMissing('detalles')->detalles;

        $this->facturasByProvider = [];
        $this->providerContexts = [];
        $this->providerLabels = [];

        foreach ($detalles->groupBy(fn(SolicitudPagoDetalle $detalle) => $this->buildProviderKey($detalle)) as $key => $items) {
            $first = $items->first();

            $this->providerContexts[$key] = [
                'conexion' => (int) ($first?->erp_conexion ?? 0),
                'empresa' => $first?->erp_empresa_id,
                'sucursal' => $first?->erp_sucursal,
            ];

            $label = trim((string) ($first?->proveedor_nombre ?? $first?->proveedor_codigo));
            $ruc = $first?->proveedor_ruc ? ' (' . $first->proveedor_ruc . ')' : '';
            $this->providerLabels[$key] = $label . $ruc;

            $this->facturasByProvider[$key] = $items
                ->map(fn(SolicitudPagoDetalle $detalle) => [
                    'numero' => $detalle->numero_factura,
                    'fecha_emision' => $detalle->fecha_emision,
                    'fecha_vencimiento' => $detalle->fecha_vencimiento,
                    'saldo' => (float) ($detalle->saldo_al_crear ?? 0),
                    'abono' => (float) ($detalle->abono_aplicado ?? 0),
                ])
                ->values()
                ->all();
        }
    }

    protected function buildProviderKey(SolicitudPagoDetalle $detalle): string
    {
        return $this->buildProviderKeyFromValues($detalle->proveedor_codigo, $detalle->proveedor_ruc);
    }

    protected function buildProviderKeyFromValues(?string $codigo, ?string $ruc): string
    {
        return trim((string) $codigo) . '|' . trim((string) $ruc);
    }

    protected function getProvidersQuery(): Builder
    {
        return SolicitudPagoDetalle::query()
            ->selectRaw('
                MIN(id) as id,
                proveedor_codigo,
                proveedor_nombre,
                proveedor_ruc,
                MIN(erp_conexion) as erp_conexion,
                MIN(erp_empresa_id) as erp_empresa_id,
                MIN(erp_sucursal) as erp_sucursal,
                SUM(COALESCE(abono_aplicado, 0)) as total_abono,
                COUNT(*) as facturas_count
            ')
            ->where('solicitud_pago_id', $this->record->getKey())
            ->groupBy('proveedor_codigo', 'proveedor_nombre', 'proveedor_ruc')
            ->orderBy('proveedor_nombre');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getProvidersQuery())
            ->paginated(false)
            ->columns([
                TextColumn::make('proveedor_nombre')
                    ->label('Proveedor')
                    ->description(function (SolicitudPagoDetalle $record): string {
                        $ruc = $record->proveedor_ruc ? 'RUC: ' . $record->proveedor_ruc : null;
                        $codigo = $record->proveedor_codigo ? 'Código: ' . $record->proveedor_codigo : null;
                        $facturas = $record->facturas_count ? $record->facturas_count . ' factura(s)' : null;
                        return collect([$codigo, $ruc, $facturas])->filter()->implode(' · ');
                    })
                    ->searchable(),
                TextColumn::make('total_abono')
                    ->label('Total a pagar')
                    ->formatStateUsing(fn($state) => '$' . number_format((float) $state, 2, '.', ','))
                    ->alignRight(),
                ViewColumn::make('facturas')
                    ->label('Facturas')
                    ->state(function (SolicitudPagoDetalle $record): array {
                        $key = $this->buildProviderKeyFromValues($record->proveedor_codigo, $record->proveedor_ruc);
                        return $this->facturasByProvider[$key] ?? [];
                    })
                    ->view('filament.tables.columns.egreso-facturas'),
            ])
            ->actions([
                Tables\Actions\Action::make('generarDirectorio')
                    ->label('Generar Directorio y Diario')
                    ->icon('heroicon-o-document-text')
                    ->modalHeading(fn(SolicitudPagoDetalle $record) => 'Generar Directorio y Diario - ' . ($record->proveedor_nombre ?? 'Proveedor'))
                    ->form(fn(SolicitudPagoDetalle $record) => $this->getDirectorioFormSchema($record))
                    ->action(function (SolicitudPagoDetalle $record, array $data): void {
                        $providerKey = $this->buildProviderKeyFromValues($record->proveedor_codigo, $record->proveedor_ruc);
                        $context = $this->resolveProviderContext($record);
                        $detalles = $this->getDetallesForProvider($record);

                        $directorio = $this->buildDirectorioEntries($detalles, $data);
                        $diario = $this->buildDiarioEntries($detalles, $context, $data);

                        $this->directorioEntries[$providerKey] = $directorio;
                        $this->diarioEntries[$providerKey] = $diario;
                        $this->generacionData[$providerKey] = $data;
                        $this->egresoRegistrado = false;

                        Notification::make()
                            ->title('Directorio y diario generados')
                            ->body('Proveedor: ' . ($record->proveedor_nombre ?? 'N/D'))
                            ->success()
                            ->send();
                    })
                    ->modalSubmitActionLabel('Generar'),
            ]);
    }

    protected function getDirectorioFormSchema(SolicitudPagoDetalle $record): array
    {
        $context = $this->resolveProviderContext($record);
        $monedas = $this->getMonedasOptions($context);
        $formatos = $this->getFormatosOptions($context);
        $cuentas = $this->getCuentasBancariasOptions($context);
        $cuentasContables = $this->getCuentasContablesOptions($context);

        $monedaBase = $this->getMonedaBase($context);
        $cotizacionExterna = $this->getCotizacionExterna($context);

        return [
            Wizard::make([
                Step::make('Datos contables')
                    ->schema([
                        Select::make('moneda')
                            ->label('Moneda')
                            ->options($monedas)
                            ->searchable()
                            ->required()
                            ->default($monedaBase),
                        Select::make('formato')
                            ->label('Formato')
                            ->options($formatos)
                            ->searchable()
                            ->required(),
                        Textarea::make('detalle')
                            ->label('Detalle')
                            ->rows(2)
                            ->default('Egreso de solicitud #' . $this->record->getKey())
                            ->required(),
                        TextInput::make('cotizacion')
                            ->label('Cotización')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        TextInput::make('cotizacion_externa')
                            ->label('Cotización externa')
                            ->numeric()
                            ->default($cotizacionExterna)
                            ->required(),
                    ])
                    ->columns(2),
                Step::make('Opciones de pago')
                    ->schema([
                        Select::make('cuenta_bancaria')
                            ->label('Cuenta bancaria')
                            ->options($cuentas)
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) use ($context): void {
                                $info = $this->getCuentaBancariaInfo($context, $state);
                                if ($info) {
                                    $set('numero_cheque', $info['numero_cheque']);
                                    $set('formato_cheque', $info['formato_cheque']);
                                    $set('cuenta_contable', $info['cuenta_contable']);
                                }
                            }),
                        TextInput::make('numero_cheque')
                            ->label('N° cheque')
                            ->maxLength(50)
                            ->required(),
                        Select::make('formato_cheque')
                            ->label('Formato cheque')
                            ->options($formatos)
                            ->searchable()
                            ->required(),
                        DatePicker::make('fecha_cheque')
                            ->label('Fecha de cheque')
                            ->default(Carbon::now())
                            ->required(),
                        Select::make('cuenta_contable')
                            ->label('Cuenta contable')
                            ->options($cuentasContables)
                            ->searchable()
                            ->required(),
                    ])
                    ->columns(2),
            ])
                ->skippable(false),
        ];
    }

    protected function resolveProviderContext(SolicitudPagoDetalle $record): array
    {
        $key = $this->buildProviderKeyFromValues($record->proveedor_codigo, $record->proveedor_ruc);

        return $this->providerContexts[$key] ?? [
            'conexion' => (int) ($record->erp_conexion ?? 0),
            'empresa' => $record->erp_empresa_id,
            'sucursal' => $record->erp_sucursal,
        ];
    }

    protected function getCatalogCacheKey(array $context, string $type): string
    {
        return implode('|', [
            $type,
            $context['conexion'] ?? '0',
            $context['empresa'] ?? '0',
            $context['sucursal'] ?? '0',
        ]);
    }

    protected function getExternalConnection(array $context): ?string
    {
        $conexionId = (int) ($context['conexion'] ?? 0);

        if (! $conexionId) {
            return null;
        }

        return SolicitudPagoResource::getExternalConnectionName($conexionId);
    }

    protected function getDetallesForProvider(SolicitudPagoDetalle $record): \Illuminate\Support\Collection
    {
        return $this->record->detalles
            ->filter(fn(SolicitudPagoDetalle $detalle) => $detalle->proveedor_codigo === $record->proveedor_codigo);
    }

    /**
     * @param \Illuminate\Support\Collection<int, SolicitudPagoDetalle> $detalles
     * @return array<int, array<string, mixed>>
     */
    protected function buildDirectorioEntries(\Illuminate\Support\Collection $detalles, array $data): array
    {
        return $detalles->map(function (SolicitudPagoDetalle $detalle) use ($data) {
            $abono = (float) ($detalle->abono_aplicado ?? 0);
            $saldo = (float) ($detalle->saldo_al_crear ?? 0);
            $valor = $abono > 0 ? $abono : $saldo;

            return [
                'factura' => $detalle->numero_factura,
                'fecha_vencimiento' => $detalle->fecha_vencimiento,
                'detalle' => $data['detalle'] ?? 'Egreso de solicitud',
                'debito' => $valor,
                'credito' => 0.0,
            ];
        })->values()->all();
    }

    /**
     * @param \Illuminate\Support\Collection<int, SolicitudPagoDetalle> $detalles
     * @return array<int, array<string, mixed>>
     */
    protected function buildDiarioEntries(\Illuminate\Support\Collection $detalles, array $context, array $data): array
    {
        $total = $detalles->sum(function (SolicitudPagoDetalle $detalle): float {
            $abono = (float) ($detalle->abono_aplicado ?? 0);
            $saldo = (float) ($detalle->saldo_al_crear ?? 0);
            return $abono > 0 ? $abono : $saldo;
        });

        $proveedorCuenta = $this->getProveedorCuentaContable($context, $detalles->first()?->proveedor_codigo);
        $cuentaPago = $data['cuenta_contable'] ?? null;

        return [
            [
                'cuenta' => $proveedorCuenta['codigo'] ?? 'N/D',
                'descripcion' => $proveedorCuenta['nombre'] ?? 'Cuenta proveedor',
                'debito' => $total,
                'credito' => 0.0,
            ],
            [
                'cuenta' => $cuentaPago ?? 'N/D',
                'descripcion' => $this->getCuentaNombre($context, $cuentaPago) ?? 'Cuenta de pago',
                'debito' => 0.0,
                'credito' => $total,
                'cheque' => $data['numero_cheque'] ?? null,
                'fecha_cheque' => $data['fecha_cheque'] ?? null,
            ],
        ];
    }

    protected function getMonedasOptions(array $context): array
    {
        $cacheKey = $this->getCatalogCacheKey($context, 'monedas');

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = [];
        }

        try {
            $options = DB::connection($connection)
                ->table('saemone')
                ->where('mone_cod_empr', $empresa)
                ->pluck('mone_des_mone', 'mone_cod_mone')
                ->all();
        } catch (\Throwable $e) {
            $options = [];
        }

        return $this->catalogCache[$cacheKey] = $options;
    }

    protected function getFormatosOptions(array $context): array
    {
        $cacheKey = $this->getCatalogCacheKey($context, 'formatos');

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = [];
        }

        try {
            $options = DB::connection($connection)
                ->table('saeftrn')
                ->where('ftrn_cod_empr', $empresa)
                ->where('ftrn_cod_modu', 5)
                ->where('ftrn_tip_movi', 'EG')
                ->pluck('ftrn_des_ftrn', 'ftrn_cod_ftrn')
                ->all();
        } catch (\Throwable $e) {
            $options = [];
        }

        return $this->catalogCache[$cacheKey] = $options;
    }

    protected function getCuentasBancariasOptions(array $context): array
    {
        $cacheKey = $this->getCatalogCacheKey($context, 'cuentas-bancarias');

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = [];
        }

        try {
            $rows = DB::connection($connection)
                ->table('saectab')
                ->join('saebanc', function ($join) {
                    $join->on('banc_cod_empr', '=', 'ctab_cod_empr')
                        ->on('banc_cod_banc', '=', 'ctab_cod_banc');
                })
                ->where('ctab_cod_empr', $empresa)
                ->where('ctab_tip_ctab', 'C')
                ->select([
                    'ctab_cod_ctab',
                    'ctab_cod_cuen',
                    'banc_nom_banc',
                    'ctab_num_ctab',
                ])
                ->orderBy('banc_nom_banc')
                ->get();

            $options = $rows
                ->mapWithKeys(fn($row) => [
                    $row->ctab_cod_ctab => $row->ctab_cod_cuen . ' - ' . $row->banc_nom_banc . ' - ' . $row->ctab_num_ctab,
                ])
                ->all();
        } catch (\Throwable $e) {
            $options = [];
        }

        return $this->catalogCache[$cacheKey] = $options;
    }

    protected function getCuentasContablesOptions(array $context): array
    {
        $cacheKey = $this->getCatalogCacheKey($context, 'cuentas-contables');

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = [];
        }

        try {
            $options = DB::connection($connection)
                ->table('saecuen')
                ->where('cuen_cod_empr', $empresa)
                ->pluck('cuen_nom_cuen', 'cuen_cod_cuen')
                ->all();
        } catch (\Throwable $e) {
            $options = [];
        }

        return $this->catalogCache[$cacheKey] = $options;
    }

    protected function getCuentaBancariaInfo(array $context, $cta): ?array
    {
        if (! $cta) {
            return null;
        }

        $cacheKey = $this->getCatalogCacheKey($context, 'cuenta-info-' . $cta);

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = null;
        }

        try {
            $row = DB::connection($connection)
                ->table('saectab')
                ->where('ctab_cod_empr', $empresa)
                ->where('ctab_cod_ctab', $cta)
                ->select(['ctab_num_cheq', 'ctab_for_cheq', 'ctab_cod_cuen'])
                ->first();

            if (! $row) {
                return $this->catalogCache[$cacheKey] = null;
            }

            return $this->catalogCache[$cacheKey] = [
                'numero_cheque' => (string) $row->ctab_num_cheq,
                'formato_cheque' => $row->ctab_for_cheq,
                'cuenta_contable' => $row->ctab_cod_cuen,
            ];
        } catch (\Throwable $e) {
            return $this->catalogCache[$cacheKey] = null;
        }
    }

    protected function getMonedaBase(array $context): ?string
    {
        $cacheKey = $this->getCatalogCacheKey($context, 'moneda-base');

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = null;
        }

        try {
            $moneda = DB::connection($connection)
                ->table('saepcon')
                ->where('pcon_cod_empr', $empresa)
                ->value('pcon_mon_base');
        } catch (\Throwable $e) {
            $moneda = null;
        }

        return $this->catalogCache[$cacheKey] = $moneda;
    }

    protected function getCotizacionExterna(array $context): float
    {
        $cacheKey = $this->getCatalogCacheKey($context, 'cotizacion-externa');

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = 1.0;
        }

        try {
            $monedaExtra = DB::connection($connection)
                ->table('saepcon')
                ->where('pcon_cod_empr', $empresa)
                ->value('pcon_seg_mone');

            if (! $monedaExtra) {
                return $this->catalogCache[$cacheKey] = 1.0;
            }

            $cotizacion = DB::connection($connection)
                ->table('saetcam')
                ->where('mone_cod_empr', $empresa)
                ->where('tcam_cod_mone', $monedaExtra)
                ->orderByDesc('tcam_fec_tcam')
                ->value('tcam_val_tcam');
        } catch (\Throwable $e) {
            $cotizacion = null;
        }

        return $this->catalogCache[$cacheKey] = (float) ($cotizacion ?? 1.0);
    }

    protected function getProveedorCuentaContable(array $context, ?string $proveedorCodigo): array
    {
        if (! $proveedorCodigo) {
            return [];
        }

        $cacheKey = $this->getCatalogCacheKey($context, 'proveedor-cuenta-' . $proveedorCodigo);

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = [];
        }

        try {
            $cuenta = DB::connection($connection)
                ->table('saeclpv')
                ->where('clpv_cod_empr', $empresa)
                ->where('clpv_cod_clpv', $proveedorCodigo)
                ->value('clpv_cod_cuen');

            if (! $cuenta) {
                return $this->catalogCache[$cacheKey] = [];
            }

            $nombre = $this->getCuentaNombre($context, $cuenta);

            return $this->catalogCache[$cacheKey] = [
                'codigo' => $cuenta,
                'nombre' => $nombre ?? '',
            ];
        } catch (\Throwable $e) {
            return $this->catalogCache[$cacheKey] = [];
        }
    }

    protected function getCuentaNombre(array $context, ?string $cuenta): ?string
    {
        if (! $cuenta) {
            return null;
        }

        $cacheKey = $this->getCatalogCacheKey($context, 'cuenta-nombre-' . $cuenta);

        if (array_key_exists($cacheKey, $this->catalogCache)) {
            return $this->catalogCache[$cacheKey];
        }

        $connection = $this->getExternalConnection($context);
        $empresa = $context['empresa'] ?? null;

        if (! $connection || ! $empresa) {
            return $this->catalogCache[$cacheKey] = null;
        }

        try {
            $nombre = DB::connection($connection)
                ->table('saecuen')
                ->where('cuen_cod_empr', $empresa)
                ->where('cuen_cod_cuen', $cuenta)
                ->value('cuen_nom_cuen');
        } catch (\Throwable $e) {
            $nombre = null;
        }

        return $this->catalogCache[$cacheKey] = $nombre;
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('volver')
                ->label('Volver al listado')
                ->color('gray')
                ->icon('heroicon-o-arrow-left')
                ->url(EgresoSolicitudPagoResource::getUrl()),
        ];
    }

    public function registrarEgresoFinal(): void
    {
        if (! $this->canRegistrarEgreso()) {
            Notification::make()
                ->title('El diario no está balanceado o faltan datos.')
                ->warning()
                ->send();

            return;
        }

        $this->egresoRegistrado = true;

        Notification::make()
            ->title('Egreso listo para registrar')
            ->body('Los valores se balancearon correctamente.')
            ->success()
            ->send();
    }

    public function canRegistrarEgreso(): bool
    {
        if (empty($this->directorioEntries) || empty($this->diarioEntries)) {
            return false;
        }

        foreach ($this->directorioEntries as $key => $entries) {
            if (empty($entries) || empty($this->diarioEntries[$key] ?? [])) {
                return false;
            }

            if (abs($this->getDiarioBalanceForProvider($key)) > 0.01) {
                return false;
            }
        }

        return true;
    }

    public function getDiarioBalanceForProvider(string $providerKey): float
    {
        $entries = $this->diarioEntries[$providerKey] ?? [];

        $debitos = collect($entries)->sum(fn(array $line) => (float) ($line['debito'] ?? 0));
        $creditos = collect($entries)->sum(fn(array $line) => (float) ($line['credito'] ?? 0));

        return $debitos - $creditos;
    }

    public function getTotalAbonoProperty(): float
    {
        return (float) ($this->record->detalles?->sum('abono_aplicado') ?? 0);
    }

    public function getTotalFacturasProperty(): int
    {
        return (int) ($this->record->detalles?->count() ?? 0);
    }

    public function getTotalSaldoProperty(): float
    {
        return (float) ($this->record->detalles?->sum('saldo_al_crear') ?? 0);
    }

    public function getTotalAbonoHtmlProperty(): HtmlString
    {
        return new HtmlString('$' . number_format($this->totalAbono, 2, '.', ','));
    }
}
