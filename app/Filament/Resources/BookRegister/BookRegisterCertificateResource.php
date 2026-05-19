<?php

namespace App\Filament\Resources\BookRegister;

use App\Filament\Resources\BookRegister\BookRegisterCertificateResource\Pages;
use App\Models\BookRegister\BookRegisterCertificate;
use App\Models\BookRegister\BookRegisterCerSign;
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

class BookRegisterCertificateResource extends Resource
{
    protected static ?string $model = BookRegisterCertificate::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getNextRegisterNumber($numto = 1)
    {
        $activeYear = BookRegisterYear::where('year_active', true)->first();
        if (!$activeYear) return $numto;
        
        $max = BookRegisterCertificate::where('year', $activeYear->year)->max('register_number');
        $start = $max ?: ($activeYear->start_cer_num - 1);
        return $start + $numto;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลลงทะเบียนคุมเกียรติบัตร')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('numto')
                                    ->label('จำนวนเกียรติบัตร (ฉบับ)')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->reactive()
                                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                                        $set('register_number', static::getNextRegisterNumber((int)($state ?: 1)));
                                    }),

                                Forms\Components\TextInput::make('register_number')
                                    ->label('เลขทะเบียนเกียรติบัตรล่าสุด')
                                    ->required()
                                    ->numeric()
                                    ->default(fn () => static::getNextRegisterNumber(1)),

                                Forms\Components\TextInput::make('book_no')
                                    ->label('เลขที่เกียรติบัตร')
                                    ->required()
                                    ->placeholder('เช่น 1-5/2569')
                                    ->maxLength(50),
                            ]),

                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\DatePicker::make('signdate')
                                    ->label('สั่ง ณ วันที่')
                                    ->required()
                                    ->default(now()),

                                Forms\Components\TextInput::make('name_cer')
                                    ->label('ชื่อผู้รับเกียรติบัตร')
                                    ->required()
                                    ->placeholder('ชื่อบุคคล หรือชื่อหน่วยงาน')
                                    ->maxLength(150),

                                Forms\Components\Select::make('sign_person')
                                    ->label('ผู้ลงนาม')
                                    ->required()
                                    ->options(fn () => BookRegisterCerSign::pluck('name', 'code')->toArray())
                                    ->default(fn () => BookRegisterCerSign::where('sign_now', true)->value('code')),
                            ]),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('subject')
                                    ->label('เรื่อง (บรรทัดที่ 1)')
                                    ->required()
                                    ->maxLength(150),
                                
                                Forms\Components\TextInput::make('subject2')
                                    ->label('เรื่อง (บรรทัดที่ 2)')
                                    ->maxLength(250),
                            ]),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('register_date')
                                    ->label('วันที่ลงทะเบียนคุม')
                                    ->required()
                                    ->default(now()),
                                
                                Forms\Components\TextInput::make('comment')
                                    ->label('หมายเหตุ')
                                    ->maxLength(100),
                            ]),

                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('khet_print')
                                    ->label('เขตจัดพิมพ์เอง')
                                    ->default(false),

                                Forms\Components\Toggle::make('check_status')
                                    ->label('สถานะการตรวจสอบ')
                                    ->default(false),

                                Forms\Components\Toggle::make('quarantee')
                                    ->label('การรับรองความถูกต้อง')
                                    ->default(false),
                            ]),

                        Forms\Components\Hidden::make('year')
                            ->default(function () {
                                $activeYear = BookRegisterYear::where('year_active', true)->first();
                                return $activeYear ? $activeYear->year : (date('Y') + 543);
                            }),
                        
                        Forms\Components\Hidden::make('officer')
                            ->default(fn () => auth()->id() ?? '1'),

                        Forms\Components\Hidden::make('quarantee_person')
                            ->default(fn () => auth()->id() ?? '1'),

                        Forms\Components\Hidden::make('quarantee_date')
                            ->default(now()),
                    ]),

                \Filament\Schemas\Components\Section::make('ไฟล์เอกสารแนบ')
                    ->schema([
                        Forms\Components\FileUpload::make('file_name')
                            ->label('ไฟล์แนบเกียรติบัตร (PDF/รูปภาพ)')
                            ->directory('bookregister/certificate')
                            ->preserveFilenames(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('register_number')
                    ->label('เลขทะเบียนคุม')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        if ($record->numto > 1) {
                            $start = $record->register_number - $record->numto + 1;
                            return $start . ' - ' . $record->register_number;
                        }
                        return $record->register_number;
                    }),
                
                Tables\Columns\TextColumn::make('year')
                    ->label('ปี พ.ศ.')
                    ->sortable(),

                Tables\Columns\TextColumn::make('book_no')
                    ->label('เลขที่เกียรติบัตร')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name_cer')
                    ->label('ชื่อผู้ได้รับ')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('เรื่อง')
                    ->limit(55)
                    ->searchable(),

                Tables\Columns\TextColumn::make('signdate')
                    ->label('วันที่สั่ง')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('khet_print')
                    ->label('เขตพิมพ์')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('file_name')
                    ->label('ไฟล์แนบ')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? 'ดาวน์โหลด' : 'ไม่มี'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->label('ปี พ.ศ.')
                    ->options(fn () => BookRegisterYear::pluck('year', 'year')->toArray()),
                
                Tables\Filters\TernaryFilter::make('khet_print')
                    ->label('พิมพ์โดยเขต'),
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
            'index' => Pages\ListBookRegisterCertificates::route('/'),
            'create' => Pages\CreateBookRegisterCertificate::route('/create'),
            'edit' => Pages\EditBookRegisterCertificate::route('/{record}/edit'),
        ];
    }
}
