<?php

namespace App\Models\BookRegister;

use Illuminate\Database\Eloquent\Model;

class BookRegisterCerSign extends Model
{
    protected $table = 'bookregister_cer_sign';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'position1',
        'position2',
        'sign_pic',
        'sign_now',
        'officer',
        'rec_date',
    ];

    protected $casts = [
        'rec_date' => 'date',
        'sign_now' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->sign_now) {
                static::where('id', '!=', $model->id)->update(['sign_now' => false]);
            }
        });
    }
}
