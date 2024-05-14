<?php
// Mostrar errores PHP (Desactivar en producción)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// Incluir los namespaces de las funciones que vamos a usar
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluimos las clases que vamos a usar de phpMailer.
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



function leer_conf_correo(){
    $dept = new DOMDocument();
    $dept->load('configuracion_correo.xml');
    $res = $dept->schemaValidate('configuracion_correo.xsd');
    if(!$res){
        throw new InvalidArgumentException("Revise el fichero de configuracion");

    }else{
        $datos = simplexml_load_file("configuracion_correo.xml");
        $host = $datos->xpath("//host");
        $port = $datos->xpath("//port");
        $usu = $datos->xpath("//user");
        $clave = $datos->xpath("//password");
        $resul = [];
        $resul[] = $host[0];
        $resul[] = $port[0];
        $resul[] = $usu[0];
        $resul[] = $clave[0];
        return $resul;
    }
}

function enviar_correos($comprar, $pedido, $correo){
    $cuerpo = crear_correo($comprar, $pedido, $correo);
    return enviar_correo_multiples("$correo, marcoalvfer0@gmail.com", $cuerpo, "Pedido $pedido confirmado");
}

function crear_correo($carrito, $pedido, $correo)
{
    
    $texto = "<h1>Pedido nº $pedido </h1><h2>Pedido: $correo </h2>";
    $texto .= "Detalle del pedido";
    $productos = cargar_productos(array_keys($carrito));
    $texto .= "<table>";
    $texto .= "<tr><th>Nombre</th><th>Descripcion</th><th>precio</th><th>Unidades</th></tr>";
    $precioTotal = 0;
    if (isset($productos)) {
    foreach ($productos as $producto) {
        $cod = $producto['codProd'];
        $nom = $producto['nombre'];
        $des = $producto['descripcion'];
        $precio = $producto['precio'];
        $uds = $_SESSION['carrito'][$cod];
        eliminarproducto($cod, $uds);
        $precioTotal += $precio * $uds;
        $texto .= "<tr><th>$nom</th><th>$des</th><th>$precio</th><th>$uds</th></tr>";
    }
}
    $texto .= "</table>";
    $texto .= "<p>precio total: $precioTotal <p>";
    return $texto;
}

function enviar_correo_multiples($lista_correos, $cuerpo, $asunto = ""){
    $datos = leer_conf_correo();
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls';
    $mail->Host = $datos[0]; 
    $mail->Port = $datos[1];
    $mail->Username = $datos[2];
    $mail->Password = $datos[3]; 
    $mail->setFrom('marcoalvfer0@gmail.com', 'Sistema de pedidos');
    $mail->Subject = $asunto;
    $mail->msgHTML($cuerpo);
    $correos = explode(",", $lista_correos);
    // foreach ($correos as $correo) {
        $mail->addAddress('marcoalvfer0@gmail.com', 'marcoalvfer0@gmail.com');
    // }
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    }else{
        return true;
    }
}
