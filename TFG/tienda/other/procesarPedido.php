<?php

require 'correo/mail.php';
require_once 'db.php';
require 'session.php';


if (!comprobar_sesion()) return;

if (!insertar_pedido($_SESSION['carrito'], $_SESSION['user_id'])) {
    echo "false";

} else {

    $correo = $_SESSION['email'];
    var_dump( $comprar = $_SESSION['carrito']);
    $pedido = $_SESSION['codPed'];
    enviar_correos($comprar, $pedido, $correo);
    echo "true";
    $_SESSION['carrito'] = [];
    
}


// $resul = insertar_pedido(
//     $_SESSION['carrito'],
//     $_SESSION['usuario']['CodRes']
// );
// if ($resul === FALSE) {
//     echo "false";
// } 
// else {
//     $correo = $_SESSION['usuario']['correo'];
//     $conf = enviar_correos(
//         $_SESSION['carrito'],
//         $resul,
//         $correo
//     );
//     echo "true";
//     $_SESSION['carrito'] = [];
// }