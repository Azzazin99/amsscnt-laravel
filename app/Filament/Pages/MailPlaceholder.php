<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MailPlaceholder extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope-open';

    protected string $view = 'filament.pages.placeholder-page';

    protected static \UnitEnum|string|null $navigationGroup = 'บริหารงานทั่วไป';

    protected static ?string $navigationLabel = 'ไปรษณีย์';

    protected static ?string $title = 'ระบบไปรษณีย์และหนังสือเวียน';

    protected static ?int $navigationSort = 4;

    public function getViewData(): array
    {
        return [
            'icon' => 'heroicon-o-envelope-open',
            'systemName' => 'ระบบไปรษณีย์และส่งหนังสือเวียน (Mail & Circular System)',
            'description' => 'ระบบจัดการเอกสารเวียน ทะเบียนคุมการส่งไปรษณีย์ และพัสดุราชการแบบครบวงจรของสำนักงานเขตพื้นที่การศึกษา',
        ];
    }
}
