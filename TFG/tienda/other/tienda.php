<?php 
require 'session.php';
require 'db.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Formulario de login</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../JS/cargarDatos.js"></script>
    <script type="text/javascript" src="../JS/session.js"></script>
</head>

<body>
    <section id="principal">
        <header>
            <?php require 'cabecera.php' ?>
        </header>
        <h2 id="titulo"></h2>
        <section id="contenido">
            <?php require 'categorias.php' ?>
        </section>
        
    </section>
</body>