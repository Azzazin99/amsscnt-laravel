<?php

namespace App\Filament\Resources\Car\CarDriverResource\Pages;

use App\Filament\Resources\Car\CarDriverResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarDrivers extends ListRecords
{
    protected static string $resource = CarDriverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
