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
    db.query('SELECT m.message, u.username FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.timestamp ASC')
        .then(([rows]) => {
            socket.emit('previous messages', rows);
        })
        .catch(err => console.log(err));

    socket.on('new message', (data) => {
        const { message, user_id } = data;
        db.query('INSERT INTO messages (message, user_id) VALUES (?, ?)', [message, user_id])
            .then(() => {
                io.emit('broadcast message', { message, username });
            })
            .catch(err => console.log(err));
    });
});

server.listen(5500, () => {
    console.log('Servidor escuchando en el puerto 5500');
});
