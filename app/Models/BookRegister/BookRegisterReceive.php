<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterReceive extends Model
{
    protected $table = 'bookregister_receive';
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
        'record_type',
        'comment',
        'register_date',
        'ref_id',
        'officer',
        'book_link',
        'secret',
    ];

    protected $casts = [
        'signdate' => 'date',
        'register_date' => 'date',
    ];

    public function attachments()
    {
        return $this->hasMany(BookRegisterReceiveFilebook::class, 'ref_id', 'ref_id');
    }
}
