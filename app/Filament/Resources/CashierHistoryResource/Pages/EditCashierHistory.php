<?php

namespace App\Filament\Resources\CashierHistoryResource\Pages;

use App\Filament\Resources\CashierHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCashierHistory extends EditRecord
{
    protected static string $resource = CashierHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
