<?php

namespace App\Filament\Resources\BookRegister\BookRegisterCertificateResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookRegisterCertificate extends EditRecord
{
    protected static string $resource = BookRegisterCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
