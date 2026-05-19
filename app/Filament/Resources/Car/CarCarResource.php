<?php

namespace App\Filament\Resources\Car;

use App\Models\Car\CarCar;
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

class CarCarResource extends Resource
{
    protected static ?string $model = CarCar::class;

    protected static \UnitEnum|string|null $navigationGroup = 'ระบบยานพาหนะ';
    protected static ?string $navigationLabel = 'ตั้งค่ายานพาหนะ';
    protected static ?string $pluralLabel = 'ตั้งค่ายานพาหนะ';
    protected static ?string $modelLabel = 'ยานพาหนะ';
    protected static ?int $navigationSort = 3;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลยานพาหนะราชการ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('car_code')
                                    ->label('รหัสยานพาหนะ')
                                    ->required()
                                    ->numeric()
                                    ->unique(ignoreRecord: true),

                                Forms\Components\TextInput::make('car_number')
                                    ->label('หมายเลขทะเบียน')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('name')
                                    ->label('ยี่ห้อ / ชื่อเรียก')
                                    ->required()
                                    ->maxLength(150),
                            ]),

                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('car_type')
                                    ->label('รหัสประเภท (เช่น 2001, 2002)')
                                    ->numeric()
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->label('สถานะความพร้อม')
                                    ->options([
                                        3 => 'พร้อมใช้งาน',
                                        2 => 'ชำรุด / ไม่พร้อมใช้งาน',
                                    ])
                                    ->required()
                                    ->default(3),
                            ]),

                        Forms\Components\FileUpload::make('pic')
                            ->label('รูปภาพยานพาหนะ')
                            ->image()
                            ->directory('car/images')
                            ->preserveFilenames(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car_code')
                    ->label('รหัส')
                    ->sortable(),

                Tables\Columns\TextColumn::make('car_number')
                    ->label('หมายเลขทะเบียน')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('ยี่ห้อ / รายละเอียด')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\ImageColumn::make('pic')
                    ->label('รูปภาพ')
                    ->circular(),

                Tables\Columns\TextColumn::make('status')
                    ->label('สถานะ')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        3 => 'success',
                        2 => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        3 => 'พร้อมใช้งาน',
                        2 => 'ชำรุด/ไม่พร้อมใช้งาน',
                        default => 'อื่นๆ',
                    }),
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
            ->defaultSort('car_code', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => CarCarResource\Pages\ListCarCars::route('/'),
            'create' => CarCarResource\Pages\CreateCarCar::route('/create'),
            'edit' => CarCarResource\Pages\EditCarCar::route('/{record}/edit'),
        ];
    }
}
