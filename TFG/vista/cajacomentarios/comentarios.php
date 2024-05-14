<?php

include_once ('db.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['text']) && isset($_POST['categoria'])) {
    //Verificar si el usuario esta logado que pueda enviar mensajes
    if (!isset($_SESSION['user_id'])) {
        echo '<script>alert("¡Necesitas iniciar sesión para comentar!");</script>';
    } else {
        // Obtener el texto del comentario enviado por el usuario
        $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        $text = mysqli_real_escape_string($conn, $_POST['text']);
        $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
        $time = date('Y-m-d H:i:s'); //Sacamos la fecha de cuando se mando el mensaje
        $sql = "INSERT INTO comments (user_id, comment_text, comment_time, categoria) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $user_id, $text, $time, $categoria);

        $stmt->execute();
    }
}

function mostrarComentarios($conn, $categoria)
{
    // Consultar los comentarios de la base de datos con el nombre de usuario en lugar del ID
    $sql = "SELECT comments.*, users.username 
            FROM comments 
            INNER JOIN users ON comments.user_id = users.id
            WHERE categoria = ?
            ORDER BY comment_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $categoria);
    $stmt->execute();
    $result = $stmt->get_result();
    // Verificar si hay comentarios
    if ($result->num_rows > 0) {
        // Mostrar los comentarios
        echo '<div id="comments-list">';
        while ($row = $result->fetch_assoc()) {
            echo '<div>' . $row['username'] . ': ' . $row['comment_text'] . '<br>' . $row['comment_time'] . '</div>';

        }
        echo '</div>';
    } else {
        echo "No hay comentarios aún.";
    }
}


