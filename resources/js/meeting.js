import { Peer } from "peerjs";

if(document.getElementById("meetingRoom")) {
    let localStream;
    const fullVideo = document.getElementById("fullVideo");
    const localVideo = document.getElementById("localVideo");
    const room = document.getElementById("meetingRoomInput").value.trim();
    const _token = $(`meta[name="csrf-token"]`).attr("content");        
    
    const peer = new Peer({ 
        path: "/",
        host: "127.0.0.1",
        port: 9000
     });
    const socket = io.connect(`${window.location.protocol}//${window.location.hostname}:3000`);

    navigator.mediaDevices.getUserMedia({ 
        video: true,
        audio: true
    }).then((stream) => {
        localStream = stream;
        fullVideo.srcObject = stream;
        localVideo.srcObject = stream;
        
        socket.on("user-joined", ({ userId }) => {
            setTimeout(() => {
                connectedNewUser(userId, stream);
            }, 1500)
        });

        peer.on("call", (call) => {
            call.answer(stream);
            call.on("stream", (remoteStream) => {
                addRemoteVideo(call.peer, remoteStream);
            });
        });
    }).catch((error) => {
        console.log("Cannot display camera: ", error);        
    });

    peer.on("open", (peerId) => {
        socket.emit("join-meeting", { roomId: room, userId: peerId });
        savePeerId(peerId);        
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
}