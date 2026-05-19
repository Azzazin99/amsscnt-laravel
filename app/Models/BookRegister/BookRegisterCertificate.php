<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterCertificate extends Model
{
    protected $table = 'bookregister_certificate';
    protected $primaryKey = 'ms_id';
    public $timestamps = false;

    protected $fillable = [
        'year',
        'register_number',
        'numto',
        'book_no',
        'signdate',
        'name_cer',
        'subject',
        'subject2',
        'comment',
        'sign_person',
        'register_date',
        'officer',
        'file_name',
        'khet_print',
        'check_status',
        'quarantee',
        'quarantee_person',
        'quarantee_date',
    ];

    protected $casts = [
        'signdate' => 'date',
        'register_date' => 'date',
        'quarantee_date' => 'date',
        'khet_print' => 'boolean',
        'check_status' => 'boolean',
        'quarantee' => 'boolean',
    ];
}
