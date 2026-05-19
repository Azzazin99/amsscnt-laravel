<?php

namespace App\Filament\Resources\People\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PeopleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('person_id')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('prename')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('surname')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('position.position_name')
                    ->label('ตำแหน่ง')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('school.school_name')
                    ->label('โรงเรียน')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'success',
                        1 => 'danger',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('rec_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
