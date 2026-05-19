<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterSendFilebook extends Model
{
    protected $table = 'bookregister_send_filebook';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ref_id',
        'file_name',
        'file_des',
    ];

    public function outbound()
    {
        return $this->belongsTo(BookRegisterSend::class, 'ref_id', 'ref_id');
    }
}
