<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\BookRegister\BookRegisterReceive;
use App\Models\BookRegister\BookRegisterSend;
use App\Models\BookRegister\BookRegisterCommand;
use App\Models\BookRegister\BookRegisterCertificate;
use Illuminate\Support\Facades\DB;

use Livewire\WithFileUploads;

class BookRegisterDashboard extends Page
{
    use WithFileUploads;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';

    protected string $view = 'filament.pages.book-register-dashboard';

    protected static \UnitEnum|string|null $navigationGroup = 'บริหารงานทั่วไป';

    protected static ?string $navigationLabel = 'ทะเบียนหนังสือราชการ';

    protected static ?string $title = 'ทะเบียนหนังสือราชการ';

    protected static ?int $navigationSort = 2;

    // Livewire state properties
    public string $activeTab = 'receive'; // 'receive', 'send', 'command', 'certificate', 'manual'
    public string $search = '';
    public string $searchType = 'subject'; // default search type
    public int $page = 0; // 0 means uninitialized/reset page state
    public int $perPage = 15;

    // Modal & Register Form properties matching the old mock screen exactly
    public bool $showRegisterForm = false;
    public string $regBookNo = '';
    public string $regSubject = '';
    public string $regBookFrom = '';
    public string $regSchoolSearch = '';
    public string $regSignDate = '';
    public string $regBookTo = 'สำนักงานเขตพื้นที่การศึกษา'; // Default from image
    public string $regWorkgroup = '1'; // Default group
    public string $regOfficer = ''; // บุคคลปฏิบัติ
    public string $regComment = 'เอกสารกระดาษ'; // Default from image
    public int $regSecret = 0; // Importance: 0=ปกติ, 1=ด่วน, 2=ด่วนมาก, 3=ด่วนที่สุด
    
    // Multi-file drag and drop properties
    public $regFiles = [];
    public array $regFileDescriptions = [];

    public function openRegisterModal(): void
    {
        $this->resetForm();
        $this->showRegisterForm = true;
    }

    public function closeRegisterModal(): void
    {
        $this->showRegisterForm = false;
    }

    public function resetForm(): void
    {
        $this->regBookNo = '';
        $this->regSubject = '';
        $this->regBookFrom = '';
        $this->regSchoolSearch = '';
        $this->regSignDate = date('Y-m-d');
        $this->regBookTo = 'สำนักงานเขตพื้นที่การศึกษา';
        $this->regWorkgroup = '1';
        $this->regOfficer = '';
        $this->regComment = 'เอกสารกระดาษ';
        $this->regSecret = 0;
        $this->regFiles = [];
        $this->regFileDescriptions = [];
        $this->resetErrorBag();
    }

    public function removeFile(int $index): void
    {
        if (isset($this->regFiles[$index])) {
            unset($this->regFiles[$index]);
            $this->regFiles = array_values($this->regFiles);
        }
        if (isset($this->regFileDescriptions[$index])) {
            unset($this->regFileDescriptions[$index]);
            $this->regFileDescriptions = array_values($this->regFileDescriptions);
        }
    }

