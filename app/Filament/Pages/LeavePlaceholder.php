<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LeavePlaceholder extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected string $view = 'filament.pages.placeholder-page';

    protected static \UnitEnum|string|null $navigationGroup = 'บริหารงานทั่วไป';

    protected static ?string $navigationLabel = 'การลา';

    protected static ?string $title = 'ระบบการลาและบันทึกสถิติ';

    protected static ?int $navigationSort = 6;

    public function getViewData(): array
    {
        return [
            'icon' => 'heroicon-o-clipboard-document-check',
            'systemName' => 'ระบบขออนุมัติการลา (Leave Management System)',
            'description' => 'ระบบยื่นใบลาอิเล็กทรอนิกส์ (ลาป่วย, ลากิจ, ลาพักผ่อน) สำหรับข้าราชการครูและบุคลากรทางการศึกษา พร้อมตารางสถิติตามโควตาประจำปี พ.ศ.',
        ];
    }
}
