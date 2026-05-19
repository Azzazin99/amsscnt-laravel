<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterReceiveFilebook extends Model
{
    protected $table = 'bookregister_receive_filebook';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ref_id',
        'file_name',
        'file_des',
    ];

    public function receive()
    {
        return $this->belongsTo(BookRegisterReceive::class, 'ref_id', 'ref_id');
    }
}
