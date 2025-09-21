import { PeerServer } from "peer";

const localhost = true;
// const localhost = false;

const peerServer = PeerServer({
    host: localhost ? "127.0.0.1" : "peerjsmeeting.widyaweb.com",
    path: "/meeting-peerserver",
    port: 9000,
    proxied: true
});

console.log("PeerJS running smoothly");
