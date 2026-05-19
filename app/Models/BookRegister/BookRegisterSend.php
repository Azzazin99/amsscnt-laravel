<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterSend extends Model
{
    protected $table = 'bookregister_send';
    protected $primaryKey = 'ms_id';
    public $timestamps = false;

    protected $fillable = [
        'year',
        'register_number',
        'book_no',
        'signdate',
        'book_from',
        'book_to',
        'subject',
        'operation',
        'workgroup',
        'comment',
        'register_date',
        'ref_id',
        'officer',
        'secret',
        'office_type',
    ];

    protected $casts = [
        'signdate' => 'date',
        'register_date' => 'date',
    ];

    public function attachments()
    {
        return $this->hasMany(BookRegisterSendFilebook::class, 'ref_id', 'ref_id');
    }
}
