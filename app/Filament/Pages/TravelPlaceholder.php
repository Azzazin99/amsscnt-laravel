<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class TravelPlaceholder extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';

    protected string $view = 'filament.pages.placeholder-page';

    protected static \UnitEnum|string|null $navigationGroup = 'บริหารงานทั่วไป';

    protected static ?string $navigationLabel = 'ขออนุญาตไปราชการ';

    protected static ?string $title = 'ขออนุมัติไปปฏิบัติราชการ';

    protected static ?int $navigationSort = 5;

    public function getViewData(): array
    {
        return [
            'icon' => 'heroicon-o-map',
            'systemName' => 'ระบบขออนุญาตไปราชการ (Official Travel Authorization)',
            'description' => 'ระบบการยื่นใบคำขออนุญาต ขออนุมัติเดินทางไปปฏิบัติราชการภายนอกพื้นที่ พร้อมคำนวณเบี้ยเลี้ยงและบันทึกสถิติการเดินทาง',
        ];
    }
}
