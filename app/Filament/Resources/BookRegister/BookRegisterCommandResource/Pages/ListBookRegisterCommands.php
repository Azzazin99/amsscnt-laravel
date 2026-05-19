<?php

namespace App\Filament\Resources\BookRegister\BookRegisterCommandResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterCommandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookRegisterCommands extends ListRecords
{
    protected static string $resource = BookRegisterCommandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
