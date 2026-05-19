<?php

namespace App\Filament\Resources\Car;

use App\Models\Car\CarCar;
use App\Models\Car\CarDriver;
use App\Models\Car\CarMain;
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

class CarMainResource extends Resource
{
    protected static ?string $model = CarMain::class;

    protected static \UnitEnum|string|null $navigationGroup = 'ระบบยานพาหนะ';
    protected static ?string $navigationLabel = 'จองยานพาหนะ';
    protected static ?string $pluralLabel = 'จองยานพาหนะ';
    protected static ?string $modelLabel = 'การจองยานพาหนะ';
    protected static ?int $navigationSort = 1;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    // Strict Business Logic: Only allow editing bookings starting today or in the future
    public static function canEdit(Model $record): bool
    {
        return $record->car_start ? $record->car_start->greaterThanOrEqualTo(now()->startOfDay()) : true;
    }

    // Strict Business Logic: Only allow deleting bookings starting today or in the future
    public static function canDelete(Model $record): bool
    {
        return $record->car_start ? $record->car_start->greaterThanOrEqualTo(now()->startOfDay()) : true;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('ข้อมูลผู้จอง & ยานพาหนะ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('person_id')
                                    ->label('ผู้ขอจอง')
                                    ->required()
                                    ->options(fn () => Person::all()->mapWithKeys(fn ($p) => [$p->person_id => $p->prename . $p->name . ' ' . $p->surname])->toArray())
                                    ->default(fn () => auth()->id() ?? '1'),

                                Forms\Components\Select::make('car')
                                    ->label('เลือกยานพาหนะ')
                                    ->required()
                                    ->options(fn () => CarCar::where('status', 3)->pluck('name', 'car_code')->toArray()),

                                Forms\Components\TextInput::make('person_num')
                                    ->label('จำนวนผู้ร่วมเดินทาง (คน)')
                                    ->numeric()
                                    ->required(),
                            ]),

                        \Filament\Schemas\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\DatePicker::make('car_start')
                                    ->label('วันที่เริ่มเดินทาง')
                                    ->required()
                                    ->minDate(now()->startOfDay()) // Block past bookings
                                    ->default(now()),

                                Forms\Components\TextInput::make('time_start')
                                    ->label('เวลาเดินทางไป (เช่น 08.30)')
                                    ->numeric(),

                                Forms\Components\DatePicker::make('car_finish')
                                    ->label('วันที่เดินทางกลับ')
                                    ->required()
                                    ->minDate(now()->startOfDay()) // Block past bookings
                                    ->default(now()),

                                Forms\Components\TextInput::make('time_finish')
                                    ->label('เวลาเดินทางกลับ (เช่น 16.30)')
                                    ->numeric(),
                            ]),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('day_total')
                                    ->label('จำนวนวันทั้งหมด')
                                    ->numeric(),

                                Forms\Components\TextInput::make('control_person')
                                    ->label('ผู้ควบคุม / หัวหน้าคณะ')
                                    ->maxLength(100),
                            ]),

                        Forms\Components\Hidden::make('rec_date')
                            ->default(now()),
                    ]),

                \Filament\Schemas\Components\Section::make('จุดหมาย & รายละเอียดภารกิจ')
                    ->schema([
                        Forms\Components\TextInput::make('place')
                            ->label('สถานที่ปลายทาง')
                            ->required()
                            ->maxLength(200),

                        Forms\Components\TextInput::make('because')
                            ->label('วัตถุประสงค์ / ภารกิจเพื่อ')
                            ->required()
                            ->maxLength(200),

                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('project')
                                    ->label('โครงการ')
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('activity')
                                    ->label('กิจกรรม')
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('money')
                                    ->label('งบประมาณค่าใช้จ่าย (บาท)')
                                    ->numeric(),
                            ]),
                    ]),

                \Filament\Schemas\Components\Section::make('รายละเอียดพนักงานขับรถ & การสนับสนุน')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('fuel')
                                    ->label('ขอสนับสนุนน้ำมันเชื้อเพลิง')
                                    ->inline(false),

                                Forms\Components\Toggle::make('self_driver')
                                    ->label('ขับรถยนต์ราชการเอง')
                                    ->inline(false),

                                Forms\Components\Select::make('driver')
                                    ->label('เลือกพนักงานขับรถ')
                                    ->options(fn () => CarDriver::where('status', 1)->get()->mapWithKeys(fn ($d) => [$d->person_id => $d->driverPerson ? $d->driverPerson->prename . $d->driverPerson->name . ' ' . $d->driverPerson->surname : '-'])->toArray()),
                            ]),
                    ]),

                \Filament\Schemas\Components\Section::make('กรณีใช้รถส่วนบุคคลในการปฏิบัติราชการ')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Toggle::make('private_car')
                                    ->label('ใช้รถยนต์ส่วนบุคคล')
                                    ->inline(false),

                                Forms\Components\TextInput::make('car_owner')
                                    ->label('เจ้าของรถ')
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('private_car_number')
                                    ->label('หมายเลขทะเบียนรถ')
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('private_driver')
                                    ->label('ผู้ขับขี่')
                                    ->maxLength(100),
                            ]),
                    ]),

                \Filament\Schemas\Components\Section::make('ส่วนพิจารณาและอนุมัติ (ผู้บังคับบัญชา)')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('commander_grant')
                                    ->label('สถานะการพิจารณา')
                                    ->options([
                                        null => 'รอการอนุมัติ',
                                        1 => 'อนุมัติการเดินทาง',
                                        2 => 'ไม่อนุมัติการเดินทาง',
                                    ])
                                    ->default(null),

                                Forms\Components\TextInput::make('grant_comment')
                                    ->label('ความคิดเห็นเพิ่มเติม / คำสั่ง')
                                    ->maxLength(150),
                            ]),

                        Forms\Components\Hidden::make('commander_sign')
                            ->default(fn () => auth()->id() ?? '1'),

                        Forms\Components\Hidden::make('commander_date')
                            ->default(now()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bookedCar.name')
                    ->label('รถราชการ')
                    ->default('รถส่วนบุคคล / ขับเอง')
                    ->sortable(),

                Tables\Columns\TextColumn::make('car_start')
                    ->label('วันที่ไป')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('car_finish')
                    ->label('วันที่กลับ')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('place')
                    ->label('สถานที่ปลายทาง')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('requester.name')
                    ->label('ผู้ขอจอง')
                    ->formatStateUsing(fn ($record) => $record->requester ? $record->requester->prename . $record->requester->name . ' ' . $record->requester->surname : '-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('commander_grant')
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
                Tables\Filters\SelectFilter::make('car')
                    ->label('ยานพาหนะ')
                    ->options(fn () => CarCar::pluck('name', 'car_code')->toArray()),

                Tables\Filters\SelectFilter::make('commander_grant')
                    ->label('สถานะการอนุมัติ')
                    ->options([
                        '1' => 'อนุมัติ',
                        '2' => 'ไม่อนุมัติ',
                        '0' => 'รออนุมัติ',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === '1') $query->where('commander_grant', 1);
                        elseif ($data['value'] === '2') $query->where('commander_grant', 2);
                        elseif ($data['value'] === '0') $query->whereNull('commander_grant');
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
            ->defaultSort('car_start', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => CarMainResource\Pages\ListCarMains::route('/'),
            'create' => CarMainResource\Pages\CreateCarMain::route('/create'),
            'edit' => CarMainResource\Pages\EditCarMain::route('/{record}/edit'),
        ];
    }
}
