document.getElementById('btnMostrarChat').addEventListener('click', function() {
    var contenedorChat = document.getElementById('contenedorChat');
    contenedorChat.classList.toggle('chatVisible');
});

document.getElementById('btnEnviar').addEventListener('click', function() {
    var mensaje = document.getElementById('mensajeInput').value;

    // Aquí iría el código para enviar el mensaje a la base de datos
    console.log(mensaje);

    // Añadir el mensaje al div de mensajes
    var divMensajes = document.getElementById('mensajes');
    var mensajeDiv = document.createElement('div');
    mensajeDiv.textContent = mensaje;
    divMensajes.appendChild(mensajeDiv);

    // Limpiar el input
    document.getElementById('mensajeInput').value = '';
});
