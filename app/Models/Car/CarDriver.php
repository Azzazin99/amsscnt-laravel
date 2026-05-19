<?php

namespace App\Models\Car;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    protected $table = 'car_driver';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'status',
        'officer',
        'rec_date',
    ];

    protected $casts = [
        'status' => 'integer',
        'rec_date' => 'date',
    ];

    public function driverPerson()
    {
        return $this->belongsTo(Person::class, 'person_id', 'person_id');
    }
}
