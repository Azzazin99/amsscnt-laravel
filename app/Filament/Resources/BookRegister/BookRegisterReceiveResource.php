<?php

namespace App\Filament\Resources\BookRegister;

use App\Filament\Resources\BookRegister\BookRegisterReceiveResource\Pages;
use App\Models\BookRegister\BookRegisterReceive;
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
use Illuminate\Database\Eloquent\Builder;

class BookRegisterReceiveResource extends Resource
{
    protected static ?string $model = BookRegisterReceive::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลลงทะเบียนรับหนังสือ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('register_number')
                                    ->label('เลขทะเบียนรับ')
                                    ->required()
                                    ->numeric()
                                    ->default(function () {
                                        $activeYear = BookRegisterYear::where('year_active', true)->first();
                                        if (!$activeYear) return 1;
                                        
                                        $max = BookRegisterReceive::where('year', $activeYear->year)->max('register_number');
                                        return $max ? ($max + 1) : $activeYear->start_receive_num;
                                    }),
                                
                                Forms\Components\TextInput::make('book_no')
                                    ->label('เลขที่หนังสือ')
                                    ->required()
                                    ->maxLength(50),
                                
                                Forms\Components\DatePicker::make('signdate')
                                    ->label('ลงวันที่')
                                    ->required(),
                            ]),
                        
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('book_from')
                                    ->label('จาก (หน่วยงานเจ้าของเรื่อง)')
                                    ->required()
                                    ->maxLength(200),
                                
                                Forms\Components\TextInput::make('book_to')
                                    ->label('ถึง (ผู้รับ)')
                                    ->required()
                                    ->maxLength(200),
                            ]),

                        Forms\Components\TextInput::make('subject')
                            ->label('เรื่อง')
                            ->required()
                            ->maxLength(150),
                        
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\DatePicker::make('register_date')
                                    ->label('วันลงทะเบียนรับ')
                                    ->required()
                                    ->default(now()),
                                
                                Forms\Components\TextInput::make('operation')
                                    ->label('เจ้าของเรื่อง/ผู้ปฏิบัติ')
                                    ->maxLength(150),
                                
                                Forms\Components\Select::make('secret')
                                    ->label('ชั้นความลับ')
                                    ->options([
                                        0 => 'ปกติ',
                                        1 => 'ด่วน',
                                        2 => 'ด่วนมาก',
                                        3 => 'ด่วนที่สุด',
                                        4 => 'ลับ',
                                        5 => 'ลับมาก',
                                        6 => 'ลับที่สุด',
                                    ])
                                    ->default(0)
                                    ->required(),
                            ]),
                        
                        Forms\Components\Textarea::make('comment')
                            ->label('หมายเหตุ')
                            ->maxLength(100)
                            ->rows(2),

                        Forms\Components\Hidden::make('year')
                            ->default(function () {
                                $activeYear = BookRegisterYear::where('year_active', true)->first();
                                return $activeYear ? $activeYear->year : (date('Y') + 543);
                            }),
                        
                        Forms\Components\Hidden::make('ref_id')
                            ->default(fn () => 'rec_' . uniqid()),
                        
                        Forms\Components\Hidden::make('officer')
                            ->default(fn () => auth()->id() ?? '1'),
                    ]),
                
                \Filament\Schemas\Components\Section::make('ไฟล์เอกสารแนบ')
                    ->schema([
                        Forms\Components\Repeater::make('attachments')
                            ->relationship('attachments')
                            ->schema([
                                Forms\Components\FileUpload::make('file_name')
                                    ->label('แนบไฟล์เอกสาร')
                                    ->directory('bookregister/receive')
                                    ->preserveFilenames()
                                    ->required(),
                                
                                Forms\Components\TextInput::make('file_des')
                                    ->label('คำอธิบายไฟล์')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->createItemButtonLabel('เพิ่มไฟล์เอกสารแนบ')
                            ->grid(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('register_number')
                    ->label('เลขทะเบียนรับ')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('year')
                    ->label('ปี (พ.ศ.)')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('book_no')
                    ->label('เลขที่หนังสือ')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('register_date')
                    ->label('วันลงทะเบียน')
                    ->date('d/m/Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('book_from')
                    ->label('จาก')
                    ->searchable()
                    ->limit(20),
                
                Tables\Columns\TextColumn::make('subject')
                    ->label('เรื่อง')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('secret')
                    ->label('ชั้นความลับ')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'gray',
                        1 => 'info',
                        2 => 'warning',
                        3, 4, 5, 6 => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        0 => 'ปกติ',
                        1 => 'ด่วน',
                        2 => 'ด่วนมาก',
                        3 => 'ด่วนที่สุด',
                        4 => 'ลับ',
                        5 => 'ลับมาก',
                        6 => 'ลับที่สุด',
                        default => 'ปกติ',
                    }),
                
                Tables\Columns\TextColumn::make('attachments_count')
                    ->label('ไฟล์แนบ')
                    ->counts('attachments')
                    ->badge()
                    ->color('success'),
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
            'index' => Pages\ListBookRegisterReceives::route('/'),
            'create' => Pages\CreateBookRegisterReceive::route('/create'),
            'edit' => Pages\EditBookRegisterReceive::route('/{record}/edit'),
        ];
    }
}
