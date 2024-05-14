<?php
require 'correo/mail.php';
require_once 'db.php';
require 'session.php';

function calcularTotalPedido($carrito) {
    $total = 0;
    foreach ($carrito as $codProd => $unidades) {
        $producto = obtenerProductoPorCodigo($codProd); 
        if ($producto !== false) {
            $precio = $producto['precio'];
            $total += $precio * $unidades;
        }
    }
    return $total;
}

if (!comprobar_sesion()) return;

// Comprobar si el usuario tiene suficiente saldo para pagar el pedido
$pedidoTotal = calcularTotalPedido($_SESSION['carrito']); // Debes tener una función para calcular el total del pedido
if (!comprobarPago($_SESSION['username'], $pedidoTotal)) {
    echo "<script>alert('Saldo insuficiente'); window.location.href = 'carrito.php?';</script>";
    exit;
}

// Si el usuario tiene suficiente saldo, se procede a insertar el pedido en la base de datos
if (!insertar_pedido($_SESSION['carrito'], $_SESSION['user_id'])) {
    echo "Error al insertar el pedido en la base de datos false"; // Error al insertar el pedido en la base de datos
} else {
    // Se envía el correo y se marca el pedido como procesado
    $correo = $_SESSION['email'];
    $comprar = $_SESSION['carrito'];
    $pedido = $_SESSION['codPed'];
    enviar_correos($comprar, $pedido, $correo);
    echo "<script>alert('Pedido procesado correctamente. Recibirá un correo electrónico con los detalles del pedido.');</script>";
    $_SESSION['carrito'] = [];
    // header('Location: tienda.php');
}
// echo "<script>alert('Pedido Realizado \n Revisa el correo');</script>";
echo "<script>window.location.href = 'tienda.php';</script>";





// require 'correo/mail.php';
// require_once 'db.php';
// require 'session.php';



// if (!comprobar_sesion()) return;

// if (!insertar_pedido($_SESSION['carrito'], $_SESSION['user_id'])) {
//     echo "false";

// } else {

//     $correo = $_SESSION['email'];
//     $comprar = $_SESSION['carrito'];
//     $pedido = $_SESSION['codPed'];
//     enviar_correos($comprar, $pedido, $correo);
//     echo "true";
//     $_SESSION['carrito'] = [];

//     echo "<script>alert('Pedido procesado correctamente \n Revisa el correo'); window.location.href = 'tienda.php?';</script>";

// }


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