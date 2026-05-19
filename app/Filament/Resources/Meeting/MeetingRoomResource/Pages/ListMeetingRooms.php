<?php

namespace App\Filament\Resources\Meeting\MeetingRoomResource\Pages;

use App\Filament\Resources\Meeting\MeetingRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeetingRooms extends ListRecords
{
    protected static string $resource = MeetingRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
