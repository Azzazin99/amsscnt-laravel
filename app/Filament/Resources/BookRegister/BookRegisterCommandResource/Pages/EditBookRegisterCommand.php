<?php

namespace App\Filament\Resources\BookRegister\BookRegisterCommandResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterCommandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookRegisterCommand extends EditRecord
{
    protected static string $resource = BookRegisterCommandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
