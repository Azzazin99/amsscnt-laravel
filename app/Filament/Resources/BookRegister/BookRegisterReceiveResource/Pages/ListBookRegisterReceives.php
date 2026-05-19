<?php

namespace App\Filament\Resources\BookRegister\BookRegisterReceiveResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterReceiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookRegisterReceives extends ListRecords
{
    protected static string $resource = BookRegisterReceiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
