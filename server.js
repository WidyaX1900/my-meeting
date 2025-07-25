import express from "express";
import { createServer } from "http";

const app = express();
const server = createServer(app);

const port = 3000;
app.get("/", (req, res) => {
    res.send(`<p>NodeJS running smoothly...</p>`);
});
server.listen(port, () => console.log(`NodeJS running on port: ${port}`));