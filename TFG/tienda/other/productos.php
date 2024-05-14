<?php
require_once 'db.php';
/*comprueba que el usuario haya abierto sesión o
devuelve*/
// require 'session.php';
// if (!comprobar_sesion())
//     return;

// $cat_json = json_encode(
//     iterator_to_array($productos),
//     true
// );
// echo $cat_json;


$productos_array = [];
$productos = cargar_productos_categoria(
    $_GET['id']
);
function anadirProd($texto, $cod, $codCat)
{
    return "
    <form action='anadir.php' method='post'>
        <input type='hidden' name='codProd' value='$cod'>
        <input type='hidden' name='codCat' value='{$_GET['id']}'>
        <input type='text' name='unidades' value='1'>
        <input type='submit' value='$texto'>
    </form>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
</head>
<header>
    <?php require 'cabecera.php' ?>
</header>

<body>
    <?php
    if (!empty($productos)) {
        foreach ($productos as $producto) {
            ?>
            <ul>
                <li>
                    <p>
                        <?php
                        echo 
                        "{$producto['nombre']} <br> 
                        Descripcion: {$producto['descripcion']} <br>
                        Precio: {$producto['precio']} €<br>" . 
                        anadirProd("Comprar", $producto['codProd'], $_GET['id']);
                        ?>
                    </p>
                </li>
            </ul>
            <?php
        }
    } else {
        echo "No se encontraron productos en esta categoría.";
    }
    ?>
</body>

</html>