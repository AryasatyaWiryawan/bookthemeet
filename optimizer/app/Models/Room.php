<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * A room can host many meetings.
     */
    public function meetings()
    {
        return $this->belongsToMany(MeetingRequest::class, 'meeting_room');
    }

}
