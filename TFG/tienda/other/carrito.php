<?php
require_once 'db.php';
require 'session.php';
require 'cabecera.php';

if (!comprobar_sesion())
    return;
$productos = cargar_productos(
    array_keys($_SESSION['carrito'])
);
// hay que añadir las unidades al carrito
$productos = iterator_to_array($productos);
foreach ($productos as &$producto) {
    $cod = $producto['codProd'];
    $producto['unidades'] = $_SESSION['carrito'][$cod];
}
// echo json_encode($productos, true);

function anadirProd($texto, $cod)
{
    return "
    <form action='sumar.php' method='post'>
        <input type='hidden' name='codProd' value='$cod'>
        <input type='text' name='unidades' value='1'>
        <input type='submit' value='$texto'>
    </form>";
}
function eliminarProd($texto, $cod)
{
    return "
    <form action='eliminar.php' method='post'>
        <input type='hidden' name='codProd' value='$cod'>
        <input type='text' name='unidades' value='1'>
        <input type='submit' value='$texto'>
    </form>";
}
function eliminarCarrito($texto, $cod)
{
    return "
    <form action='eliminarCarrito.php' method='post'>
        <input type='hidden' name='codProd' value='$cod'>
        <input type='submit' value='$texto'>
    </form>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php

    if (!empty($_SESSION['carrito'])) {
        echo '<ul>'; 
        foreach ($productos as &$producto) {
            ?>
            <li>
                <p>
                    <?php
                    echo
                        "{$producto['nombre']} <br> 
                        Descripcion: {$producto['descripcion']} <br>
                        Precio: {$producto['precio']} €<br> 
                        Unidades: {$producto['unidades']}" .
                        anadirProd("Añadir", $producto['codProd']) .
                        eliminarProd("Eliminar", $producto['codProd']) .
                        eliminarCarrito("Eliminar Todo", $producto['codProd']);
                    ?>
                </p>
            </li>
            <?php
        }
        ?>
         <form action="procesarPedido.php" method="post">
        <input type="hidden" name="confirmado" value="true">
        <input type="submit" value="Confirmar Pedido">
    </form>
        <?php
        echo '</ul>'; 
    } else {
        echo "No se encontraron productos en esta categoría.";
    }
    ?>
</body>

</html>