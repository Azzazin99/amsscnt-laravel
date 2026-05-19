<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookMain extends Model
{
    protected $table = 'book_main';
    protected $primaryKey = 'ms_id';
    public $timestamps = false;

    protected $fillable = [
        'book_type',
        'sender',
        'office',
        'level',
        'secret',
        'bookno',
        'signdate',
        'subject',
        'detail',
        'ref_id',
        'send_date',
        'bookregis_link',
    ];

    protected $casts = [
        'signdate' => 'date',
        'send_date' => 'datetime',
    ];

    public function recipients()
    {
        return $this->hasMany(BookSendtoAnswer::class, 'ref_id', 'ref_id');
    }

    public function attachments()
    {
        return $this->hasMany(BookFilebook::class, 'ref_id', 'ref_id');
    }
}
