<?php
define('LARAVEL_START', microtime(true));

// Load Laravel autoloader and bootstrap app
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Setting up mock files...\n";

// Create destination directory
$dir = public_path('modules/book/upload_files');
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "Created directory: $dir\n";
}

// Copy files
$srcPdf = '/Users/akkawatjunthon/Website/smart_kpp2/modules/idocument/upload_files/8-attach-1771812291_1.pdf';
$srcDocx = '/Users/akkawatjunthon/Website/smart_kpp2/modules/idocument/upload_files/10-sent-1771821166_1.docx';

$destPdf = $dir . '/1772439541x1303494047_1.pdf';
$destDocx = $dir . '/1772439541x1303494047_2.docx';

if (file_exists($srcPdf)) {
    copy($srcPdf, $destPdf);
    echo "Copied PDF from $srcPdf to $destPdf\n";
} else {
    echo "ERROR: Source PDF not found at $srcPdf\n";
}

if (file_exists($srcDocx)) {
    copy($srcDocx, $destDocx);
    echo "Copied DOCX from $srcDocx to $destDocx\n";
} else {
    echo "ERROR: Source DOCX not found at $srcDocx\n";
}

// Reset PostgreSQL sequence
try {
    DB::statement("SELECT setval('book_filebook_id_seq', (SELECT COALESCE(MAX(id), 0) + 1 FROM book_filebook), false)");
    echo "PostgreSQL sequence reset successfully!\n";
} catch (\Exception $e) {
    echo "Sequence reset warning: " . $e->getMessage() . "\n";
}

// Insert database records
echo "Inserting database records...\n";
DB::table('book_filebook')->where('ref_id', '1772439541x1303494047')->delete();

$maxId = DB::table('book_filebook')->max('id') ?: 0;

DB::table('book_filebook')->insert([
    [
        'id' => $maxId + 1,
        'ref_id' => '1772439541x1303494047',
        'file_name' => '1772439541x1303494047_1.pdf',
        'file_des' => 'หนังสือประชาสัมพันธ์โครงการ ESPORTS'
    ],
    [
        'id' => $maxId + 2,
        'ref_id' => '1772439541x1303494047',
        'file_name' => '1772439541x1303494047_2.docx',
        'file_des' => 'แบบสอบถามโครงการ'
    ]
]);

echo "Database records inserted successfully!\n";
