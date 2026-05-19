<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterCommand extends Model
{
    protected $table = 'bookregister_command';
    protected $primaryKey = 'ms_id';
    public $timestamps = false;

    protected $fillable = [
        'year',
        'register_number',
        'book_no',
        'signdate',
        'subject',
        'comment',
        'register_date',
        'officer',
        'file_name',
        'file_des',
    ];

    protected $casts = [
        'signdate' => 'date',
        'register_date' => 'date',
    ];
}
