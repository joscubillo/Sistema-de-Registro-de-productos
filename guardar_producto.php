<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Método no permitido.']);
    exit;
}

require './configuracion/database.php';
$db = conectarDb();


$codigo = trim($_POST['codigo'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
$id_bodega = intval($_POST['bodega'] ?? 0);
$id_sucursal = intval($_POST['sucursal'] ?? 0);
$id_moneda = intval($_POST['moneda'] ?? 0); 
$precio = floatval(str_replace(',', '.', $_POST['precio'] ?? '0'));
$descripcion = trim($_POST['descripcion'] ?? '');
$materiales = $_POST['material'] ?? [];


$materialesTexto = json_encode($materiales, JSON_UNESCAPED_UNICODE); 

try {
   
    $sql = "INSERT INTO productos (codigo, nombre, id_bodega, id_sucursal, id_moneda, precio, materiales, descripcion) 
            VALUES ('$codigo', '$nombre', $id_bodega, $id_sucursal, $id_moneda, $precio, '$materialesTexto', '$descripcion')";
    
   
    $resultado = $db->query($sql);
    
    if ($resultado) {
        echo json_encode(['estado' => 'exito']);
    } else {
        throw new Exception("Error en la ejecución de la consulta");
    }
} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Error al guardar: ' . $e->getMessage()]);
}