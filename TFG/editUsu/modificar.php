<?php
require 'cone.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Correo = $_POST['correo'];
    $Clave = crypt($_POST['clave'], '$1$antonio$');
    $Pais = $_POST['pais'];
    $CP = $_POST['cp'];
    $Ciudad = $_POST['ciudad'];
    $Direccion = $_POST['direccion'];
    $Usuario = $_POST['usuario'];

    $query = "UPDATE restaurantes SET Correo = ?, Clave = ?, Pais = ?, CP = ?, Ciudad = ?, Direccion = ? WHERE CodRes = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$Correo, $Clave, $Pais, $CP, $Ciudad, $Direccion, $Usuario]);

    header('Location: read.php');
} elseif (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];

    $query = "SELECT * FROM restaurantes WHERE CodRes = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$usuario]);
    $row = $stmt->fetch();
}
?>

<html>
<head>
    <title>CRUD - Modificar Registro</title>
</head>
<body>
    <h1>Modificar Registro</h1>
    <form method="post">
        <input type="hidden" name="usuario" value="<?php echo $row['CodRes']; ?>">

        <label for="correo">Correo:</label>
        <input type="text" name="correo" value="<?php echo $row['Correo']; ?>" required><br>

        <label for="clave">Clave:</label>
        <input type="password" name="clave" required><br>

        <label for="pais">Pais:</label>
        <input type="text" name="pais" value="<?php echo $row['Pais']; ?>" required><br>

        <label for="cp">CP:</label>
        <input type="text" name="cp" value="<?php echo $row['CP']; ?>"><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" value="<?php echo $row['Ciudad']; ?>" required><br>

        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" value="<?php echo $row['Direccion']; ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