    public function registerInboundBook(): void
    {
        $this->validate([
            'regBookNo' => 'required|string',
            'regSubject' => 'required|string',
            'regBookFrom' => 'required|string',
            'regSignDate' => 'required|date',
            'regBookTo' => 'required|string',
            'regWorkgroup' => 'required|string',
            'regFiles.*' => 'nullable|file|max:5120|mimes:doc,docx,pdf,xls,xlsx,gif,jpg,png,zip,rar',
        ], [
            'regBookNo.required' => 'กรุณากรอกเลขที่หนังสือ',
            'regSubject.required' => 'กรุณากรอกเรื่องหนังสือ',
            'regBookFrom.required' => 'กรุณาระบุหน่วยงานต้นทาง (จาก)',
            'regSignDate.required' => 'กรุณาระบุวันที่ลงนาม',
            'regBookTo.required' => 'กรุณาระบุผู้รับ (ถึง)',
            'regFiles.*.max' => 'ขนาดไฟล์ต้องไม่เกิน 5 MB ต่อไฟล์',
            'regFiles.*.mimes' => 'รองรับเฉพาะไฟล์ doc, docx, pdf, xls, xlsx, gif, jpg, zip, rar เท่านั้น',
        ]);

        $activeYear = \App\Models\BookRegister\BookRegisterYear::where('year_active', true)->first();
        $currentYear = $activeYear ? $activeYear->year : ((int) date('Y') + 543);
        
        $maxRegNum = BookRegisterReceive::where('year', $currentYear)->max('register_number');
        if ($maxRegNum) {
            $nextRegNum = $maxRegNum + 1;
        } else {
            $nextRegNum = $activeYear ? $activeYear->start_receive_num : 1;
        }

        $fromVal = $this->regBookFrom;
        if (!empty($this->regSchoolSearch)) {
            $fromVal .= ' (' . $this->regSchoolSearch . ')';
        }

        $book = BookRegisterReceive::create([
            'year' => $currentYear,
            'register_number' => $nextRegNum,
            'book_no' => $this->regBookNo,
            'signdate' => $this->regSignDate,
            'book_from' => $fromVal,
            'book_to' => $this->regBookTo,
            'subject' => $this->regSubject,
            'operation' => $this->regOfficer ?: '-',
            'workgroup' => (int) $this->regWorkgroup,
            'record_type' => 1,
            'comment' => $this->regComment,
            'register_date' => now()->format('Y-m-d'),
            'ref_id' => 'REG-' . time() . '-' . rand(1000, 9999),
            'officer' => auth()->id() ?? '1',
            'book_link' => 0,
            'secret' => (int) $this->regSecret,
        ]);

        // Save drag-and-drop attachments
        if (!empty($this->regFiles)) {
            foreach ($this->regFiles as $index => $file) {
                // Generate a unique safe filename
                $filename = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                
                // Ensure directory exists
                $destinationPath = public_path('modules/book/upload_files');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                // Move file to public directory
                $file->move($destinationPath, $filename);
                
                // Map display name and file description
                $originalName = $file->getClientOriginalName();
                $customDes = $this->regFileDescriptions[$index] ?? '';
                $displayName = !empty($customDes) ? $customDes : $originalName;
                
                $book->attachments()->create([
                    'file_name' => $displayName,
                    'file_des' => $filename,
                    'ref_id' => $book->ref_id,
                ]);
            }
        }

        $this->showRegisterForm = false;
        $this->resetForm();
        $this->page = 0; // Reset page to jump to latest

        \Filament\Notifications\Notification::make()
            ->title('ลงทะเบียนหนังสือรับเรียบร้อยแล้ว')
            ->body("เลขทะเบียนรับที่: {$nextRegNum}/{$currentYear}")
            ->success()
            ->send();
    }

