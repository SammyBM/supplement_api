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
include_once '../objects/reporte.php';

$database = new Database();
$db = $database->getConnection();

$reporte = new Reporte($db);

$data = json_decode(file_get_contents("php://input"));

$reporte->id = $data->id;

$reporte->resumen = $data->resumen;
$reporte->texto = $data->texto;
$reporte->fechaCreacion = $data->fechaCreacion;
$reporte->articuloID = $data->articuloID;
$reporte->usuarioID = $data->usuarioID;

if ($reporte->update()) {
    http_response_code(200);

    echo json_encode(array("message" => "reporte was updated."));
} else {
    http_response_code(503);

    echo json_encode(array("message" => "Unable to update reporte."));
}
