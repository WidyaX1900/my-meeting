<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $room_token = session('room_token');
        $my_name = session('my_name');
        $room_id = session('room_id');
        return view('meeting.index', [
            'room_token' => $room_token,
            'my_name' => $my_name,
            'room_id' => $room_id,
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
                'room_id' => $room->id,
                'my_name' => Auth::user()->name
            ]);
            return redirect('/meeting');
        }
    }

    public function save_peer(Request $request)
    {
        $peer_id = $request->peerId;
        $socket_id = $request->socket_id;
        $user_id = Auth::id();

        $save = Meeting::where('user_id', $user_id)
            ->where('status', 'onmeet')
            ->update([
                'peer_id' => $peer_id,
                'socket_id' => $socket_id,
            ]);
        
        if($save) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function leave_meeting(Request $request)
    {
        $user_id = Auth::id();
        $room_id = $request->room_id;

        $save = Meeting::where('user_id', $user_id)
            ->where('meeting_room_id', $room_id)
            ->where('status', 'onmeet')
            ->update([
                'status' => 'ended',
                'peer_id' => null,
                'socket_id' => null,
            ]);

        if ($save) {
            session()->forget(['room_token', 'my_name', 'room_id']);
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
