<?php

namespace App\Filament\Resources\BookRegister\BookRegisterSendResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterSendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookRegisterSend extends EditRecord
{
    protected static string $resource = BookRegisterSendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
