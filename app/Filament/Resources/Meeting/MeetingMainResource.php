<?php

namespace App\Filament\Resources\Meeting;

use App\Models\Meeting\MeetingMain;
use App\Models\Meeting\MeetingRoom;
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
use Illuminate\Database\Eloquent\Model;

class MeetingMainResource extends Resource
{
    protected static ?string $model = MeetingMain::class;

    protected static \UnitEnum|string|null $navigationGroup = 'ระบบจองห้องประชุม';
    protected static ?string $navigationLabel = 'จองห้องประชุม';
    protected static ?string $pluralLabel = 'จองห้องประชุม';
    protected static ?string $modelLabel = 'การจองห้องประชุม';
    protected static ?int $navigationSort = 1;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    // Strict Business Logic: Only allow editing bookings starting today or in the future
    public static function canEdit(Model $record): bool
    {
        return $record->book_date ? $record->book_date->greaterThanOrEqualTo(now()->startOfDay()) : true;
    }

    // Strict Business Logic: Only allow deleting bookings starting today or in the future
    public static function canDelete(Model $record): bool
    {
        return $record->book_date ? $record->book_date->greaterThanOrEqualTo(now()->startOfDay()) : true;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลการจองห้องประชุม')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('room')
                                    ->label('ห้องประชุม')
                                    ->required()
                                    ->options(fn () => MeetingRoom::where('active', true)->pluck('room_name', 'room_code')->toArray()),

                                Forms\Components\DatePicker::make('book_date')
                                    ->label('วันที่เริ่มจอง')
                                    ->required()
                                    ->minDate(now()->startOfDay()) // Block past bookings
                                    ->default(now()),

                                Forms\Components\DatePicker::make('book_date_end')
                                    ->label('วันที่สิ้นสุดการจอง')
                                    ->required()
                                    ->minDate(now()->startOfDay()) // Block past bookings
                                    ->default(now()),
                            ]),

                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('start_time')
                                    ->label('เวลาเริ่ม (เช่น 08:30 หรือ 8)')
                                    ->required()
                                    ->maxLength(5),

                                Forms\Components\TextInput::make('finish_time')
                                    ->label('เวลาสิ้นสุด (เช่น 16:30 หรือ 16)')
                                    ->required()
                                    ->maxLength(5),

                                Forms\Components\TextInput::make('person_num')
                                    ->label('จำนวนผู้เข้าร่วมประชุม (คน)')
                                    ->numeric()
                                    ->required(),
                            ]),

                        Forms\Components\TextInput::make('objective')
                            ->label('วัตถุประสงค์ / หัวข้อการประชุม')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\CheckboxList::make('equipment')
                            ->label('อุปกรณ์ที่ต้องการใช้')
                            ->options([
                                'เครื่องเสียง' => 'เครื่องเสียง',
                                'โปรเจคเตอร์' => 'โปรเจคเตอร์',
                                'ชุดกาแฟ' => 'ชุดกาแฟ',
                                'ระบบประชุมออนไลน์' => 'ระบบประชุมออนไลน์',
                            ])
                            ->columns(2)
                            ->afterStateHydrated(function ($component, $state) {
                                if (is_string($state)) {
                                    $component->state(explode(',', $state));
                                }
                            })
                            ->dehydrateStateUsing(function ($state) {
                                return is_array($state) ? implode(',', $state) : $state;
                            }),

                        Forms\Components\Textarea::make('other')
                            ->label('รายละเอียดอื่นๆ / หมายเหตุ')
                            ->maxLength(65535)
                            ->columnSpanFull(),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('book_person')
                                    ->label('ผู้ขอจอง')
                                    ->required()
                                    ->options(fn () => Person::all()->mapWithKeys(fn ($p) => [$p->person_id => $p->prename . $p->name . ' ' . $p->surname])->toArray())
                                    ->default(fn () => auth()->id() ?? '1'),
                            ]),

                        Forms\Components\Hidden::make('rec_date')
                            ->default(now()),
                    ]),

                \Filament\Schemas\Components\Section::make('ส่วนเจ้าหน้าที่อนุมัติ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('approve')
                                    ->label('สถานะการอนุมัติ')
                                    ->options([
                                        null => 'รอการอนุมัติ',
                                        1 => 'อนุมัติการจอง',
                                        2 => 'ไม่อนุมัติการจอง',
                                    ])
                                    ->default(null),

                                Forms\Components\TextInput::make('reason')
                                    ->label('เหตุผลการไม่อนุมัติ / หมายเหตุเพิ่มเติม')
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Hidden::make('officer')
                            ->default(fn () => auth()->id() ?? '1'),

                        Forms\Components\Hidden::make('officer_date')
                            ->default(now()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('meetingRoom.room_name')
                    ->label('ห้องประชุม')
                    ->sortable(),

                Tables\Columns\TextColumn::make('book_date')
                    ->label('วันที่จอง')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('เวลา')
                    ->formatStateUsing(fn ($record) => $record->start_time . ' - ' . $record->finish_time . ' น.'),

                Tables\Columns\TextColumn::make('objective')
                    ->label('หัวข้อการประชุม')
                    ->searchable()
                    ->limit(45),

                Tables\Columns\TextColumn::make('requester.name')
                    ->label('ผู้ขอจอง')
                    ->formatStateUsing(fn ($record) => $record->requester ? $record->requester->prename . $record->requester->name . ' ' . $record->requester->surname : '-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('approve')
                    ->label('สถานะ')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        1 => 'success',
                        2 => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        1 => 'อนุมัติ',
                        2 => 'ไม่อนุมัติ',
                        default => 'รออนุมัติ',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room')
                    ->label('ห้องประชุม')
                    ->options(fn () => MeetingRoom::pluck('room_name', 'room_code')->toArray()),
                
                Tables\Filters\SelectFilter::make('approve')
                    ->label('สถานะการอนุมัติ')
                    ->options([
                        '1' => 'อนุมัติ',
                        '2' => 'ไม่อนุมัติ',
                        '0' => 'รออนุมัติ',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === '1') $query->where('approve', 1);
                        elseif ($data['value'] === '2') $query->where('approve', 2);
                        elseif ($data['value'] === '0') $query->whereNull('approve');
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
            ->defaultSort('book_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => MeetingMainResource\Pages\ListMeetingMains::route('/'),
            'create' => MeetingMainResource\Pages\CreateMeetingMain::route('/create'),
            'edit' => MeetingMainResource\Pages\EditMeetingMain::route('/{record}/edit'),
        ];
    }
}
