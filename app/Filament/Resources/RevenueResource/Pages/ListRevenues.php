<?php

namespace App\Filament\Resources\RevenueResource\Pages;

use App\Filament\Resources\RevenueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use App\Models\Product; // Pastikan model Product ada

class ListRevenues extends ListRecords
{
    protected static string $resource = RevenueResource::class;

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('total')
                ->label('Total Pendapatan')
                ->money('idr', true)
                ->sortable(),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Pelanggan')
                ->sortable(),
            Tables\Columns\TextColumn::make('most_sold_product')
                ->label('Produk Terlaris')
                ->getValueUsing(function ($record) {
                    return Product::withCount('transactions')
                        ->orderBy('transactions_count', 'desc')
                        ->first()?->name ?? 'Tidak ada produk';
                }),
            Tables\Columns\TextColumn::make('least_sold_product')
                ->label('Produk Tersedikit Terjual')
                ->getValueUsing(function ($record) {
                    return Product::withCount('transactions')
                        ->orderBy('transactions_count', 'asc')
                        ->first()?->name ?? 'Tidak ada produk';
                }),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\Filter::make('date')
                ->form([
                    \Filament\Forms\Components\DatePicker::make('from')->label('Dari'),
                    \Filament\Forms\Components\DatePicker::make('until')->label('Sampai'),
                ])
                ->query(function (Builder $query, array $data) {
                    return $query
                        ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                        ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                }),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Export')
                ->url(route('revenues.export')), // Tambahkan route untuk export jika diperlukan
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }
}
