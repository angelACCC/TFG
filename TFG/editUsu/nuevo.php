<?php
require 'cone.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Correo = $_POST['correo'];
    $Clave = $_POST['clave'];
    $Pais = $_POST['pais'];
    $CP = $_POST['cp'];
    $Ciudad = $_POST['ciudad'];
    $Direccion = $_POST['direccion'];

    $claveCif = crypt($_POST['clave'], '$1$antonio$');

    $query = "INSERT INTO restaurantes (Correo, Clave, Pais, CP, Ciudad, Direccion) VALUES (:Correo, :Clave, :Pais, :CP, :Ciudad, :Direccion)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':Correo', $Correo);
    $stmt->bindParam(':Clave', $claveCif);
    $stmt->bindParam(':Pais', $Pais);
    $stmt->bindParam(':CP', $CP);
    $stmt->bindParam(':Ciudad', $Ciudad);
    $stmt->bindParam(':Direccion', $Direccion);
    $stmt->execute();

    header('Location: ' . '../index.html');

}
?>

<html>

<head>
    <title>CRUD - Agregar Nuevo Registro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="contenedor-titulo">
        <h1 class="titulo-registro">Crea tu usuario</h1>
    </div>
    <form method="post" class="formulario-registro">
        <label for="nombre">Nombre:<span class="info" title="Nombre">?</span></label>
        <input type="text" name="nombre" required><br>
        <label for="usuario">Usuario:<span class="info" title="El usuario que saldra en el chat">?</span></label>
        <input type="text" name="usuario" required><br>
        <label for="correo">Correo:<span class="info" title="Ingresa tu correo electrónico.">?</span></label>
        <input type="text" name="correo" required><br>
        <label for="clave">Clave:<span class="info" title="Esto es la contraseña para tu cuenta.">?</span></label>
        <input type="password" name="clave" required><br>
        <button type="submit">Guardar</button>
    </form>

</body>

</html>