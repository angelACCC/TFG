// Simulación de comentarios
var comments = [
    { user: "Usuario1", content: "¡Este es un comentario genial!" },
    { user: "Usuario2", content: "Me encanta este sitio web." }
    // Puedes agregar más comentarios si lo deseas
];

// Función para mostrar los comentarios en la página
function displayComments() {
    var commentsList = document.getElementById('comments-list');
    commentsList.innerHTML = ''; // Limpiamos los comentarios actuales

    comments.slice().reverse().forEach(function(comment) {
        var commentDiv = document.createElement('div');
        commentDiv.textContent = comment.user + ': ' + comment.content;
        commentsList.appendChild(commentDiv);
    });
}

// Mostrar los comentarios al cargar la página
displayComments();

// Manejar el envío de comentarios
var commentForm = document.getElementById('comment-form');
commentForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del formulario

    // Obtener el texto del comentario
    var commentText = document.getElementById('comment-text').value;

    // Aquí deberías enviar el comentario al servidor si el usuario está logado
    // y luego actualizar la lista de comentarios. Por ahora, simplemente agregaremos el comentario a la lista simulada.
    var newComment = { user: "Usuario Actual", content: commentText };
    comments.push(newComment);
    displayComments();

    // Limpiar el campo de texto después de enviar el comentario
    document.getElementById('comment-text').value = '';
});
