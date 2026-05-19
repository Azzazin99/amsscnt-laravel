<?php

namespace App\Filament\Resources\BookRegister;

use App\Filament\Resources\BookRegister\BookRegisterCerSignResource\Pages;
use App\Models\BookRegister\BookRegisterCerSign;
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

class BookRegisterCerSignResource extends Resource
{
    protected static ?string $model = BookRegisterCerSign::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลผู้ลงนามในเกียรติบัตร')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('รหัสผู้ลงนาม')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(13),
                                
                                Forms\Components\TextInput::make('name')
                                    ->label('ชื่อ-นามสกุล')
                                    ->required()
                                    ->maxLength(200),
                            ]),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('position1')
                                    ->label('ตำแหน่งบรรทัดที่ 1')
                                    ->required()
                                    ->maxLength(200),
                                
                                Forms\Components\TextInput::make('position2')
                                    ->label('ตำแหน่งบรรทัดที่ 2')
                                    ->maxLength(200),
                            ]),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('sign_pic')
                                    ->label('รูปภาพลายเซ็น')
                                    ->image()
                                    ->directory('bookregister/signature')
                                    ->preserveFilenames(),
                                
                                Forms\Components\Toggle::make('sign_now')
                                    ->label('เปิดใช้งานเป็นผู้ลงนามปัจจุบัน')
                                    ->inline(false)
                                    ->default(false),
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
                Tables\Columns\TextColumn::make('code')
                    ->label('รหัสผู้ลงนาม')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อ-นามสกุล')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('position1')
                    ->label('ตำแหน่งบรรทัดที่ 1')
                    ->searchable()
                    ->limit(40),
                
                Tables\Columns\ImageColumn::make('sign_pic')
                    ->label('ลายเซ็น')
                    ->circular(),
                
                Tables\Columns\ToggleColumn::make('sign_now')
                    ->label('ใช้งานปัจจุบัน')
                    ->sortable(),
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
            ->defaultSort('code', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookRegisterCerSigns::route('/'),
            'create' => Pages\CreateBookRegisterCerSign::route('/create'),
            'edit' => Pages\EditBookRegisterCerSign::route('/{record}/edit'),
        ];
    }
}
