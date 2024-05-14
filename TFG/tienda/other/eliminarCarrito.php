<?php
/*comprueba que el usuario haya abierto sesión*/
require_once 'session.php';
if (!comprobar_sesion())
    return;
$cod = $_POST['codProd'];

if (isset($_SESSION['carrito'][$cod])) {
        $_SESSION['carrito'] = [];
}


header("Location: tienda.php");