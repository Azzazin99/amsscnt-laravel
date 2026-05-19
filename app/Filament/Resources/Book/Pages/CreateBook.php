<?php

namespace App\Filament\Resources\Book\Pages;

use App\Filament\Resources\Book\BookResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    protected function afterCreate(): void
    {
        if (!empty($this->data['send_to_all'])) {
            $refId = $this->record->ref_id;
            
            // Get all school codes
            $schools = \App\Models\School::all();
            
            foreach ($schools as $school) {
                \App\Models\Book\BookSendtoAnswer::create([
                    'send_level' => 1,
                    'send_to' => $school->school_code,
                    'ref_id' => $refId,
                ]);
            }
        }
    }
}
