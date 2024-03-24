// server.js
const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const db = require('./database');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

app.use(express.static('public'));

io.on('connection', (socket) => {
    console.log('Nuevo usuario conectado');

    // Emitir todos los mensajes previos al nuevo usuario
    db.query('SELECT message FROM messages ORDER BY timestamp ASC')
        .then(([rows]) => {
            socket.emit('previous messages', rows);
        })
        .catch(err => console.log(err));

    socket.on('new message', (msg) => {
        db.query('INSERT INTO messages (message) VALUES (?)', [msg])
            .then(() => {
                io.emit('broadcast message', msg);
            })
            .catch(err => console.log(err));
    });
});

server.listen(3000, () => {
    console.log('Servidor escuchando en el puerto 3000');
});
