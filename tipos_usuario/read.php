<?php

include '../config/ROUTE.php';
header('Access-Control-Allow-Origin:' . $ROUTE . '');
header("Access-Control-Allow-Credentials: true");
header("Accept: application/json, text/plain");
//headers que permiten requests al mismo servidor, potencialmente no necesarios cuando este distribuido 
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//header que permite utilzar json 
header('content-type: application/json; charset=utf-8');
header('mode:cors');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is using the POST method
    header("HTTP/1.1 200 OK");
    return;
}

include_once '../config/database.php';
include_once '../objects/tipo_usuario.php';

$database = new Database();
$db = $database->getConnection();

$tipoUsuario = new TipoUsuario($db);

$stmt = $tipoUsuario->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $tipoUsuarios_array = array();
    $tipoUsuarios_array["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tipoUsuario_item  = array(
            "tipoUsuarioID" => $tipoUsuarioID,
            "tipo" => $tipo,
        );

        array_push($tipoUsuarios_array["records"], $tipoUsuario_item);
    }

    http_response_code(200);

    echo json_encode($tipoUsuarios_array);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "Not Found")
    );
}
