<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test connection</title>
</head>
<body>
    <h1>Testing connection...</h1>
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
    <script>
        const protocol = window.location.protocol;
        const hostname = window.location.hostname;
        const port = window.location.port;
        const socket = io.connect(`${protocol}//${hostname}:3000`);        
    </script>
</body>
</html>