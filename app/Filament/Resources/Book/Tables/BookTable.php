<?php

namespace App\Filament\Resources\Book\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class BookTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('bookno')
                    ->label('เลขที่หนังสือ')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('signdate')
                    ->label('ลงวันที่')
                    ->date()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('subject')
                    ->label('เรื่อง')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                \Filament\Tables\Columns\TextColumn::make('level')
                    ->label('ชั้นความเร็ว')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'gray',
                        2 => 'warning',
                        3 => 'orange',
                        4 => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        1 => 'ปกติ',
                        2 => 'ด่วน',
                        3 => 'ด่วนมาก',
                        4 => 'ด่วนที่สุด',
                        default => 'ปกติ',
                    }),

                \Filament\Tables\Columns\TextColumn::make('secret')
                    ->label('ชั้นความลับ')
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'success',
                        1 => 'info',
                        2 => 'warning',
                        3 => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        0 => 'ปกติ',
                        1 => 'ลับ',
                        2 => 'ลับมาก',
                        3 => 'ลับที่สุด',
                        default => 'ปกติ',
                    }),

                \Filament\Tables\Columns\TextColumn::make('recipients_count')
                    ->label('ผู้รับทั้งหมด')
                    ->counts('recipients')
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('send_date')
                    ->label('วันที่ส่ง')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('level')
                    ->label('ชั้นความเร็ว')
                    ->options([
                        1 => 'ปกติ',
                        2 => 'ด่วน',
                        3 => 'ด่วนมาก',
                        4 => 'ด่วนที่สุด',
                    ]),
                
                \Filament\Tables\Filters\SelectFilter::make('secret')
                    ->label('ชั้นความลับ')
                    ->options([
                        0 => 'ปกติ',
                        1 => 'ลับ',
                        2 => 'ลับมาก',
                        3 => 'ลับที่สุด',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
