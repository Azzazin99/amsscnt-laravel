<?php

namespace App\Filament\Resources\Book\Schemas;

use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลหนังสือ')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('bookno')
                            ->label('เลขที่หนังสือ')
                            ->required()
                            ->maxLength(50),
                        
                        \Filament\Forms\Components\DatePicker::make('signdate')
                            ->label('ลงวันที่')
                            ->required(),

                        \Filament\Forms\Components\Select::make('level')
                            ->label('ชั้นความเร็ว')
                            ->options([
                                1 => 'ปกติ (Normal)',
                                2 => 'ด่วน (Urgent)',
                                3 => 'ด่วนมาก (Very Urgent)',
                                4 => 'ด่วนที่สุด (Most Urgent)',
                            ])
                            ->required()
                            ->default(1),

                        \Filament\Forms\Components\Select::make('secret')
                            ->label('ชั้นความลับ')
                            ->options([
                                0 => 'ปกติ (Normal)',
                                1 => 'ลับ (Secret)',
                                2 => 'ลับมาก (Very Secret)',
                                3 => 'ลับที่สุด (Top Secret)',
                            ])
                            ->required()
                            ->default(0),

                        \Filament\Forms\Components\Select::make('book_type')
                            ->label('ประเภทหนังสือ')
                            ->options([
                                1 => 'หนังสือเข้าเขต',
                                2 => 'หนังสือส่งโรงเรียน',
                            ])
                            ->required()
                            ->default(2),

                        \Filament\Forms\Components\TextInput::make('office')
                            ->label('กลุ่มงาน/หน่วยงานผู้ส่ง')
                            ->maxLength(13)
                            ->default('saraban'),
                    ]),

                \Filament\Schemas\Components\Section::make('เนื้อหาและรายละเอียด')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('subject')
                            ->label('เรื่อง')
                            ->required()
                            ->maxLength(150),

                        \Filament\Forms\Components\Textarea::make('detail')
                            ->label('รายละเอียด')
                            ->rows(5),

                        \Filament\Forms\Components\TextInput::make('ref_id')
                            ->label('รหัสอ้างอิงเอกสาร')
                            ->default(fn () => 'book_' . uniqid())
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        \Filament\Forms\Components\Hidden::make('sender')
                            ->default(fn () => auth()->id() ?? '1'),

                        \Filament\Forms\Components\Hidden::make('send_date')
                            ->default(fn () => now()),
                    ]),

                \Filament\Schemas\Components\Section::make('ผู้รับหนังสือ')
                    ->schema([
                        \Filament\Forms\Components\Toggle::make('send_to_all')
                            ->label('ส่งถึงทุกโรงเรียน / ทุกหน่วยงาน')
                            ->helperText('เมื่อเปิดใช้งาน หนังสือฉบับนี้จะถูกส่งไปถึงทุกโรงเรียนทั้งหมดในระบบโดยอัตโนมัติ')
                            ->live()
                            ->default(false),

                        \Filament\Forms\Components\Repeater::make('recipients')
                            ->relationship('recipients')
                            ->hidden(fn ($get) => $get('send_to_all') === true)
                            ->schema([
                                \Filament\Forms\Components\Select::make('send_to')
                                    ->label('ส่งถึงโรงเรียน / หน่วยงาน')
                                    ->relationship('targetSchool', 'school_name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                
                                \Filament\Forms\Components\Hidden::make('send_level')
                                    ->default(1),
                            ])
                            ->createItemButtonLabel('เพิ่มรายชื่อผู้รับ')
                            ->grid(2),
                    ]),

                \Filament\Schemas\Components\Section::make('ไฟล์แนบ')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('attachments')
                            ->relationship('attachments')
                            ->schema([
                                \Filament\Forms\Components\FileUpload::make('file_name')
                                    ->label('อัปโหลดไฟล์')
                                    ->directory('book_files')
                                    ->required(),
                                
                                \Filament\Forms\Components\TextInput::make('file_des')
                                    ->label('คำอธิบายไฟล์')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->createItemButtonLabel('เพิ่มไฟล์แนบ')
                            ->grid(2),
                    ]),
            ]);
    }
}
