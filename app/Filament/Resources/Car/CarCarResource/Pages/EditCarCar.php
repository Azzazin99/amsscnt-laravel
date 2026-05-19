<?php

namespace App\Filament\Resources\Car\CarCarResource\Pages;

use App\Filament\Resources\Car\CarCarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarCar extends EditRecord
{
    protected static string $resource = CarCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
