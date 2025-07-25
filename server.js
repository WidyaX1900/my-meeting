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
    console.log(`User ${socket.id} connected`);
    socket.on("disconnect", () => {
        if(disconnectTimeout) clearTimeout(disconnectTimeout);
        disconnectTimeout = setTimeout(() => {
            console.log(`${socket.id} disconnected`);            
        }, 3000);
    });
    
});
server.listen(port, () => console.log(`NodeJS running on port: ${port}`));