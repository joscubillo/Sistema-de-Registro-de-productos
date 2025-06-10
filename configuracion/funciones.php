<?




function obtenerFilas($db, $query) {
    $result = mysqli_query($db, $query);

    if (!$result) {
       
        error_log("Error en la consulta: " . mysqli_error($db));
        return [];
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function obtenerFilasAsociativas($db, $query) {

    $result = mysqli_query($db, $query);

    if (!$result) {
        error_log("Error en la consulta: " . mysqli_error($db));
        return [];
    }

    $filas = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $filas[] = $fila;
    }

    return $filas;
}


function ejecutarConsulta($db, $query, $params = [], $tipos = "") {
    $stmt = $db->prepare($query);

    if (!$stmt) {
        error_log("Error preparando consulta: " . $db->error);
        return [
            'success' => false,
            'error' => "Error en la preparación: " . $db->error
        ];
    }

    if (!empty($params) && $tipos !== "") {
        $stmt->bind_param($tipos, ...$params);
    }

    $ejecutado = $stmt->execute();

    if ($ejecutado) {
        return ['success' => true];
    } else {
        error_log("Error al ejecutar consulta: " . $stmt->error);
        return [
            'success' => false,
            'error' => "Error en la ejecución: " . $stmt->error
        ];
    }

    $stmt->close();
}   


?>