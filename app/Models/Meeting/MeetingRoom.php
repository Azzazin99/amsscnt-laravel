<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    protected $table = 'meeting_room';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'room_code',
        'room_name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(MeetingMain::class, 'room', 'room_code');
    }
}
