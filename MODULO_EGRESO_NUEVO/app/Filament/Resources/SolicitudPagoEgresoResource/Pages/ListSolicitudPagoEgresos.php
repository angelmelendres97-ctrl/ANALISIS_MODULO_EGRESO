<?php

namespace App\Filament\Resources\SolicitudPagoEgresoResource\Pages;

use App\Filament\Resources\SolicitudPagoEgresoResource;
use Filament\Resources\Pages\ListRecords;

class ListSolicitudPagoEgresos extends ListRecords
{
    protected static string $resource = SolicitudPagoEgresoResource::class;

    protected static ?string $title = 'Solicitudes de pago aprobadas';
}
