<?php

namespace App\Filament\Resources\Book;

use App\Filament\Resources\Book\Pages\CreateBook;
use App\Filament\Resources\Book\Pages\EditBook;
use App\Filament\Resources\Book\Pages\ListBooks;
use App\Filament\Resources\Book\Schemas\BookForm;
use App\Filament\Resources\Book\Tables\BookTable;
use App\Models\Book\BookMain;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = BookMain::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $navigationLabel = 'รับส่งหนังสือราชการ';

    protected static ?string $modelLabel = 'รับส่งหนังสือราชการ';

    protected static ?string $pluralModelLabel = 'รับส่งหนังสือราชการ';

    protected static \UnitEnum|string|null $navigationGroup = 'บริหารงานทั่วไป';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'subject';

    public static function form(Schema $schema): Schema
    {
        return BookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'edit' => EditBook::route('/{record}/edit'),
        ];
    }
}
