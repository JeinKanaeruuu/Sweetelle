<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RevenueResource\Pages;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Transaction;


class RevenueResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationGroup = 'Pendapatan & Transaksi';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Pendapatan';
    protected static ?string $pluralLabel = 'Pendapatan';
    protected static ?string $label = 'Pendapatan';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->money('idr', true)
                    ->label('Total Pendapatan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('until')->label('Sampai'),
                    ])
                    ->label('Filter')
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                    }),
                ]);
    }

    public static function getEloquentQuery(): Builder
    {
        // Filter hanya data dengan status 'Diterima'
        return parent::getEloquentQuery()->where('status', 'Diterima');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRevenues::route('/'),
        ];
    }


    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    
}
