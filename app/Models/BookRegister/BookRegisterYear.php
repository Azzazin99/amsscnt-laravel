<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterYear extends Model
{
    protected $table = 'bookregister_year';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'year',
        'year_active',
        'start_receive_num',
        'start_send_num',
        'start_command_num',
        'start_cer_num',
        'school_code',
        'officer',
        'rec_date',
    ];

    protected $casts = [
        'rec_date' => 'date',
        'year_active' => 'boolean',
    ];
}
