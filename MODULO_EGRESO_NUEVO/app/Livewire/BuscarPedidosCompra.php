<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrdenCompraResource;
use App\Models\PedidoCompra;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Filament\Actions\StaticAction;

class BuscarPedidosCompra extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $id_empresa;
    public $amdg_id_empresa;
    public $amdg_id_sucursal;

    public ?array $data = [];

    private function initializeForm(): void
    {
        if (!isset($this->form)) {
            $this->form = $this->form($this->makeForm());
        }
    }

    public function mount($id_empresa, $amdg_id_empresa, $amdg_id_sucursal): void
    {
        $this->initializeForm();
        $this->id_empresa = $id_empresa;
        $this->amdg_id_empresa = $amdg_id_empresa;
        $this->amdg_id_sucursal = $amdg_id_sucursal;

        $this->form->fill([
            'fecha_desde' => now()->startOfDay(),
            'fecha_hasta' => now()->endOfDay(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\DatePicker::make('fecha_desde')
                            ->label('Fecha Desde')
                            ->live(onBlur: true),
                        Forms\Components\DatePicker::make('fecha_hasta')
                            ->label('Fecha Hasta')
                            ->live(onBlur: true),
                    ])
            ]);
    }

    protected function getTableQuery(): Builder
    {
        $this->initializeForm();
        $formData = $this->form->getState();

        if (empty($this->id_empresa) || empty($this->amdg_id_empresa) || empty($this->amdg_id_sucursal)) {
            return PedidoCompra::query()->whereRaw('1 = 0');
        }

        $connectionName = OrdenCompraResource::getExternalConnectionName($this->id_empresa);

        if (!$connectionName) {
            return PedidoCompra::query()->whereRaw('1 = 0');
        }

        $model = new PedidoCompra();
        $model->setConnection($connectionName);
        $model->setTable('saepedi');
        $model->setKeyName('pedi_cod_pedi');

        $query = $model->newQuery()
            ->where('pedi_cod_empr', $this->amdg_id_empresa)
            ->where('pedi_cod_sucu', $this->amdg_id_sucursal);

        if (!empty($formData['fecha_desde']) && !empty($formData['fecha_hasta'])) {
            $query->whereBetween('pedi_fec_pedi', [$formData['fecha_desde'], $formData['fecha_hasta']]);
        }

        return $query;
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(fn() => $this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('pedi_cod_pedi')
                    ->label('Secuencial')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(
                        fn($state, $record) =>
                        str_pad($record->pedi_cod_pedi, 8, "0", STR_PAD_LEFT)
                    ),
                Tables\Columns\TextColumn::make('pedi_res_pedi')->label('Responsable')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pedi_det_pedi')->label('Motivo')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('pedi_fec_pedi')->label('Fecha Pedido')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view_details')
                    ->label('Ver Detalle')
                    ->icon('heroicon-o-eye')
                    ->modalContent(function (Model $record) {
                        $connectionName = OrdenCompraResource::getExternalConnectionName($this->id_empresa);
                        if (!$connectionName) {
                            return view('livewire.pedido-compra-detail-view', ['details' => collect(), 'error' => 'No se puede establecer la conexión.']);
                        }
                        try {
                            $details = DB::connection($connectionName)
                                ->table('saedped')
                                ->where('dped_cod_pedi', $record->pedi_cod_pedi)
                                ->where('dped_cod_empr', $this->amdg_id_empresa)
                                ->get();
                            return view('livewire.pedido-compra-detail-view', ['details' => $details]);
                        } catch (\Exception $e) {
                            return view('livewire.pedido-compra-detail-view', ['details' => collect(), 'error' => 'Error al consultar detalles: ' . $e->getMessage()]);
                        }
                    })
                    ->modalHeading('Detalles del Pedido')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn(StaticAction $action) => $action->label('Cerrar')),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('importar')
                    ->label('Importar Pedidos')
                    ->requiresConfirmation()
                    ->action(function (Collection $records, Tables\Actions\BulkAction $action) {

                        if ($records->isEmpty()) {
                            return;
                        }

                        $motivo = $records->first()->pedi_det_pedi;

                        $this->dispatch(
                            'pedidos_seleccionados',
                            $records->pluck('pedi_cod_pedi')->toArray(),
                            $this->id_empresa,
                            $motivo
                        );

                        // 🔥 CERRAR MODAL 100% SEGURO
                        $action->cancel();
                    })
            ]);

    }

    public function getTableRecordKey(Model $record): string
    {
        return $record->pedi_cod_pedi;
    }

    public function render()
    {
        return view('livewire.buscar-pedidos-compra');
    }
}
