import { peer, socket } from "./node";

if(document.getElementById("meetingRoom")) {
    let localStream;
    let localPeer;
    const fullVideo = document.getElementById("fullVideo");
    const localVideo = document.getElementById("localVideo");
    const room = document.getElementById("meetingRoomInput").value.trim();
    const room_id = document.getElementById("meetingRoomIdInput").value.trim();
    const _token = $(`meta[name="csrf-token"]`).attr("content");

    navigator.mediaDevices.getUserMedia({ 
        video: true,
        audio: true
    }).then((stream) => {
        localStream = stream;
        fullVideo.srcObject = stream;
        localVideo.srcObject = stream;
    }).catch((error) => {
        console.log("Cannot display camera: ", error);        
    });

    peer.on("open", (peerId) => {
        localPeer = peerId;
        socket.emit("join-meeting", { roomId: room, userId: peerId });
        savePeerId(peerId);        
    });

    socket.on("user-joined", ({ userId }) => {
        setTimeout(() => {
            connectedNewUser(userId, localStream);
        }, 1500)
    });

    peer.on("call", (call) => {
        call.answer(localStream);
        call.on("stream", (remoteStream) => {
            addRemoteVideo(call.peer, remoteStream);
        });
    });

    function connectedNewUser(userId, stream) {
        const call = peer.call(userId, stream);
        call.on("stream", (remoteStream) => {
            addRemoteVideo(userId, remoteStream);
        });
    }

    function addRemoteVideo(userId, stream) {
        const videoEl = `<div class="list-video">
                <video id="${userId}" autoplay playsinline></video>
            </div>`;
        
        if(!document.getElementById(userId)) {
            $("#listVideo").append(videoEl);
            const video = document.getElementById(userId);
            video.srcObject = stream;
            fullVideo.srcObject = stream;
        }
    }

    function savePeerId(peerId) {
        $.ajax({
            url: "/meeting/save_peer",
            type: "post",
            data: { _token, peerId, socket_id: socket.id },
            dataType: "json",
            success: function(response) {
                if(response.status === "success") {
                    console.log("Save peer successfull");                    
                }
            },

            error: function(error) {
                console.log("Error fetching: ", error);                
            }
        });
    }

    $("#leaveMeetingBtn").on("click", function() {
        window.location.href = "/";
        socket.emit("user-leaved", { userId: localPeer });
        leaveMeeting();
    });

    socket.on("leave-meeting", ({ userId }) => {
        if (document.getElementById(userId)) {
            $(`#${userId}`).parent().remove();
            fullVideo.srcObject = localStream;
        }
    });

    function leaveMeeting() {
        $.ajax({
            url: "/meeting/leave_meeting",
            type: "post",
            data: { _token, room_id },
            dataType: "json"
        });
    }
}