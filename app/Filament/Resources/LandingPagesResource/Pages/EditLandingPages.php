<?php

namespace App\Filament\Resources\LandingPagesResource\Pages;

use App\Filament\Resources\LandingPagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandingPages extends EditRecord
{
    protected static string $resource = LandingPagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
