<?php

namespace App\Filament\Resources\OrdenCompraResource\Pages;

use App\Filament\Resources\OrdenCompraResource;
use App\Services\OrdenCompraSyncService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateOrdenCompra extends CreateRecord
{
    protected static string $resource = OrdenCompraResource::class;

    protected function getListeners(): array
    {
        return [
            'pedidos_seleccionados' => 'onPedidosSeleccionados',
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $record = static::getModel()::create($data);

            OrdenCompraSyncService::sincronizar($record, $this->data);

            return $record;
        });
    }

    public function onPedidosSeleccionados($pedidos, $connectionId, $motivo)
    {

        Log::info('Evento pedidos_seleccionados recibido', ['pedidos' => $pedidos, 'connectionId' => $connectionId, 'motivo' => $motivo]);

        if (empty($pedidos) || !$connectionId) {
            return;
        }

        $this->data['pedidos_importados'] = implode(', ', array_map(
            fn($pedi) => str_pad($pedi, 8, "0", STR_PAD_LEFT),
            $pedidos
        ));

        $connectionName = OrdenCompraResource::getExternalConnectionName($connectionId);
        if (!$connectionName) {
            return;
        }

        $this->data['uso_compra'] = $motivo;

        $detalles = DB::connection($connectionName)
            ->table('saedped')
            ->whereIn('dped_cod_pedi', $pedidos)
            ->get();

        // Agrupar por producto y sumar cantidades
        $detallesAgrupados = $detalles->groupBy('dped_cod_prod')->map(function ($group) {
            $first = $group->first();
            return (object) [
                'dped_cod_prod' => $first->dped_cod_prod,
                'dped_can_ped' => $group->sum('dped_can_ped'),
                'dped_cod_bode' => $first->dped_cod_bode,
            ];
        });


        if ($detallesAgrupados->isNotEmpty()) {
            $firstBodega = $detallesAgrupados->first()->dped_cod_bode;
            $this->data['bodega'] = $firstBodega;

            $repeaterItems = $detallesAgrupados->map(function ($detalle) use ($connectionName) {
                $productData = DB::connection($connectionName)
                    ->table('saeprod')
                    ->join('saeprbo', 'prbo_cod_prod', '=', 'prod_cod_prod')
                    ->where('prod_cod_empr', $this->data['amdg_id_empresa'])
                    ->where('prod_cod_sucu', $this->data['amdg_id_sucursal'])
                    ->where('prbo_cod_empr', $this->data['amdg_id_empresa'])
                    ->where('prbo_cod_sucu', $this->data['amdg_id_sucursal'])
                    ->where('prbo_cod_bode', $this->data['bodega'])
                    ->where('prod_cod_prod', $detalle->dped_cod_prod)
                    ->select('prbo_uco_prod', 'prbo_iva_porc', 'prod_nom_prod')
                    ->first();

                $costo = 0;
                $impuesto = 0;
                $productoNombre = '';

                if ($productData) {
                    $costo = number_format($productData->prbo_uco_prod, 6, '.', '');
                    $impuesto = round($productData->prbo_iva_porc, 2);
                    $productoNombre = $productData->prod_nom_prod . ' (' . $detalle->dped_cod_prod . ')';
                }

                return [
                    'codigo_producto' => $detalle->dped_cod_prod,
                    'producto' => $productoNombre,
                    'cantidad' => $detalle->dped_can_ped,
                    'costo' => $costo,
                    'descuento' => 0,
                    'impuesto' => $impuesto,
                    'id_bodega' => $this->data['bodega'],
                    'bodega' => $this->data['bodega']
                ];
            })->values()->toArray();

            $this->data['detalles'] = $repeaterItems;

            // Force recalculation of totals
            $subtotalGeneral = 0;
            $descuentoGeneral = 0;
            $impuestoGeneral = 0;

            foreach ($repeaterItems as $detalle) {
                $cantidad = floatval($detalle['cantidad'] ?? 0);
                $costo = floatval($detalle['costo'] ?? 0);
                $descuento = floatval($detalle['descuento'] ?? 0);
                $porcentajeIva = floatval($detalle['impuesto'] ?? 0);
                $subtotalItem = $cantidad * $costo;
                $valorIva = $subtotalItem * ($porcentajeIva / 100);
                $subtotalGeneral += $subtotalItem;
                $descuentoGeneral += $descuento;
                $impuestoGeneral += $valorIva;
            }

            $totalGeneral = ($subtotalGeneral - $descuentoGeneral) + $impuestoGeneral;

            $this->data['subtotal'] = number_format($subtotalGeneral, 2, '.', '');
            $this->data['total_descuento'] = number_format($descuentoGeneral, 2, '.', '');
            $this->data['total_impuesto'] = number_format($impuestoGeneral, 2, '.', '');
            $this->data['total'] = number_format($totalGeneral, 2, '.', '');
        }
        $this->dispatch('close-modal', id: 'filtrar-pedidos');
    }
}
