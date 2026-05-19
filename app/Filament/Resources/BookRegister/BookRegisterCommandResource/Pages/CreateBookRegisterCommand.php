<?php

namespace App\Filament\Resources\BookRegister\BookRegisterCommandResource\Pages;

use App\Filament\Resources\BookRegister\BookRegisterCommandResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookRegisterCommand extends CreateRecord
{
    protected static string $resource = BookRegisterCommandResource::class;
}
