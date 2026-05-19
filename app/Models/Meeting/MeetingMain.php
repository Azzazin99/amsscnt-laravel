<?php

namespace App\Models\Meeting;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

class MeetingMain extends Model
{
    protected $table = 'meeting_main';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'room',
        'type_obj',
        'book_date',
        'book_date_end',
        'start_time',
        'finish_time',
        'objective',
        'book_person',
        'rec_date',
        'approve',
        'reason',
        'person_num',
        'other',
        'equipment',
        'officer',
        'officer_date',
    ];

    protected $casts = [
        'book_date' => 'date',
        'book_date_end' => 'date',
        'rec_date' => 'datetime',
        'officer_date' => 'datetime',
        'person_num' => 'integer',
    ];

    public function meetingRoom()
    {
        return $this->belongsTo(MeetingRoom::class, 'room', 'room_code');
    }

    public function requester()
    {
        return $this->belongsTo(Person::class, 'book_person', 'person_id');
    }

    public function approver()
    {
        return $this->belongsTo(Person::class, 'officer', 'person_id');
    }
}
