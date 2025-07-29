@extends('layouts.layout')
@section('content')
    <div id="meetingRoom" class="meeting-container">
        <div class="full-video-container">
            <video id="fullVideo" muted autoplay playsinline></video>
            <div class="participant-name">
                <h5 id="participantName" class="text-light ms-3">{{ $my_name }}</h5>
            </div>
        </div>
        <div id="listVideo" class="list-video-container">
            <div class="list-video">
                <video id="localVideo" muted autoplay playsinline></video>
            </div>
        </div>
        <input type="hidden" id="meetingRoomInput" value="{{ $room_token }}">
        <input type="hidden" id="meetingRoomIdInput" value="{{ $room_id }}">
        <div class="fixed-bottom w-50 bg-dark p-3 mx-auto mb-3">
            <button id="leaveMeetingBtn" type="button" class="btn btn-danger btn-sm">Leave</button>
        </div>
    </div>
@endsection