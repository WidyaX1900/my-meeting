if(document.getElementById("meetingRoom")) {
    let localStream;
    const fullVideo = document.getElementById("fullVideo");
    const localVideo = document.getElementById("localVideo");

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
}