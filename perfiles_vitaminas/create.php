<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age:3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../config/database.php';
include_once '../objects/perfil_vitaminas.php';

$database = new Database();
$db = $database->getConnection();

$perf = new PerfilVitaminas($db);

$data = json_decode(file_get_contents("php://input"));

if (count($data->vitaminas) != 29) {
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create perfil de vitaminas. Data incomplete."));
} else {
    $perf->vitaminas = $data->vitaminas;

    if ($perf->create()) {

        http_response_code(201);

        echo json_encode(array("success" => "Perfil vitaminas created"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Unable to create perfil vitaminas."));
    }
}
