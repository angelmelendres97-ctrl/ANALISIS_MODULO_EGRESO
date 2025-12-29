<?php

namespace App\Filament\Pages;

use App\Models\SolicitudPago;
use App\Filament\Pages\RegistrarEgreso;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class RegistroEgresos extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Egresos';

    protected static ?string $navigationLabel = 'Registro de egresos';

    protected static ?string $title = 'Registro de egresos';

    protected static ?string $slug = 'registro-egresos';

    protected static string $view = 'filament.pages.registro-egresos';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SolicitudPago::query()->where('estado', 'APROBADA')
            )
            ->defaultSort('aprobada_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Solicitud')
                    ->sortable(),
                Tables\Columns\TextColumn::make('creador.name')
                    ->label('Creado por')
                    ->sortable(),
                Tables\Columns\TextColumn::make('motivo')
                    ->label('Motivo')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto_aprobado')
                    ->label('Monto aprobado')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('aprobada_at')
                    ->label('Aprobada')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('registrarEgreso')
                    ->label('Registrar egreso')
                    ->icon('heroicon-o-document-text')
                    ->color('primary')
                    ->url(fn(SolicitudPago $record) => RegistrarEgreso::getUrl([
                        'record' => $record,
                    ]))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([]);
    }
}
