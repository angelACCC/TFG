<?php
// function comprobar_sesion(){

//     if(!isset($_SESSION['username'])){
//         return false;
//     } else {
//         return true;
//     }
// }

// // Comprobar si hay sesión iniciada
// if(comprobar_sesion()) {
//     $username = $_SESSION['username'];
//     echo "Bienvenido, $username"; // Puedes mostrar un mensaje de bienvenida o realizar otras operaciones según el nombre de usuario
// } else {
//     echo "No has iniciado sesión"; // Puedes mostrar un mensaje indicando que no hay sesión iniciada
// }
session_start();
function comprobar_sesion() {
    return isset($_SESSION['username']);
}



