<?php

namespace App\Filament\Resources\OrdenCompraResource\Pages;

use App\Filament\Resources\OrdenCompraResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use App\Models\PedidoCompra;
use Illuminate\Support\Facades\Log;

class EditOrdenCompra extends EditRecord
{
    protected static string $resource = OrdenCompraResource::class;

    protected function getListeners(): array
    {
        return [
            'pedidos_seleccionados' => 'onPedidosSeleccionados',
        ];
    }

    public function onPedidosSeleccionados($pedidos, $connectionId, $motivo)
    {

        Log::info('Evento pedidos_seleccionados recibido', ['pedidos' => $pedidos, 'connectionId' => $connectionId, 'motivo' => $motivo]);

        if (empty($pedidos) || !$connectionId) {
            return;
        }

        // Mostrar los códigos de los pedidos importados
        $this->data['pedidos_importados'] = implode(', ', $pedidos);
    
        $connectionName = OrdenCompraResource::getExternalConnectionName($connectionId);
        if (!$connectionName) {
            return;
        }
    
        // Cargar motivo del primer pedido
        $this->data['uso_compra'] = $motivo;
    
        // Cargar detalles de todos los pedidos
        $detalles = DB::connection($connectionName)
            ->table('saedped')
            ->whereIn('dped_cod_pedi', $pedidos)
            ->get();
    
        if ($detalles->isNotEmpty()) {
            $firstBodega = $detalles->first()->dped_cod_bode;
            $this->data['bodega'] = $firstBodega;
    
            $repeaterItems = $detalles->map(function ($detalle) use ($connectionName) {
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
                    // Asumiendo que 'bodega' es el nombre, si necesitas el id, ya lo tienes en $this->data['bodega']
                    'bodega' => $this->data['bodega'] 
                ];
            })->values()->toArray();
    
            // Asignar al repeater
            $this->data['detalles'] = $repeaterItems;
        }

        $this->dispatch('close-modal', id: 'filtrar-pedidos');
    }
}