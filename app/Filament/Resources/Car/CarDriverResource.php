<?php

namespace App\Filament\Resources\Car;

use App\Models\Car\CarDriver;
use App\Models\Person;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class CarDriverResource extends Resource
{
    protected static ?string $model = CarDriver::class;

    protected static \UnitEnum|string|null $navigationGroup = 'ระบบยานพาหนะ';
    protected static ?string $navigationLabel = 'ตั้งค่าพนักงานขับรถ';
    protected static ?string $pluralLabel = 'ตั้งค่าพนักงานขับรถ';
    protected static ?string $modelLabel = 'พนักงานขับรถ';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลพนักงานขับรถยนต์ราชการ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('person_id')
                                    ->label('เลือกบุคลากรที่เป็นพนักงานขับรถ')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->options(fn () => Person::all()->mapWithKeys(fn ($p) => [$p->person_id => $p->prename . $p->name . ' ' . $p->surname])->toArray()),

                                Forms\Components\Select::make('status')
                                    ->label('สถานะการปฏิบัติงาน')
                                    ->options([
                                        1 => 'พร้อมปฏิบัติงาน',
                                        0 => 'ไม่พร้อมปฏิบัติงาน / พักงาน',
                                    ])
                                    ->required()
                                    ->default(1),
                            ]),

                        Forms\Components\Hidden::make('officer')
                            ->default(fn () => auth()->id() ?? '1'),

                        Forms\Components\Hidden::make('rec_date')
                            ->default(now()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('driverPerson.name')
                    ->label('ชื่อ-นามสกุลพนักงาน')
                    ->formatStateUsing(fn ($record) => $record->driverPerson ? $record->driverPerson->prename . $record->driverPerson->name . ' ' . $record->driverPerson->surname : '-')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('driverPerson.position.position_name')
                    ->label('ตำแหน่ง')
                    ->default('-'),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('พร้อมปฏิบัติงาน'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => CarDriverResource\Pages\ListCarDrivers::route('/'),
            'create' => CarDriverResource\Pages\CreateCarDriver::route('/create'),
            'edit' => CarDriverResource\Pages\EditCarDriver::route('/{record}/edit'),
        ];
    }
}
