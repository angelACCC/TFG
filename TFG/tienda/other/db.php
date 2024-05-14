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
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);


    $query = "SELECT * FROM productos where idcategoria = :cat;";
    $statement = $db->prepare($query);
    $statement->bindParam(':cat', $categoria);
    $statement->execute();
    $productos = $statement->fetchAll(PDO::FETCH_ASSOC);


    return $productos;
}

// function insertar_pedido($carro, $coduser)
// {
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
    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);

    // Verificar los valores antes de la transacción
    $fecha = date("Y-m-d");
    $enviado = 1;
    echo "Fecha: $fecha, Enviado: $enviado, Usuario ID: $coduser";

    $db->beginTransaction();

    try {
        $insertPedido = "INSERT INTO pedidos (ped_time, enviado, iduser) VALUES (:fecha, :enviado, :fkidusuario);";
        $statementPedido = $db->prepare($insertPedido);
        
        // Ejecutar la consulta de inserción de pedido
        $statementPedido->bindParam(':fecha', $fecha);
        $statementPedido->bindParam(':enviado', $enviado);
        $statementPedido->bindParam(':fkidusuario', $coduser);
        if ($statementPedido->execute()) {
            echo "Consulta de inserción de pedido ejecutada correctamente.";
        } else {
            echo "Error al ejecutar la consulta de inserción de pedido.";
        }

        $pedidoID = $db->lastInsertId();

        $inserDetpedido = "INSERT INTO pedidosproductos (pedido, producto, unidades) VALUES (:Pedido, :Producto, :Unidades);";
        $detPedido = $db->prepare($inserDetpedido);
        $_SESSION['codPed'] = $pedidoID;
        
        // Ejecutar la consulta de inserción de detalles de pedido
        foreach ($carro as $codProd => $unidades) {
            $detPedido->bindParam(':Pedido', $pedidoID);
            $detPedido->bindParam(':Producto', $codProd);
            $detPedido->bindParam(':Unidades', $unidades);
            if ($detPedido->execute()) {
                echo "Consulta de inserción de detalles de pedido ejecutada correctamente.";
            } else {
                echo "Error al ejecutar la consulta de inserción de detalles de pedido.";
            }
        }
      
        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollBack();
        var_dump($e->getMessage());
        return false;
    }
}

//Hay que mirarlo
function eliminarproducto($codProd, $Stock)
{

    $res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
    $db = new PDO($res[0], $res[1], $res[2]);

    $updateDetPedido = "UPDATE productos SET Stock = Stock - :Stock WHERE CodProd = :Producto;";
    $updateDet = $db->prepare($updateDetPedido);
    $updateDet->bindParam(':Stock', $Stock);
    $updateDet->bindParam(':Producto', $codProd);
    $updateDet->execute();

}

