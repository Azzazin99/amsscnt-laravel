<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /** @use HasFactory<\Database\Factories\PersonFactory> */
    use HasFactory;

    protected $table = 'person_sch_main';

    protected $fillable = [
        'person_id',
        'prename',
        'name',
        'surname',
        'position_code',
        'school_code',
        'pic',
        'status',
        'person_order',
        'officer',
        'rec_date',
        'other',
    ];

    public $timestamps = false;

    public function school()
    {
        return $this->belongsTo(School::class, 'school_code', 'school_code');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_code', 'position_code');
    }
}
