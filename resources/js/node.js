import { Peer } from "peerjs";

const peer = new Peer({
    path: "/",
    host: "127.0.0.1",
    port: 9000
});

const socket = io.connect(`${window.location.protocol}//${window.location.hostname}:3000`);

export { peer, socket };