<?php

include '../config/ROUTE.php';
header('Access-Control-Allow-Origin:'.$ROUTE.'');
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
include_once '../objects/perfil_acidos_grasos.php';

$database = new Database();
$db = $database->getConnection();

$perf = new PerfilAG($db);

$data = json_decode(file_get_contents("php://input"));

if (count($data->aminos) != 2) {
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create perfil de acidos grasos. Data incomplete."));
} else {
    $perf->acidosGrasos = $data->acidosGrasos;

    if ($perf->create()) {

        http_response_code(201);

        echo json_encode(array("success" => "Perfil acidos grasos created"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Unable to create perfil acidos grasos."));
    }
}
