<?php

namespace App\Filament\Resources\Meeting\MeetingMainResource\Pages;

use App\Filament\Resources\Meeting\MeetingMainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeetingMain extends EditRecord
{
    protected static string $resource = MeetingMainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
