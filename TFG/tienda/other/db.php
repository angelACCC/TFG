<?php

// $host = 'localhost';
// $dbname = 'tiendawiki';
// $user = 'root';
// $password = '';


function leer_config($nombre, $esquema)
{
    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);

    if ($res === false) {
        throw new InvalidArgumentException("Revise fichero de configuración");
    }

    $datos = simplexml_load_file($nombre);
    $ip = $datos->xpath("//ip");
    $nombre = $datos->xpath("//nombre");
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");

    $cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);

    $resul = [];
    $resul[] = $cad;
    $resul[] = $usu[0];
    $resul[] = $clave[0];

    return $resul;
}
//Para eliminar 
// function comprobar_usuario($nombre, $clave)
// {
//     Leer la configuración desde el archivo XML
//     $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
//     $db = new PDO($res[0], $res[1], $res[2]);

//     $ins = "SELECT id, username, email, pass FROM users WHERE username = :nombre";
//     $stmt = $db->prepare($ins);
//     $stmt->bindParam(':nombre', $nombre);
//     $stmt->execute();

//     $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($resultado !== false && password_verify($clave, $resultado['pass'])) {
//         return $resultado;
//     } else {
//         return false;
//     }
// }
function cargar_categorias()
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);


    $query = "SELECT * FROM categorias;";
    $statement = $db->prepare($query);
    $statement->execute();
    $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($categorias)) {
        return $categorias;

    } else {
        return false;
    }
}
// function cargar_productos($catID)
// {
//     Leer la configuración desde el archivo XML
//     $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
//     $db = new PDO($res[0], $res[1], $res[2]);
//     if (!empty($productoIDs)) {
//         $productoIDsString = implode(',', $catID);

//         $query = "SELECT * FROM productos WHERE CodProd IN ($productoIDsString)";
//         $statement = $db->prepare($query);
//         $statement->execute();
//         $productos = $statement->fetchAll(PDO::FETCH_ASSOC);
//         return $productos;
//     } else {

//         return [];
//     }
// }
function cargar_productos($productoIDs)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);
    
    if (!empty($productoIDs)) {
        $sep = implode(',', array_fill(0, count($productoIDs), '?'));

        $query = "SELECT * FROM productos WHERE codProd IN ($sep);";
        $statement = $db->prepare($query);

        foreach ($productoIDs as $index => $productoID) {
            $statement->bindValue($index + 1, $productoID, PDO::PARAM_INT);
        }

        $statement->execute();
        $productos = $statement->fetchAll(PDO::FETCH_ASSOC);


        return $productos;
    } else {
        return false;
    }
}

function cargar_categoria($catID)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);


    $query = "SELECT * FROM categorias WHERE CodCat = :catID;";
    $statement = $db->prepare($query);
    $statement->bindParam(':catID', $catID);
    $statement->execute();

    $categoria = $statement->fetch(PDO::FETCH_ASSOC);


    return $categoria;
}

function cargar_productos_categoria($categoria)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);


    $query = "SELECT * FROM productos where idcategoria = :cat AND cantidad > 0";
    $statement = $db->prepare($query);
    $statement->bindParam(':cat', $categoria);
    $statement->execute();
    $productos = $statement->fetchAll(PDO::FETCH_ASSOC);


    return $productos;
}

// function insertar_pedido($carro, $coduser)
// {
//     Leer la configuración desde el archivo XML
//     $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
//     $db = new PDO($res[0], $res[1], $res[2]);

//     $db->beginTransaction();

//     try {
//         $insertPedido = "INSERT INTO pedidos (pedd_time, enviado, iduser) VALUES (:fecha, :enviado, :fkidusuario);";
//         $statementPedido = $db->prepare($insertPedido);
//         $fecha = date("Y-m-d");
//         $enviado = 1;
//         $statementPedido->bindParam(':fecha', $fecha);
//         $statementPedido->bindParam(':enviado', $enviado);
//         $statementPedido->bindParam(':fkidusuario', $coduser);
//         $statementPedido->execute();

//         $pedidoID = $db->lastInsertId();

//         $inserDetpedido = "INSERT INTO pedidosproductos (pedido, producto, unidades) VALUES (:Pedido, :Producto, :Unidades);";
//         $detPedido = $db->prepare($inserDetpedido);
//         $_SESSION['codPed'] = $pedidoID;
//         foreach ($carro as $codProd => $unidades) {

//             $detPedido->bindParam(':Pedido', $pedidoID);
//             $detPedido->bindParam(':Producto', $codProd);
//             $detPedido->bindParam(':Unidades', $unidades);
//             $detPedido->execute();

//               // eliminarproducto($codProd, $unidades);
//         }
      
//         $db->commit();
//         return true;
//     } catch (Exception $e) {
//         $db->rollBack();
//         return false;
//     }

