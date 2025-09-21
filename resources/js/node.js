import { Peer } from "peerjs";

let peer, socket;
let url = `${window.location.protocol}//${window.location.hostname}`;

if (url === "https://meeting.widyaweb.com") {
    // socket dan peerjs production
    peer = new Peer({
        path: "/meeting-peerserver",
        host: "peerjsmeeting.widyaweb.com",
        port: 443,
        secure: true
    });

    socket = io.connect("https://nodejsmeeting.widyaweb.com");
} else {
    peer = new Peer({
        path: "/meeting-peerserver",
        host: "127.0.0.1",
        port: 9000
    });    
    
    socket = io.connect(`${window.location.protocol}//${window.location.hostname}:3000`);
}


export { peer, socket };