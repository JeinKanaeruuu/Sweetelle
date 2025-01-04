<?php

namespace App\Filament\Resources\CashierHistoryResource\Pages;

use App\Filament\Resources\CashierHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCashierHistories extends ListRecords
{
    protected static string $resource = CashierHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
