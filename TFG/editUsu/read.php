<?php
require 'cone.php';



$query = "SELECT * FROM restaurantes";
$stmt = $db->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
?>

<html>
<head>
    <title>CRUD - Lista de Registros</title>
</head>
<body>
    <h1>Lista de Registros</h1>
    <table border="1">
        <tr>
            <th>Correo</th>
            <th>Clave</th>
            <th>Pais</th>
            <th>CP</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['Correo']; ?></td>
                <td><?php echo $row['Clave']; ?></td>
                <td><?php echo $row['Pais']; ?></td>
                <td><?php echo $row['CP']; ?></td>
                <td><?php echo $row['Ciudad']; ?></td>
                <td><?php echo $row['Direccion']; ?></td>
                <td>
                    <a href="modificar.php?usuario=<?php echo $row['CodRes']; ?>">Modificar</a>
                </td>
                <td>
                    <a href="borrar.php?usuario=<?php echo $row['CodRes']; ?>">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="nuevo.php">Agregar Nuevo Registro</a> 
</body>
</html>
