<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    /** @use HasFactory<\Database\Factories\MeetingRoomFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'room_token',
        'user_id'
    ];
}
