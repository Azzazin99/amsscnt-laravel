<?php

namespace App\Filament\Resources\BookRegister\BookRegisterSendResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterSendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookRegisterSends extends ListRecords
{
    protected static string $resource = BookRegisterSendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
