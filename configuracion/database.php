<?php


function cargarEnv($ruta) {
    if (!file_exists($ruta)) return;
    $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        if (strpos(trim($linea), '#') === 0) continue; 
        list($clave, $valor) = explode('=', $linea, 2);
        $clave = trim($clave);
        $valor = trim($valor);
        putenv("$clave=$valor");
        $_ENV[$clave] = $valor;
    }
}


function conectarDb(): mysqli{
    cargarEnv(__DIR__ . '/.env');
    $host = getenv('DB_HOST');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');
    $dbname = getenv('DB_DATABASE');

    $db = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($db, "utf8mb4");
    if (!$db) {
        echo "Error: No se pudo conectar a la base de datos.";
        exit;
    }
 
    return $db;
}

function conectarDbPDO(){
        cargarEnv(__DIR__ . '/.env');
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_DATABASE');
        $dbUser = getenv('DB_USERNAME');
        $dbPass = getenv('DB_PASSWORD');
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
   return $db;
}




?>