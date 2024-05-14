<?php
/*comprueba que el usuario haya abierto sesión o
devuelve*/
require 'session.php';
$codCat = $_POST['codCat'];
if (!comprobar_sesion()){
    echo "<script>alert('Tienes que Iniciar sesion'); window.location.href = 'productos.php?id=$codCat';</script>";
    return;
}

$cod = $_POST['codProd'];
$unidades = (int) $_POST['unidades'];
if ($_SESSION['carrito'][$cod] !== NULL) {
    $_SESSION['carrito'][$cod] += $unidades;
    unset($_POST); // Limpiar datos del formulario para evitar reenvíos
    echo "<script>alert('Producto añadido al carrito'); window.location.href = 'carrito.php';</script>";
} 

