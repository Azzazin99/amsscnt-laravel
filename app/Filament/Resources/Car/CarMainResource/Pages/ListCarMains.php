<?php

namespace App\Filament\Resources\Car\CarMainResource\Pages;

use App\Filament\Resources\Car\CarMainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarMains extends ListRecords
{
    protected static string $resource = CarMainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
