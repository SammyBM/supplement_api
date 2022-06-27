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
include_once '../objects/ingrediente.php';

$database = new Database();
$db = $database->getConnection();

$ingrediente = new Ingrediente($db);

$data = json_decode(file_get_contents("php://input"));

if (
    empty($data->nombre) &&
    empty($data->alergeno)
) {
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create ingrediente. Data incomplete."));
} else {
    $ingrediente->nombre = $data->nombre;
    $ingrediente->alergeno = $data->alergeno;

    if ($ingrediente->create()) {

        http_response_code(201);

        echo json_encode(array("success" => "Ingrediente created"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Unable to create ingrediente."));
    }
}
