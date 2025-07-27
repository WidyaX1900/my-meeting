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
        $isMeeting = Meeting::where('user_id', Auth::id())
            ->where('status', 'onmeet')
            ->first();        
        
        if(!$isMeeting) {
            session()->forget(['room_token', 'my_name']);
            return redirect('/');
        } 
        
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

        $role = Auth::id() === $room->user_id ? 'host' : 'member';
        $meeting = Meeting::create([
            'user_id' => Auth::id(),
            'meeting_room_id' => $room->id,
            'role' => $role,
            'status' => 'onmeet',
        ]);

        if($meeting) {
            session([
                'room_token' => $room->room_token,
                'my_name' => Auth::user()->name
            ]);
            return redirect('/meeting');
        }
    }
}
