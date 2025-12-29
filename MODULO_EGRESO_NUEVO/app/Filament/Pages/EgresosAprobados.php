<?php

namespace App\Filament\Pages;

use App\Filament\Pages\RegistrarEgreso;
use App\Models\SolicitudPago;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EgresosAprobados extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Egresos';

    protected static ?string $navigationLabel = 'Registro de egresos';

    protected static ?string $title = 'Registro de egresos';

    protected static string $view = 'filament.pages.egresos-aprobados';

    protected static bool $shouldRegisterNavigation = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SolicitudPago::query()
                    ->where('estado', 'APROBADA')
            )
            ->defaultSort('aprobada_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('motivo')
                    ->label('Motivo')
                    ->limit(40),
                TextColumn::make('monto_aprobado')
                    ->label('Monto aprobado')
                    ->money('USD'),
                TextColumn::make('aprobada_at')
                    ->label('Fecha aprobación')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                TextColumn::make('aprobador.name')
                    ->label('Aprobado por')
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
            ->filters([
                Tables\Filters\Filter::make('fecha_aprobada')
                    ->form([
                        Tables\Filters\Components\DatePicker::make('desde')->label('Desde'),
                        Tables\Filters\Components\DatePicker::make('hasta')->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['desde'] ?? null, fn(Builder $q, $date) => $q->whereDate('aprobada_at', '>=', $date))
                            ->when($data['hasta'] ?? null, fn(Builder $q, $date) => $q->whereDate('aprobada_at', '<=', $date));
                    }),
            ]);
    }
}
