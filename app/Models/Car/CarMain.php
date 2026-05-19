<?php

namespace App\Models\Car;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

class CarMain extends Model
{
    protected $table = 'car_main';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'rec_date',
        'car',
        'place',
        'because',
        'car_start',
        'time_start',
        'car_finish',
        'time_finish',
        'day_total',
        'person_num',
        'control_person',
        'ks',
        'fuel',
        'project',
        'activity',
        'money',
        'self_driver',
        'private_car',
        'car_owner',
        'private_car_number',
        'private_driver',
        'driver',
        'officer_comment',
        'kammai',
        'officer_sign',
        'officer_date',
        'group_comment',
        'group_sign',
        'group_date',
        'grant_comment',
        'commander_grant',
        'commander_sign',
        'commander_date',
    ];

    protected $casts = [
        'rec_date' => 'date',
        'car_start' => 'date',
        'car_finish' => 'date',
        'officer_date' => 'datetime',
        'group_date' => 'datetime',
        'commander_date' => 'datetime',
        'time_start' => 'float',
        'time_finish' => 'float',
        'day_total' => 'integer',
        'person_num' => 'integer',
        'fuel' => 'boolean',
        'self_driver' => 'boolean',
        'private_car' => 'boolean',
        'commander_grant' => 'integer',
    ];

    public function requester()
    {
        return $this->belongsTo(Person::class, 'person_id', 'person_id');
    }

    public function bookedCar()
    {
        return $this->belongsTo(CarCar::class, 'car', 'car_code');
    }

    public function driverPerson()
    {
        return $this->belongsTo(Person::class, 'driver', 'person_id');
    }
}
