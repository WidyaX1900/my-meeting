<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\MeetingRoom;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $room_token = session('room_token');
        $my_name = session('my_name');
        return view('meeting.index', [
            'room_token' => $room_token,
            'my_name' => $my_name,
        ]);
    }
    
    public function join(MeetingRoom $meeting_room, $room_token = null)
    {
        $room = $meeting_room->where('room_token', $room_token)->first();
        if(empty($room)) {
            abort(404);
        }

        session([
            'room_token' => $room->room_token,
            'my_name' => Auth::user()->name
        ]);
        return redirect('/meeting');
    }
}
