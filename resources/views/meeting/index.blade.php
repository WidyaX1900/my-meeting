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
    </div>
@endsection