// }
function insertar_pedido($carro, $coduser)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);

    // Verificar los valores antes de la transacción
    $fecha = date("Y-m-d");
    $enviado = 1;
    // echo "Fecha: $fecha, Enviado: $enviado, Usuario ID: $coduser";

    $db->beginTransaction();

    try {
        $insertPedido = "INSERT INTO pedidos (ped_time, enviado, iduser) VALUES (:fecha, :enviado, :fkidusuario);";
        $statementPedido = $db->prepare($insertPedido);
        
        // Ejecutar la consulta de inserción de pedido
        $statementPedido->bindParam(':fecha', $fecha);
        $statementPedido->bindParam(':enviado', $enviado);
        $statementPedido->bindParam(':fkidusuario', $coduser);
        $statementPedido->execute();
        //depuracion
        // if ($statementPedido->execute()) {
        //     echo "Consulta de inserción de pedido ejecutada correctamente.";
            
        // } else {
        //     echo "Error al ejecutar la consulta de inserción de pedido.";
        // }

        $pedidoID = $db->lastInsertId();

        $inserDetpedido = "INSERT INTO pedidosproductos (pedido, producto, unidades) VALUES (:Pedido, :Producto, :Unidades);";
        $detPedido = $db->prepare($inserDetpedido);
        $_SESSION['codPed'] = $pedidoID;
        
        // Ejecutar la consulta de inserción de detalles de pedido
        foreach ($carro as $codProd => $unidades) {
            $detPedido->bindParam(':Pedido', $pedidoID);
            $detPedido->bindParam(':Producto', $codProd);
            $detPedido->bindParam(':Unidades', $unidades);
            $detPedido->execute();
            //depurar
            // if ($detPedido->execute()) {
            //     echo "Consulta de inserción de detalles de pedido ejecutada correctamente.";
            // } else {
            //     echo "Error al ejecutar la consulta de inserción de detalles de pedido.";
            // }
        }
      
        $db->commit();
        return "<script>alert('Pedido Realizado \n Revisa el correo'); window.location.href = 'tienda.php';</script>";
    } catch (Exception $e) {
        $db->rollBack();
        var_dump($e->getMessage());
        return false;
    }
}

//Hay que mirarlo
function eliminarproducto($codProd, $Stock)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);

    $updateDetPedido = "UPDATE productos SET cantidad = cantidad - :Stock WHERE codProd = :Producto;";
    $updateDet = $db->prepare($updateDetPedido);
    $updateDet->bindParam(':Stock', $Stock);
    $updateDet->bindParam(':Producto', $codProd);
    $updateDet->execute();

}

function mostrarSaldo($user)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);
    
    // Preparar la consulta SQL con un marcador de posición para el nombre de usuario
    $sql = "SELECT saldo FROM users WHERE username = ?";
    $actSaldo = $db->prepare($sql);
    
    // Ejecutar la consulta SQL con el nombre de usuario como parámetro
    $actSaldo->execute([$user]);
    
    // Obtener el resultado de la consulta
    $row = $actSaldo->fetch(PDO::FETCH_ASSOC);
    
    // Verificar si se encontraron resultados
    if ($row !== false) {
        // Obtener el saldo del primer resultado
        $saldo = $row["saldo"];
        return $saldo;
    } else {
        // Si no se encuentra el usuario, retornar un valor indicativo
        return null;
    }
}


//Comprobar saldo para compra

function comprobarPago($user, $dinero)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);
    
    // Iniciar una transacción
    $db->beginTransaction();
    
    try {
        // Preparar la consulta SQL para obtener el saldo del usuario
        $sql = "SELECT saldo FROM users WHERE username = ?";
        $stmt = $db->prepare($sql);
        
        // Ejecutar la consulta SQL con el nombre de usuario como parámetro
        $stmt->execute([$user]);
        
        // Obtener el resultado de la consulta
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si se encontraron resultados y si el saldo es suficiente
        if ($row !== false) {
            $saldo = $row["saldo"];
            if ($saldo >= $dinero) {
                // Actualizar el saldo del usuario restando el dinero
                $sql = "UPDATE users SET saldo = saldo - ? WHERE username = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$dinero, $user]);
                
                // Confirmar la transacción
                $db->commit();
                
                return true; // El usuario tiene saldo suficiente para pagar y se realizó el pago
            } else {
                // No se realiza el pago porque el usuario no tiene saldo suficiente
                return false;
            }
        } else {
            // No se realiza el pago porque el usuario no existe o no tiene saldo
            return false;
        }
    } catch (PDOException $e) {
        // Si ocurre un error, deshacer la transacción
        $db->rollBack();
        return false; // Hubo un error al realizar el pago
    }
}



//Ingresar dinero

function ingresarDinero($user, $dinero)
{
    // Leer la configuración desde el archivo XML
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);
    
    // Iniciar una transacción
    $db->beginTransaction();
    
    try {
        // Actualizar el saldo del usuario
        $sql = "UPDATE users SET saldo = saldo + ? WHERE username = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$dinero, $user]);
        
        // Confirmar la transacción
        $db->commit();
        
        return true; // El dinero se ingresó correctamente
    } catch (PDOException $e) {
        // Si ocurre un error, deshacer la transacción
        $db->rollBack();
        return false; // Hubo un error al ingresar el dinero
    }
}



// Función para obtener un producto por su código
function obtenerProductoPorCodigo($codigoProducto) {
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);
    
    // Preparar la consulta SQL para obtener el producto por su código
    $sql = "SELECT * FROM productos WHERE codProd = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$codigoProducto]);

    // Obtener el producto desde la base de datos
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $producto;
}
