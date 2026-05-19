<?php

namespace App\Filament\Resources\Car\CarMainResource\Pages;

use App\Filament\Resources\Car\CarMainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarMain extends EditRecord
{
    protected static string $resource = CarMainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
