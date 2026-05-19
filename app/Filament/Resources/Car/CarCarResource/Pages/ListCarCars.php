<?php

namespace App\Filament\Resources\Car\CarCarResource\Pages;

use App\Filament\Resources\Car\CarCarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarCars extends ListRecords
{
    protected static string $resource = CarCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
