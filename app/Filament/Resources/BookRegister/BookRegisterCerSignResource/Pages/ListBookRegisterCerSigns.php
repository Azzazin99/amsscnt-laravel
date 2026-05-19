<?php

namespace App\Filament\Resources\BookRegister\BookRegisterCerSignResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterCerSignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookRegisterCerSigns extends ListRecords
{
    protected static string $resource = BookRegisterCerSignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
