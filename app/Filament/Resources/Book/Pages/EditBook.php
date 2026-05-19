<?php

namespace App\Filament\Resources\Book\Pages;

use App\Filament\Resources\Book\BookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBook extends EditRecord
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        if (!empty($this->data['send_to_all'])) {
            $refId = $this->record->ref_id;
            
            // Delete existing recipients to rebuild
            \App\Models\Book\BookSendtoAnswer::where('ref_id', $refId)->delete();
            
            // Get all schools
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
