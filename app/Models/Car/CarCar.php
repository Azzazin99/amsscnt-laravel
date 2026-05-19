<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Model;

class CarCar extends Model
{
    protected $table = 'car_car';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'car_code',
        'car_type',
        'car_number',
        'name',
        'pic',
        'status',
    ];

    protected $casts = [
        'car_code' => 'integer',
        'car_type' => 'integer',
        'status' => 'integer',
    ];
}
