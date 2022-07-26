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
include_once '../objects/articulo.php';

$database = new Database();
$db = $database->getBeautyConnection();

$articulo = new Articulo($db);

$data = json_decode(file_get_contents("php://input"));
var_dump($data);
if (
    empty($data->titulo) &&
    empty($data->etiquetas) &&
    empty($data->imagen) &&
    empty($data->categoriaID) &&
    empty($data->tamanoPorcion) &&
    empty($data->calorias) &&
    empty($data->proteina) &&
    empty($data->lipidos) &&
    empty($data->carbohidratos)
) {
    http_response_code(400);

    echo json_encode(array($data->titulo, $data->etiquetas, $data->imagen, $data->categoriaID, $data->tamanoPorcion, $data->calorias, $data->proteina, $data->lipidos, $data->carbohidratos));
    echo json_encode(array("message" => "Unable to create articulo. Data incomplete."));
} else {
    $articulo->titulo = $data->titulo;
    $articulo->etiquetas = $data->etiquetas;
    $articulo->imagen = $data->imagen;
    $articulo->categoriaID = $data->categoriaID;
    $articulo->tamanoPorcion = $data->tamanoPorcion;
    $articulo->calorias = $data->calorias;
    $articulo->proteina = $data->proteina;
    $articulo->lipidos = $data->lipidos;
    $articulo->carbohidratos = $data->carbohidratos;
    $verify=json_decode($articulo->create());
    if ($verify->status) {

        http_response_code(201);

        echo json_encode(array("success" => "Articulo created","id" =>$verify->data ));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Unable to create articulo."));
    }
}
