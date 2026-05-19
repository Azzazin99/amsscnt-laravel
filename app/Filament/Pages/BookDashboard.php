<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Book\BookMain;
use App\Models\Book\BookFilebook;
use Illuminate\Support\Facades\DB;

class BookDashboard extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected string $view = 'filament.pages.book-local-dashboard';

    protected static \UnitEnum|string|null $navigationGroup = 'บริหารงานทั่วไป';

    protected static ?string $navigationLabel = 'รับส่งหนังสือราชการ';

    protected static ?string $title = 'รับส่งหนังสือราชการ';

    protected static ?int $navigationSort = 3;

    // Livewire state properties
    public string $activeTab = 'receive'; // 'receive', 'send', 'publish', 'unreceived_3_days', 'older_2_years', 'manual'
    public string $search = '';
    public string $searchType = 'subject'; // 'subject', 'bookno'
    public int $page = 0;
    public int $perPage = 15;

    // Send Form properties
    public string $outboundBookNo = '';
    public string $outboundSubject = '';
    public string $outboundLevel = '1';
    public bool $isSubmitted = false;

    public function updatedActiveTab(): void
    {
        $this->search = '';
        $this->page = 0;
        $this->searchType = 'subject';
        $this->isSubmitted = false;
    }

    public function updatedSearch(): void
    {
        $this->page = 0;
    }

    public function updatedSearchType(): void
    {
        $this->page = 0;
    }

    public function nextPage(): void
    {
        $this->page++;
    }

    public function previousPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function setPage(int $pageNumber): void
    {
        $this->page = $pageNumber;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->updatedActiveTab();
    }

    public function submitOutboundDoc(): void
    {
        $this->isSubmitted = true;
        $this->outboundBookNo = '';
        $this->outboundSubject = '';
        $this->outboundLevel = '1';
        
        \Filament\Notifications\Notification::make()
            ->title('ส่งหนังสือราชการเรียบร้อยแล้ว')
            ->success()
            ->send();
    }

    public function getViewData(): array
    {
        // Ensure mock files are set up for local development testing
        $this->ensureMockFilesAreSetup();

        // 1. If tab is manual, return static guide views
        if ($this->activeTab === 'manual') {
            return [
                'books' => collect(),
                'totalItems' => 0,
                'showingStart' => 0,
                'showingEnd' => 0,
                'totalPages' => 1,
                'pagesToShow' => [],
                'systemName' => 'คู่มือการใช้งานระบบรับส่งหนังสือราชการ',
                'description' => 'ขั้นตอนและคำแนะนำเกี่ยวกับการสืบค้น ค้นหา หรือจัดส่งเอกสารหนังสือราชการภายในองค์กร',
            ];
        }

        // 2. If tab is publish, return outbound empty state
        if ($this->activeTab === 'publish') {
            return [
                'books' => collect(),
                'totalItems' => 0,
                'showingStart' => 0,
                'showingEnd' => 0,
                'totalPages' => 1,
                'pagesToShow' => [],
                'systemName' => 'ส่งหนังสือราชการ (Outbound Document)',
                'description' => 'ส่งเอกสารหรือหนังสือราชการไปยังโรงเรียนและหน่วยงานปลายทางอย่างรวดเร็วและปลอดภัย',
            ];
        }

        // 3. Query book_main using Eloquent ORM
        $query = BookMain::query();

        // Filter depending on active tab
        if ($this->activeTab === 'receive') {
            $query->where('book_type', 1); // Local Inbound
        } elseif ($this->activeTab === 'send') {
            $query->where('book_type', 2); // Local Outbound
        } elseif ($this->activeTab === 'unreceived_3_days') {
            $query->where('book_type', 1)
                  ->where('send_date', '<=', now()->subDays(3));
        } elseif ($this->activeTab === 'older_2_years') {
            $query->where('send_date', '<=', now()->subYears(2));
        }

        // Apply real-time search filters
        if (!empty(trim($this->search))) {
            $searchTerm = '%' . trim($this->search) . '%';
            if ($this->searchType === 'bookno') {
                $query->where('bookno', 'like', $searchTerm);
            } else {
                $query->where('subject', 'like', $searchTerm);
            }
        }

        // Count total items matching search
        $totalItems = $query->count();

        // Calculate paging details
        $totalPages = (int) ceil($totalItems / $this->perPage);
        if ($totalPages < 1) {
            $totalPages = 1;
        }

        // Default to the last page (showing latest data) if not set
        if ($this->page === 0) {
            $this->page = $totalPages;
        }

        // Keep page within boundaries
        if ($this->page > $totalPages) {
            $this->page = $totalPages;
        }
        if ($this->page < 1) {
            $this->page = 1;
        }

        $offset = ($this->page - 1) * $this->perPage;

        // Fetch records sorted ascending so that the latest records are on the last page
        $books = $query->orderBy('send_date', 'asc')
                       ->offset($offset)
                       ->limit($this->perPage)
                       ->get();

        // Map database fields to premium display properties
        $books = $books->map(function ($book) {
            // Map levels: 4 = ด่วนที่สุด, 3 = ด่วนมาก, 2 = ด่วน, 1 = ปกติ
            switch ($book->level) {
                case 4:
                    $book->level_text = 'ด่วนที่สุด';
                    $book->level_color = 'bg-red-500 border border-red-400/30';
                    break;
                case 3:
                    $book->level_text = 'ด่วนมาก';
                    $book->level_color = 'bg-orange-500 border border-orange-400/30';
                    break;
                case 2:
                    $book->level_text = 'ด่วน';
                    $book->level_color = 'bg-yellow-400 border border-yellow-300/30';
                    break;
                case 1:
                default:
                    $book->level_text = 'ปกติ';
                    $book->level_color = 'bg-green-500 border border-green-400/30';
                    break;
            }

            $book->display_subject = rtrim($book->subject, '*');

            // Format date for display in Thai Buddhist Era (พ.ศ.)
            $thaiMonth = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];

            try {
                if ($book->signdate) {
                    $timestamp = strtotime($book->signdate);
                    $day = date('j', $timestamp);
                    $month = $thaiMonth[(int)date('n', $timestamp)];
                    $year = (int)date('Y', $timestamp) + 543;
                    $book->display_signdate = "$day $month $year";
                } else {
                    $book->display_signdate = '-';
                }
            } catch (\Exception $e) {
                $book->display_signdate = $book->signdate;
            }

            try {
                if ($book->send_date) {
                    $timestamp = strtotime($book->send_date);
                    $day = date('j', $timestamp);
                    $month = $thaiMonth[(int)date('n', $timestamp)];
                    $year = (int)date('Y', $timestamp) + 543;
                    $time = date('H:i:s', $timestamp);
                    $book->display_send_date = "$day $month $year $time น.";
                } else {
                    $book->display_send_date = '-';
                }
            } catch (\Exception $e) {
                $book->display_send_date = $book->send_date;
            }

            // Fetch office name from system_khet
            $officeName = DB::table('system_khet')
                ->where('code', (string)$book->office)
                ->value('precis') ?: DB::table('system_khet')
                ->where('code', (string)$book->office)
                ->value('name');

            $book->display_sender = $officeName ?: ($book->office ?: 'หน่วยงานภายในเขต');

            // Query attached files
            $attachedFiles = BookFilebook::query()
                ->where('ref_id', $book->ref_id)
                ->select('file_name', 'file_des')
                ->get();

            $book->attached_files = $attachedFiles;
            $book->has_files = $attachedFiles->isNotEmpty();

            return $book;
        });

        // Compute showing records description
        $showingStart = $offset + 1;
        $showingEnd = min($offset + $this->perPage, $totalItems);
        if ($totalItems === 0) {
            $showingStart = 0;
            $showingEnd = 0;
        }

        $pagesToShow = [];
        $startPage = max(1, $this->page - 2);
        $endPage = min($totalPages, $this->page + 2);
        for ($i = $startPage; $i <= $endPage; $i++) {
            $pagesToShow[] = $i;
        }

        return [
            'books' => $books,
            'totalItems' => $totalItems,
            'showingStart' => $showingStart,
            'showingEnd' => $showingEnd,
            'totalPages' => $totalPages,
            'pagesToShow' => $pagesToShow,
            'systemName' => 'ระบบรับส่งหนังสือราชการ',
            'description' => 'ระบบสืบค้น ตรวจสอบ และบริหารจัดการหนังสือราชการเข้า-ออกของเขตพื้นที่การศึกษา',
        ];
    }

    protected function ensureMockFilesAreSetup(): void
    {
        try {
            $refId = '1772439541x1303494047';
            $dir = public_path('modules/book/upload_files');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $destPdf = $dir . '/' . $refId . '_1.pdf';
            if (!file_exists($destPdf)) {
                $srcPdf = '/Users/akkawatjunthon/Website/smart_kpp2/modules/idocument/upload_files/8-attach-1771812291_1.pdf';
                if (file_exists($srcPdf)) {
                    copy($srcPdf, $destPdf);
                }
            }
        } catch (\Exception $e) {
            logger()->warning('Failed to automate mock file setup in BookDashboard: ' . $e->getMessage());
        }
    }
}
