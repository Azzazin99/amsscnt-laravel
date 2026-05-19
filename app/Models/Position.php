<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    protected $table = 'person_sch_position';

    protected $fillable = [
        'position_code',
        'position_name',
    ];

    public $timestamps = false;

    public function persons()
    {
        return $this->hasMany(Person::class, 'position_code', 'position_code');
    }
}
