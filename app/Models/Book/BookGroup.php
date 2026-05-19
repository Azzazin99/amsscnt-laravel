<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookGroup extends Model
{
    protected $table = 'book_group';
    protected $primaryKey = 'grp_id';
    public $timestamps = false;

    protected $fillable = [
        'grp_name',
    ];

    public function members()
    {
        return $this->hasMany(BookGroupMember::class, 'grp_id', 'grp_id');
    }
}