    public function updatedActiveTab(): void
    {
        $this->search = '';
        $this->page = 0;
        
        // Adjust default search types per tab
        if ($this->activeTab === 'certificate') {
            $this->searchType = 'name_cer';
        } else {
            $this->searchType = 'subject';
        }
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

    public function getViewData(): array
    {
        // Execute automatic mock files copy on load
        $this->ensureMockFilesAreSetup();

        // 1. If tab is manual, return static manual view parameters
        if ($this->activeTab === 'manual') {
            return [
                'systemName' => 'คู่มือการใช้งานระบบทะเบียนหนังสือราชการ',
                'description' => 'เอกสารแนะนำขั้นตอนการใช้งานระบบจัดเก็บ ค้นหา และสืบค้นทะเบียนเอกสารสารบรรณอย่างละเอียด',
                'totalPages' => 1,
                'totalItems' => 0,
                'showingStart' => 0,
                'showingEnd' => 0,
                'pagesToShow' => [],
            ];
        }

        // 2. Select query, columns, sorting, and data mapping depending on activeTab
        $query = null;
        $workgroupMap = [
            0 => 'ผู้บริหาร สพป.สงขลา เขต 2',
            1 => 'กลุ่มอำนวยการ',
            2 => 'กลุ่มนโยบายและแผน',
            3 => 'กลุ่มส่งเสริมการศึกษาทางไกลฯ',
            4 => 'กลุ่มบริหารงานบุคคล',
            5 => 'กลุ่มพัฒนาครูและบุคลากรฯ',
            6 => 'กลุ่มส่งเสริมการจัดการศึกษา',
            7 => 'กลุ่มนิเทศติดตามและประเมินผลฯ',
            8 => 'กลุ่มบริหารงานการเงินและสินทรัพย์',
            9 => 'หน่วยตรวจสอบภายใน',
            10 => 'กลุ่มกฎหมายและคดี',
        ];

        if ($this->activeTab === 'receive') {
            $query = BookRegisterReceive::query();
            if (!empty(trim($this->search))) {
                $searchTerm = '%' . trim($this->search) . '%';
                if ($this->searchType === 'book_no') {
                    $query->where('book_no', 'like', $searchTerm);
                } elseif ($this->searchType === 'book_from') {
                    $query->where('book_from', 'like', $searchTerm);
                } else {
                    $query->where('subject', 'like', $searchTerm);
                }
            }
        } elseif ($this->activeTab === 'send') {
            $query = BookRegisterSend::query();
            if (!empty(trim($this->search))) {
                $searchTerm = '%' . trim($this->search) . '%';
                if ($this->searchType === 'book_no') {
                    $query->where('book_no', 'like', $searchTerm);
                } elseif ($this->searchType === 'book_to') {
                    $query->where('book_to', 'like', $searchTerm);
                } else {
                    $query->where('subject', 'like', $searchTerm);
                }
            }
        } elseif ($this->activeTab === 'command') {
            $query = BookRegisterCommand::query();
            if (!empty(trim($this->search))) {
                $searchTerm = '%' . trim($this->search) . '%';
                if ($this->searchType === 'book_no') {
                    $query->where('book_no', 'like', $searchTerm);
                } else {
                    $query->where('subject', 'like', $searchTerm);
                }
            }
        } elseif ($this->activeTab === 'certificate') {
            $query = BookRegisterCertificate::query();
            if (!empty(trim($this->search))) {
                $searchTerm = '%' . trim($this->search) . '%';
                if ($this->searchType === 'subject') {
                    $query->where('subject', 'like', $searchTerm);
                } else {
                    $query->where('name_cer', 'like', $searchTerm);
                }
            }
        }

        // Compute total items and page bounds
        $totalItems = $query->count();
        $totalPages = (int) ceil($totalItems / $this->perPage);
        if ($totalPages < 1) {
            $totalPages = 1;
        }

        if ($this->page === 0) {
            $this->page = $totalPages;
        }
        if ($this->page > $totalPages) {
            $this->page = $totalPages;
        }
        if ($this->page < 1) {
            $this->page = 1;
        }

        $offset = ($this->page - 1) * $this->perPage;

        // Fetch data
        $books = [];
        if ($this->activeTab === 'receive') {
            $books = $query->with('attachments')
                           ->orderBy('ms_id', 'asc')
                           ->offset($offset)
                           ->limit($this->perPage)
                           ->get()
                           ->map(function ($book) use ($workgroupMap) {
                               $book->display_subject = rtrim($book->subject, '*');
                               $book->display_signdate = $this->formatThaiDate($book->signdate);
                               $book->display_register_date = $this->formatThaiDate($book->register_date);
                               $book->display_workgroup = $workgroupMap[$book->workgroup] ?? ('กลุ่มงานทั่วไป (' . $book->workgroup . ')');
                               return $book;
                           });
        } elseif ($this->activeTab === 'send') {
            $books = $query->with('attachments')
                           ->orderBy('ms_id', 'asc')
                           ->offset($offset)
                           ->limit($this->perPage)
                           ->get()
                           ->map(function ($book) use ($workgroupMap) {
                               $book->display_subject = rtrim($book->subject, '*');
                               $book->display_signdate = $this->formatThaiDate($book->signdate);
                               $book->display_register_date = $this->formatThaiDate($book->register_date);
                               $book->display_workgroup = $workgroupMap[$book->workgroup] ?? ('กลุ่มงานทั่วไป (' . $book->workgroup . ')');
                               return $book;
                           });
        } elseif ($this->activeTab === 'command') {
            $books = $query->orderBy('ms_id', 'asc')
                           ->offset($offset)
                           ->limit($this->perPage)
                           ->get()
                           ->map(function ($book) {
                               $book->display_subject = rtrim($book->subject, '*');
                               $book->display_signdate = $this->formatThaiDate($book->signdate);
                               $book->display_register_date = $this->formatThaiDate($book->register_date);
                               $book->has_file = !empty($book->file_name);
                               return $book;
                           });
        } elseif ($this->activeTab === 'certificate') {
            $books = $query->orderBy('ms_id', 'asc')
                           ->offset($offset)
                           ->limit($this->perPage)
                           ->get()
                           ->map(function ($book) {
                               $book->display_subject = rtrim($book->subject, '*');
                               $book->display_subject2 = rtrim($book->subject2, '*');
                               $book->display_signdate = $this->formatThaiDate($book->signdate);
                               $book->display_register_date = $this->formatThaiDate($book->register_date);
                               $book->has_file = !empty($book->file_name);
                               return $book;
                           });
        }

        $showingStart = $offset + 1;
        $showingEnd = min($offset + $this->perPage, $totalItems);
        if ($totalItems === 0) {
            $showingStart = 0;
            $showingEnd = 0;
        }

        // Generate slide list of pages around current page
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
            'systemName' => 'ระบบสมุดทะเบียนคุมหนังสือราชการและคลังเอกสาร',
            'description' => 'ค้นหาและติดตาม ทะเบียนหนังสือรับ หนังสือส่ง คำสั่ง และเกียรติบัตรอิเล็กทรอนิกส์ สำนักงานเขตพื้นที่การศึกษาประถมศึกษาประจวบคีรีขันธ์ เขต 2',
        ];
    }

