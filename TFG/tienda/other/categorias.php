<?php
require_once 'db.php';
// session_start();
// require_once 'session.php';
// if (!comprobar_sesion())
//     return;
$categorias = cargar_categorias();
// $cat_json = json_encode(
//     iterator_to_array($categorias),
//     true
// );
// function debug_to_console($data) {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }
// echo $cat_json;
// debug_to_console($cat_json) ;




?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php foreach ($categorias as $categoria): ?>
        <ul>
            <li>
                <p>
                    <a href="productos.php?id=<?php echo $categoria['codCat']; ?>">
                        <?php echo $categoria['nombre'] ?> <br>
                        Descripcion:
                        <?php echo $categoria['descripcion'] ?>
                    </a>
                </p>
            </li>
        </ul>

    <?php endforeach; ?>
</body>

</html>