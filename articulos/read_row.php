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
$db = $database->getConnection();

$articulo = new Articulo($db);

$articulo->id = isset($_GET['id']) ? $_GET['id'] : die();


$articulo->readRow();

if ($articulo->titulo != null) {

    $articulo_array = array(
        "articuloID" => $articulo->id,
        "titulo" => $articulo->titulo,
        "etiquetas" => $articulo->etiquetas,
        "imagen" => $articulo->imagen,
        "categoriaID" => $articulo->categoriaID,
        "tamanoPorcion" => $articulo->tamanoPorcion,
        "calorias" => $articulo->calorias,
        "proteina" => $articulo->proteina,
        "lipidos" => $articulo->lipidos,
        "carbohidratos" => $articulo->carbohidratos
    );


    http_response_code(200);

    echo json_encode($articulo_array);
} else {

    http_response_code(404);

    echo json_encode(array("message" => "Articulo does not exist."));
}
