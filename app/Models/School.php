<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory;

    protected $table = 'system_school';

    protected $fillable = [
        'school_code',
        'school_type',
        'school_name',
        'school_group',
    ];

    public $timestamps = false;

    public function persons()
    {
        return $this->hasMany(Person::class, 'school_code', 'school_code');
    }
}
