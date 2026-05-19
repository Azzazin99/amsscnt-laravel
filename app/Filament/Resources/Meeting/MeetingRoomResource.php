<?php

namespace App\Filament\Resources\Meeting;

use App\Models\Meeting\MeetingRoom;
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

class MeetingRoomResource extends Resource
{
    protected static ?string $model = MeetingRoom::class;

    protected static \UnitEnum|string|null $navigationGroup = 'ระบบจองห้องประชุม';
    protected static ?string $navigationLabel = 'ตั้งค่าห้องประชุม';
    protected static ?string $pluralLabel = 'ตั้งค่าห้องประชุม';
    protected static ?string $modelLabel = 'ห้องประชุม';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลห้องประชุม')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('room_code')
                                    ->label('รหัสห้องประชุม')
                                    ->required()
                                    ->numeric()
                                    ->unique(ignoreRecord: true),

                                Forms\Components\TextInput::make('room_name')
                                    ->label('ชื่อห้องประชุม')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\Toggle::make('active')
                                    ->label('สถานะเปิดใช้งาน')
                                    ->inline(false)
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room_code')
                    ->label('รหัสห้องประชุม')
                    ->sortable(),

                Tables\Columns\TextColumn::make('room_name')
                    ->label('ชื่อห้องประชุม')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('active')
                    ->label('เปิดใช้งาน'),
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
            ->defaultSort('room_code', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => MeetingRoomResource\Pages\ListMeetingRooms::route('/'),
            'create' => MeetingRoomResource\Pages\CreateMeetingRoom::route('/create'),
            'edit' => MeetingRoomResource\Pages\EditMeetingRoom::route('/{record}/edit'),
        ];
    }
}
