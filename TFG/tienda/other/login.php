<?php

//Para eliminar
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = comprobar_usuario(
        $_POST['username'],
        $_POST['pass']
    );
    if ($usu === FALSE) {
        echo "FALSE";
    } else {
        session_start();
        $_SESSION['username'] = $usu;
        $_SESSION['carrito'] = [];
        echo "TRUE";
    }
}

