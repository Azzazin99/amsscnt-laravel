<?php

namespace App\Filament\Resources\BookRegister\BookRegisterReceiveResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterReceiveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookRegisterReceive extends EditRecord
{
    protected static string $resource = BookRegisterReceiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
