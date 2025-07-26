<?php

namespace App\Http\Controllers;

use App\Models\MeetingRoom;
use App\Http\Requests\StoreMeetingRoomRequest;
use App\Http\Requests\UpdateMeetingRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('meeting_room.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'validation_errors' => $validator->errors()
            ]);
        }

        $room_token = uniqid();
        $meeting_room = MeetingRoom::create([
            'name' => $request->name,
            'room_token' => $room_token,
            'user_id' => Auth::id()
        ]);

        if ($meeting_room) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingRoom $meetingRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingRoom $meetingRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingRoomRequest $request, MeetingRoom $meetingRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingRoom $meetingRoom)
    {
        //
    }
}
