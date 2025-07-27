import express from "express";
import { createServer } from "http";
import { Server } from "socket.io";

const app = express();
const server = createServer(app);
const port = process.env.PORT || 3000;
const io = new Server(server, {
    cors: {
        origin: "*",
    }
});
let disconnectTimeout;

app.get("/", (req, res) => {
    res.send(`<p>NodeJS running smoothly...</p>`);
});

io.on("connection", (socket) => {
    socket.on("join-meeting", ({ roomId, userId }) => {
        socket.join(roomId);
        socket.to(roomId).emit("user-joined", { userId });
    });
    
    
    socket.on("disconnect", () => {});
    
});
server.listen(port, () => console.log(`NodeJS running on port: ${port}`));