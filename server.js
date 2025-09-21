import express from "express";
import { createServer } from "http";
import { Server } from "socket.io";

const app = express();
const server = createServer(app);

let localhost = true;
// let localhost = false;

const port = localhost ? 3000 : 4400;
const origin = localhost ? "*" : "https://meeting.widyaweb.com"
const io = new Server(server, {
    cors: {
        origin: origin,
    }
});
let room_id;

app.get("/", (req, res) => {
    res.send(`<p>NodeJS meeting running smoothly...</p>`);
});

io.on("connection", (socket) => {
    socket.on("join-meeting", ({ roomId, userId }) => {
        room_id = roomId;
        socket.join(roomId);
        socket.to(roomId).emit("user-joined", { userId });
    });

    socket.on("user-leaved", ({ userId }) => {
        socket.to(room_id).emit("leave-meeting", { userId });        
    });
    
    
    socket.on("disconnect", () => {});
    
});
server.listen(port, () => console.log(`NodeJS running on port: ${port}`));