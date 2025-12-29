<?php

namespace App\Filament\Pages;

use App\Filament\Resources\SolicitudPagoResource;
use App\Models\Empresa;
use App\Models\SolicitudPago;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RegistrarEgreso extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.registro-egreso';

    protected static ?string $title = 'Registro de egreso';

    public ?SolicitudPago $solicitud = null;

    public array $proveedores = [];

    public array $openProviders = [];

    public bool $showGeneracionModal = false;

    public bool $pagoTabEnabled = false;

    public array $egresoForm = [];

    public ?string $activeProviderKey = null;

    public array $activeProviderContext = [];

    public function mount(): void
    {
        $recordId = request()->integer('record');

        if ($recordId) {
            $this->solicitud = SolicitudPago::with(['detalles', 'aprobador', 'creador'])->find($recordId);
        }

        if (! $this->solicitud || strtoupper((string) $this->solicitud->estado) !== 'APROBADA') {
            Notification::make()
                ->title('La solicitud de pago no está aprobada o no existe.')
                ->warning()
                ->send();

            $this->redirect(SolicitudPagoResource::getUrl());

            return;
        }

        $this->proveedores = $this->buildFacturasDesdeSolicitud($this->solicitud);
        $this->openProviders = [];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('egresoForm')
            ->schema([
                Section::make('Generación contable')
                    ->schema([
                        Tabs::make('configuracion_egreso')
                            ->tabs([
                                Tab::make('Datos contables')
                                    ->schema([
                                        Select::make('moneda')
                                            ->label('Moneda')
                                            ->options(fn() => $this->getMonedasOptions())
                                            ->searchable()
                                            ->required(),
                                        Select::make('formato')
                                            ->label('Formato')
                                            ->options(fn() => $this->getFormatosOptions())
                                            ->searchable()
                                            ->required(),
                                        Textarea::make('detalle')
                                            ->label('Detalle')
                                            ->rows(2)
                                            ->required(),
                                        TextInput::make('cotizacion')
                                            ->label('Cotización')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('cotizacion_ext')
                                            ->label('Cotización externa')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Tab::make('Opciones de pago')
                                    ->disabled(fn() => ! $this->pagoTabEnabled)
                                    ->schema([
                                        Select::make('cuenta_bancaria')
                                            ->label('Cuenta bancaria')
                                            ->options(fn() => $this->getCuentasBancariasOptions())
                                            ->searchable(),
                                        TextInput::make('numero_cheque')
                                            ->label('Número de cheque')
                                            ->maxLength(50),
                                        Select::make('formato_cheque')
                                            ->label('Formato de cheque')
                                            ->options(fn() => $this->getFormatosOptions())
                                            ->searchable(),
                                        DatePicker::make('fecha_cheque')
                                            ->label('Fecha de cheque')
                                            ->default(Carbon::now()),
                                    ])
                                    ->columns(2),
                            ]),
                    ]),
            ]);
    }

    public function toggleProvider(string $providerKey): void
    {
        $current = $this->openProviders[$providerKey] ?? false;
        $this->openProviders[$providerKey] = ! $current;
    }

    public function openGeneracionModal(string $providerKey): void
    {
        $this->activeProviderKey = $providerKey;
        $this->activeProviderContext = $this->resolveProviderContext($providerKey);
        $this->pagoTabEnabled = false;

        $defaults = $this->buildDefaultFormState();
        $this->form->fill($defaults);

        $this->showGeneracionModal = true;
    }

    public function closeGeneracionModal(): void
    {
        $this->showGeneracionModal = false;
    }

    public function habilitarPago(): void
    {
        $this->validate([
            'egresoForm.moneda' => ['required', 'string'],
            'egresoForm.formato' => ['required', 'string'],
            'egresoForm.detalle' => ['required', 'string', 'max:255'],
            'egresoForm.cotizacion' => ['required', 'numeric', 'min:0'],
            'egresoForm.cotizacion_ext' => ['nullable', 'numeric', 'min:0'],
        ]);

        $this->pagoTabEnabled = true;
    }

    public function generarDirectorioDiario(): void
    {
        $this->validate([
            'egresoForm.cuenta_bancaria' => ['required', 'string'],
            'egresoForm.numero_cheque' => ['required', 'string', 'max:50'],
            'egresoForm.formato_cheque' => ['required', 'string'],
            'egresoForm.fecha_cheque' => ['required', 'date'],
        ]);

        Notification::make()
            ->title('Datos de egreso listos para procesar.')
            ->success()
            ->send();

        $this->showGeneracionModal = false;
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

            if (! isset($conexionNombres[$conexionId])) {
                $conexionNombres[$conexionId] = Empresa::query()
                    ->where('id', $conexionId)
                    ->value('nombre_empresa') ?? (string) $conexionId;
            }

            if (! isset($empresaOptionsCache[$conexionId])) {
                $empresaOptionsCache[$conexionId] = SolicitudPagoResource::getEmpresasOptions($conexionId);
            }

            if (! isset($sucursalOptionsCache[$conexionId][$empresaCodigo])) {
                $sucursalOptionsCache[$conexionId][$empresaCodigo] = SolicitudPagoResource::getSucursalesOptions(
                    $conexionId,
                    array_filter([$empresaCodigo]),
                );
            }

            $registros->push([
                'conexion_id' => $conexionId,
                'conexion_nombre' => $conexionNombres[$conexionId],
                'empresa_codigo' => $empresaCodigo,
                'empresa_nombre' => $empresaOptionsCache[$conexionId][$empresaCodigo] ?? $empresaCodigo,
                'sucursal_codigo' => $sucursalCodigo,
                'sucursal_nombre' => $sucursalOptionsCache[$conexionId][$empresaCodigo][$sucursalCodigo] ?? $sucursalCodigo,
                'proveedor_codigo' => $detalle->proveedor_codigo ?? '',
                'proveedor_nombre' => $detalle->proveedor_nombre ?? ($detalle->proveedor_codigo ?? ''),
                'proveedor_ruc' => $detalle->proveedor_ruc,
                'numero' => $detalle->numero_factura ?? '',
                'fecha_emision' => $detalle->fecha_emision,
                'fecha_vencimiento' => $detalle->fecha_vencimiento,
                'monto' => (float) ($detalle->monto_factura ?? 0),
                'abono' => (float) ($detalle->abono_aplicado ?? 0),
            ]);
        }

        return $this->groupByProveedor($registros);
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

    protected function buildFacturaKey(?string $conexion, ?string $empresa, ?string $sucursal, ?string $proveedor, ?string $numero, ?string $ruc = null): string
    {
        $raw = trim(($conexion ?? '') . '|' . ($empresa ?? '') . '|' . ($sucursal ?? '') . '|' . ($proveedor ?? '') . '|' . ($numero ?? '') . '|' . ($ruc ?? ''));

        return hash('sha256', $raw);
    }

    protected function groupByProveedor($registros): array
    {
        $agrupado = [];

        foreach ($registros as $row) {
            $proveedorKey = $this->buildProveedorKey(
                $row['proveedor_codigo'] ?? '',
                $row['proveedor_ruc'] ?? '',
                $row['proveedor_nombre'] ?? ''
            );

            $empresaKey = ($row['conexion_id'] ?? '') . '|' . ($row['empresa_codigo'] ?? '');
            $sucursalKey = $empresaKey . '|' . ($row['sucursal_codigo'] ?? '');

            if (! isset($agrupado[$proveedorKey])) {
                $agrupado[$proveedorKey] = [
                    'key' => $proveedorKey,
                    'proveedor_codigo' => $row['proveedor_codigo'] ?? null,
                    'proveedor_nombre' => $row['proveedor_nombre'] ?? null,
                    'proveedor_ruc' => $row['proveedor_ruc'] ?? null,
                    'total_abono' => 0,
                    'total_facturas' => 0,
                    'facturas_count' => 0,
                    'empresas' => [],
                ];
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
                'monto' => (float) ($row['monto'] ?? 0),
                'abono' => (float) ($row['abono'] ?? 0),
                'empresa_codigo' => $row['empresa_codigo'] ?? null,
                'empresa_nombre' => $row['empresa_nombre'] ?? null,
                'sucursal_codigo' => $row['sucursal_codigo'] ?? null,
                'sucursal_nombre' => $row['sucursal_nombre'] ?? null,
                'conexion_id' => $row['conexion_id'] ?? null,
                'conexion_nombre' => $row['conexion_nombre'] ?? null,
            ];

            $agrupado[$proveedorKey]['total_abono'] += (float) ($row['abono'] ?? 0);
            $agrupado[$proveedorKey]['total_facturas'] += (float) ($row['monto'] ?? 0);
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

    protected function resolveProviderContext(string $providerKey): array
    {
        $proveedor = collect($this->proveedores)->firstWhere('key', $providerKey);

        if (! $proveedor) {
            return [];
        }

        $empresa = $proveedor['empresas'][0] ?? [];
        $sucursal = $empresa['sucursales'][0] ?? [];

        return [
            'conexion_id' => $empresa['conexion_id'] ?? null,
            'empresa_codigo' => $empresa['empresa_codigo'] ?? null,
            'sucursal_codigo' => $sucursal['sucursal_codigo'] ?? null,
            'proveedor_nombre' => $proveedor['proveedor_nombre'] ?? null,
            'proveedor_ruc' => $proveedor['proveedor_ruc'] ?? null,
        ];
    }

    protected function buildDefaultFormState(): array
    {
        $context = $this->activeProviderContext;
        $conexionId = (int) ($context['conexion_id'] ?? 0);
        $empresaCodigo = (string) ($context['empresa_codigo'] ?? '');

        $defaults = [
            'moneda' => null,
            'formato' => null,
            'detalle' => $this->solicitud?->motivo ?? '',
            'cotizacion' => 1,
            'cotizacion_ext' => null,
            'cuenta_bancaria' => null,
            'numero_cheque' => null,
            'formato_cheque' => null,
            'fecha_cheque' => Carbon::now()->toDateString(),
        ];

        if (! $conexionId || $empresaCodigo === '') {
            return $defaults;
        }

        $connectionName = SolicitudPagoResource::getExternalConnectionName($conexionId);
        if (! $connectionName) {
            return $defaults;
        }

        $pcon = DB::connection($connectionName)
            ->table('saepcon')
            ->where('pcon_cod_empr', $empresaCodigo)
            ->select('pcon_mon_base', 'pcon_seg_mone')
            ->first();

        $defaults['moneda'] = $pcon?->pcon_mon_base;

        $monedaSecundaria = $pcon?->pcon_seg_mone;
        if ($monedaSecundaria) {
            $cotizacionExt = DB::connection($connectionName)
                ->table('saetcam')
                ->where('mone_cod_empr', $empresaCodigo)
                ->where('tcam_cod_mone', $monedaSecundaria)
                ->orderByDesc('tcam_fec_tcam')
                ->value('tcam_val_tcam');

            $defaults['cotizacion_ext'] = $cotizacionExt;
        }

        $formatos = $this->getFormatosOptions();
        $defaults['formato'] = array_key_first($formatos);
        $defaults['formato_cheque'] = array_key_first($formatos);

        return $defaults;
    }

    protected function getMonedasOptions(): array
    {
        $context = $this->activeProviderContext;
        $conexionId = (int) ($context['conexion_id'] ?? 0);
        $empresaCodigo = (string) ($context['empresa_codigo'] ?? '');

        if (! $conexionId || $empresaCodigo === '') {
            return [];
        }

        $connectionName = SolicitudPagoResource::getExternalConnectionName($conexionId);
        if (! $connectionName) {
            return [];
        }

        return DB::connection($connectionName)
            ->table('saemone')
            ->where('mone_cod_empr', $empresaCodigo)
            ->orderBy('mone_cod_mone')
            ->pluck('mone_des_mone', 'mone_cod_mone')
            ->all();
    }

    protected function getFormatosOptions(): array
    {
        $context = $this->activeProviderContext;
        $conexionId = (int) ($context['conexion_id'] ?? 0);
        $empresaCodigo = (string) ($context['empresa_codigo'] ?? '');

        if (! $conexionId || $empresaCodigo === '') {
            return [];
        }

        $connectionName = SolicitudPagoResource::getExternalConnectionName($conexionId);
        if (! $connectionName) {
            return [];
        }

        return DB::connection($connectionName)
            ->table('saeftrn')
            ->where('ftrn_cod_empr', $empresaCodigo)
            ->where('ftrn_cod_modu', 5)
            ->where('ftrn_tip_movi', 'EG')
            ->orderBy('ftrn_cod_ftrn')
            ->pluck('ftrn_des_ftrn', 'ftrn_cod_ftrn')
            ->all();
    }

    protected function getCuentasBancariasOptions(): array
    {
        $context = $this->activeProviderContext;
        $conexionId = (int) ($context['conexion_id'] ?? 0);
        $empresaCodigo = (string) ($context['empresa_codigo'] ?? '');

        if (! $conexionId || $empresaCodigo === '') {
            return [];
        }

        $connectionName = SolicitudPagoResource::getExternalConnectionName($conexionId);
        if (! $connectionName) {
            return [];
        }

        return DB::connection($connectionName)
            ->table('saectab')
            ->join('saebanc', function ($join) {
                $join->on('saebanc.banc_cod_banc', '=', 'saectab.ctab_cod_banc')
                    ->on('saebanc.banc_cod_empr', '=', 'saectab.ctab_cod_empr');
            })
            ->where('saectab.ctab_cod_empr', $empresaCodigo)
            ->where('saectab.ctab_tip_ctab', 'C')
            ->orderBy('saectab.ctab_cod_ctab')
            ->get([
                'saectab.ctab_cod_ctab',
                'saectab.ctab_cod_cuen',
                'saebanc.banc_nom_banc',
                'saectab.ctab_num_ctab',
            ])
            ->mapWithKeys(function ($row) {
                $label = "{$row->ctab_cod_cuen} - {$row->banc_nom_banc} - {$row->ctab_num_ctab}";
                return [(string) $row->ctab_cod_ctab => $label];
            })
            ->all();
    }
}
