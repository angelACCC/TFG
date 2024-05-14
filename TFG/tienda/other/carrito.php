<?php
require_once 'db.php';
require 'session.php';
require 'cabecera.php';

if (!comprobar_sesion())
    return;

// Verificar si el carrito está vacío
if (empty($_SESSION['carrito'])) {
    echo "No hay productos en el carrito.";
    return;
}

$productos = cargar_productos(array_keys($_SESSION['carrito']));

// Verificar si la carga de productos fue exitosa
if ($productos === false) {
    echo "Error al cargar los productos.";
    return;
}

// hay que añadir las unidades al carrito
$productos = iterator_to_array($productos);
foreach ($productos as &$producto) {
    $cod = $producto['codProd'];
    $producto['unidades'] = $_SESSION['carrito'][$cod];
}
?>

<!DOCTYPE html>
<html lang="es">
<body>
    <?php
    echo '<ul>';
    foreach ($productos as &$producto) {
    ?>
        <li>
            <p>
                <?php
                echo
                    "{$producto['nombre']} <br> 
                    Descripción: {$producto['descripcion']} <br>
                    Precio: {$producto['precio']} €<br> 
                    Unidades: {$producto['unidades']} " .
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
    </ul>
</body>

</html>

<?php
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
