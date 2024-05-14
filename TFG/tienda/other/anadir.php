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
/*si existe el código sumamos las unidades*/
if (isset($_SESSION['carrito'][$cod])) {
    $_SESSION['carrito'][$cod] += $unidades;
} else {
    $_SESSION['carrito'][$cod] = $unidades;
}
echo "<script>alert('Producto añadido al carrito'); window.location.href = 'productos.php?id=$codCat';</script>";


// require 'session.php';
// $codCat = $_POST['codCat'];
// if (!comprobar_sesion()){
//     echo "<script>alert('Tienes que Iniciar sesion'); window.location.href = 'productos.php?id=$codCat';</script>";
//     return;
// }
// $cod = $_POST['codProd'];
// $unidades = (int) $_POST['unidades'];
// if ($_SESSION['carrito'][$cod] !== NULL) {
//     $_SESSION['carrito'][$cod] += $unidades;
//     unset($_POST); // Limpiar datos del formulario para evitar reenvíos
//     echo "<script>alert('Producto añadido al carrito'); window.location.href = 'productos.php?id=$codCat';</script>";
// } else {
//     $_SESSION['carrito'][$cod] = $unidades;
//     unset($_POST); // Limpiar datos del formulario para evitar reenvíos
//     echo "<script>alert('Producto añadido al carrito'); window.location.href = 'productos.php?id=$codCat';</script>";
// }

