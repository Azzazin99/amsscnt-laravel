<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;
use App\Models\School;

class BookSendtoAnswer extends Model
{
    protected $table = 'book_sendto_answer';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'send_level',
        'ref_id',
        'send_to',
        'school',
        'status',
        'answer',
        'answer_time',
        'forward_from',
        'rec_forward_date',
    ];

    protected $casts = [
        'answer_time' => 'datetime',
        'rec_forward_date' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(BookMain::class, 'ref_id', 'ref_id');
    }

    public function targetSchool()
    {
        return $this->belongsTo(School::class, 'send_to', 'school_code');
    }
}
