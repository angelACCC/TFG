<?php
require 'session.php';
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['dinero'])) {
        $dinero = $_POST['dinero'];
        if(ingresarDinero($_SESSION['username'], $dinero)) {
            echo "<script>alert('Dinero ingresado correctamente'); window.location.href = 'saldo.php';</script>";
        } else {
            echo "<script>alert('Error al ingresar el dinero'); window.location.href = 'saldo.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar dinero</title>
    <?php require 'cabecera.php'; ?>
</head>
<body>
    <h1>Saldo actual: 
        <?php echo mostrarsaldo($_SESSION['username']); ?> €
    </h1>
    <form action="saldo.php" method="post">
        Meter saldo: <input type="text" name="dinero">
        <button type="submit">Ingresar dinero</button>
    </form>
</body>
</html>
