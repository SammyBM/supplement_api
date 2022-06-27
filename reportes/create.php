<?php
include_once '../config/database.php';
include_once '../objects/reporte.php';
header('Access-Control-Allow-Origin: http://localhost:3000');
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
$database = new Database();
$db = $database->getConnection();

$reporte = new Reporte($db);

$json = file_get_contents('php://input');
$data = json_decode($json);

if (
    empty($data->resumen) &&
    empty($data->texto) &&
    empty($data->fechaCreacion) &&
    empty($data->articuloID) &&
    empty($data->usuarioID)
) {
    http_response_code(400);

    echo json_encode(array("status"=>"false","message" => "Unable to create reporte. Data incomplete."));
} else {
    $reporte->resumen = $data->resumen;
    $reporte->texto = $data->texto;
    $reporte->fechaCreacion = $data->fechaCreacion;
    $reporte->articuloID = $data->articuloID;
    $reporte->usuarioID = $data->usuarioID;

    if ($reporte->create()) {

        http_response_code(201);

        echo json_encode(array("status"=>"tru","success" => "reporte created"));
    } else {
        http_response_code(503);

        echo json_encode(array("status"=>"false","message" => "Unable to create reporte."));
    }
}