    /**
     * Format PHP Date string into Thai Buddhist Era.
     */
    protected function formatThaiDate($dateString): string
    {
        if (empty($dateString)) {
            return '-';
        }

        $thaiMonth = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];

        try {
            $timestamp = strtotime($dateString);
            $day = date('j', $timestamp);
            $month = $thaiMonth[(int)date('n', $timestamp)];
            $year = (int)date('Y', $timestamp) + 543;
            return "$day $month $year";
        } catch (\Exception $e) {
            return '-';
        }
    }

    /**
     * Copy mock PDF documents for local testing across all 4 registries.
     */
    protected function ensureMockFilesAreSetup(): void
    {
        try {
            // Setup folder for commands (upload_files3)
            $dir3 = public_path('modules/bookregister/upload_files3');
            if (!is_dir($dir3)) {
                mkdir($dir3, 0755, true);
            }

            // Setup folder for certificates (upload_files4)
            $dir4 = public_path('modules/bookregister/upload_files4');
            if (!is_dir($dir4)) {
                mkdir($dir4, 0755, true);
            }

            $srcPdf = '/Users/akkawatjunthon/Website/smart_kpp2/modules/idocument/upload_files/8-attach-1771812291_1.pdf';

            if (file_exists($srcPdf)) {
                // Copy for commands
                $commandMock = ['1769573257x441770569.pdf', '1769573909x434345815.pdf', '1769573943x161857871.pdf'];
                foreach ($commandMock as $fn) {
                    $dest = $dir3 . '/' . $fn;
                    if (!file_exists($dest)) {
                        copy($srcPdf, $dest);
                    }
                }
            }
        } catch (\Exception $e) {
            logger()->warning('Failed to automate mock registry files setup: ' . $e->getMessage());
        }
    }
}
