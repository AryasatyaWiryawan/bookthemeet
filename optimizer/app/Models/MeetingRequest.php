<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_time',
        'end_time',
    ];

    /**
     * A meeting can be assigned to many rooms.
     */
    public function rooms()
    {
        // second argument is the pivot table name
        return $this->belongsToMany(Room::class, 'meeting_room');
    }

}
