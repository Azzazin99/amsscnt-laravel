<?php

namespace App\Filament\Resources\BookRegister\BookRegisterCertificateResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookRegisterCertificates extends ListRecords
{
    protected static string $resource = BookRegisterCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
