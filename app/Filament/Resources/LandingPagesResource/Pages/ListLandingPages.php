<?php

namespace App\Filament\Resources\LandingPagesResource\Pages;

use App\Filament\Resources\LandingPagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandingPages extends ListRecords
{
    protected static string $resource = LandingPagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
