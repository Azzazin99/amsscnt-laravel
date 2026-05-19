<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;
use App\Models\School;

class BookGroupMember extends Model
{
    protected $table = 'book_group_member';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'grp_id',
        'school_id',
    ];

    public function group()
    {
        return $this->belongsTo(BookGroup::class, 'grp_id', 'grp_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_code');
    }
}
