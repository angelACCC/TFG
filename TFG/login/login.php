<?php

require_once 'db.php';
session_start();
$_SESSION['carrito'] = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = $_POST['pass'];

    $sql = "SELECT id, username, email, pass FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            header("Location: ../index.php");
        } else {
            header("Location: login.html");
            echo "Contraseña incorrecta.";
        }
    } else {
        header("Location: login.html");
        echo "Usuario no encontrado.";
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

