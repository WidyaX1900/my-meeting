<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\MeetingRoom;

class MeetingController extends Controller
{
    public function index()
    {
        $room_token = session('room_token');
        return view('meeting_room.room', ['room_token' => $room_token]);
    }
    
    public function join(MeetingRoom $meeting_room, $room_token = null)
    {
        $room = $meeting_room->where('room_token', $room_token)->first();
        if(empty($room)) {
            abort(404);
        }

        session(['room_token' => $room->room_token]);
        return redirect('/meeting');
    }
}
