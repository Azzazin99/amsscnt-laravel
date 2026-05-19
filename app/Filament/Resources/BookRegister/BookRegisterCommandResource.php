<?php

namespace App\Filament\Resources\BookRegister;

use App\Filament\Resources\BookRegister\BookRegisterCommandResource\Pages;
use App\Models\BookRegister\BookRegisterCommand;
use App\Models\BookRegister\BookRegisterYear;
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

class BookRegisterCommandResource extends Resource
{
    protected static ?string $model = BookRegisterCommand::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลลงทะเบียนคำสั่ง/ประกาศ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('register_number')
                                    ->label('เลขทะเบียนคำสั่ง')
                                    ->required()
                                    ->numeric()
                                    ->default(function () {
                                        $activeYear = BookRegisterYear::where('year_active', true)->first();
                                        if (!$activeYear) return 1;
                                        
                                        $max = BookRegisterCommand::where('year', $activeYear->year)->max('register_number');
                                        return $max ? ($max + 1) : $activeYear->start_command_num;
                                    }),
                                
                                Forms\Components\TextInput::make('book_no')
                                    ->label('เลขที่คำสั่ง/ประกาศ')
                                    ->required()
                                    ->maxLength(50),
                                
                                Forms\Components\DatePicker::make('signdate')
                                    ->label('สั่ง ณ วันที่')
                                    ->required(),
                            ]),

                        Forms\Components\TextInput::make('subject')
                            ->label('เรื่อง')
                            ->required()
                            ->maxLength(150),
                        
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('register_date')
                                    ->label('วันลงทะเบียนคุม')
                                    ->required()
                                    ->default(now()),
                                
                                Forms\Components\TextInput::make('comment')
                                    ->label('หมายเหตุ')
                                    ->maxLength(100),
                            ]),

                        Forms\Components\Hidden::make('year')
                            ->default(function () {
                                $activeYear = BookRegisterYear::where('year_active', true)->first();
                                return $activeYear ? $activeYear->year : (date('Y') + 543);
                            }),
                        
                        Forms\Components\Hidden::make('officer')
                            ->default(fn () => auth()->id() ?? '1'),
                    ]),
                
                \Filament\Schemas\Components\Section::make('ไฟล์เอกสารแนบ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('file_name')
                                    ->label('แนบไฟล์เอกสาร')
                                    ->directory('bookregister/command')
                                    ->preserveFilenames(),
                                
                                Forms\Components\TextInput::make('file_des')
                                    ->label('คำอธิบายไฟล์')
                                    ->maxLength(100),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('register_number')
                    ->label('เลขทะเบียนคำสั่ง')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('year')
                    ->label('ปี (พ.ศ.)')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('book_no')
                    ->label('เลขที่คำสั่ง/ประกาศ')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('signdate')
                    ->label('สั่ง ณ วันที่')
                    ->date('d/m/Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('subject')
                    ->label('เรื่อง')
                    ->searchable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('file_name')
                    ->label('ไฟล์แนบ')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? 'มีไฟล์แนบ' : 'ไม่มีไฟล์แนบ'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->label('ปี พ.ศ.')
                    ->options(fn () => BookRegisterYear::pluck('year', 'year')->toArray()),
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
            ->defaultSort('register_number', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookRegisterCommands::route('/'),
            'create' => Pages\CreateBookRegisterCommand::route('/create'),
            'edit' => Pages\EditBookRegisterCommand::route('/{record}/edit'),
        ];
    }
}
