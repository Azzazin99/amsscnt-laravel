<?php

namespace App\Filament\Resources\People\Schemas;

use Filament\Schemas\Schema;

class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('person_id')
                    ->required()
                    ->maxLength(13)
                    ->unique(ignorable: fn ($record) => $record),
                \Filament\Forms\Components\TextInput::make('prename')
                    ->required()
                    ->maxLength(20),
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50),
                \Filament\Forms\Components\TextInput::make('surname')
                    ->required()
                    ->maxLength(50),
                \Filament\Forms\Components\Select::make('position_code')
                    ->relationship('position', 'position_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                \Filament\Forms\Components\Select::make('school_code')
                    ->relationship('school', 'school_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                \Filament\Forms\Components\FileUpload::make('pic')
                    ->image()
                    ->directory('person_pics'),
                \Filament\Forms\Components\TextInput::make('status')
                    ->numeric()
                    ->required()
                    ->default(0),
                \Filament\Forms\Components\TextInput::make('person_order')
                    ->numeric()
                    ->required()
                    ->default(0),
                \Filament\Forms\Components\TextInput::make('officer')
                    ->maxLength(13),
                \Filament\Forms\Components\DatePicker::make('rec_date'),
                \Filament\Forms\Components\TextInput::make('other')
                    ->maxLength(255),
            ]);
    }
}
