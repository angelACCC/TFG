<?php
session_start();
$_SESSION = array();
session_destroy(); // eliminar la sesion
setcookie(session_name(), '', time() - 1000, '/');
header("Location:" . "../index.php");
// eliminar la cookie