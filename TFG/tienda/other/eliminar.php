<?php
/*comprueba que el usuario haya abierto sesión*/
require_once 'session.php';
if (!comprobar_sesion()){
    echo "<script>alert('Tienes que Iniciar sesion'); window.location.href = 'carrito.php';</script>";
    return;
}
$cod = $_POST['codProd'];
$unidades = $_POST['unidades'];
/*si existe el código restamos las unidades, con
mínimo de 0*/
if (isset($_SESSION['carrito'][$cod])) {
    $_SESSION['carrito'][$cod] -= $unidades;
    if ($_SESSION['carrito'][$cod] <= 0) {
        unset($_SESSION['carrito'][$cod]);
    }
}
echo "<script>alert('Producto eliminado correctamente'); window.location.href = 'carrito.php';</script>";