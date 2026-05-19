<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookFilebook extends Model
{
    protected $table = 'book_filebook';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ref_id',
        'file_name',
        'file_des',
    ];

    public function book()
    {
        return $this->belongsTo(BookMain::class, 'ref_id', 'ref_id');
    }
}
