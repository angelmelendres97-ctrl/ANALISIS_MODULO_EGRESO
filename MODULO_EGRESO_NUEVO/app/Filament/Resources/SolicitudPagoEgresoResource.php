<?php

namespace App\Filament\Resources;

use App\Filament\Pages\RegistrarEgreso;
use App\Filament\Resources\SolicitudPagoEgresoResource\Pages;
use App\Models\SolicitudPago;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SolicitudPagoEgresoResource extends Resource
{
    protected static ?string $model = SolicitudPago::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Solicitudes aprobadas';

    protected static ?string $pluralModelLabel = 'Solicitudes aprobadas';

    protected static ?string $navigationGroup = 'Egresos';

    protected static ?string $slug = 'egresos/solicitudes-aprobadas';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('estado', 'APROBADA');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canView(Model $record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null)
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('empresa.nombre_empresa')
                    ->label('Conexión')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('creadoPor.name')
                    ->label('Creado por')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                TextColumn::make('motivo')
                    ->label('Motivo')
                    ->limit(40),
                TextColumn::make('monto_aprobado')
                    ->money('USD')
                    ->label('Monto aprobado')
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn(string $state) => match (strtoupper($state)) {
                        'APROBADA' => 'success',
                        default => 'gray',
                    })
                    ->label('Estado')
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolicitudPagoEgresos::route('/'),
        ];
    }
}
