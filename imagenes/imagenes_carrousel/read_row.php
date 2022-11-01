<?php
include '../../config/ROUTE.php';
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
include_once '../../config/database.php';
include_once '../../objects/carrousel.php';


$database = new Database();
$db = $database->getConnection();

$foto = new Carrousel($db);

$foto->id = isset($_GET['id']) ? $_GET['id'] : die();


$foto->read_row();

if ($foto->nombre_foto == false) {
    http_response_code(404);
    echo json_encode(array("message" => "foto does not exist."));
} else {
    if ($foto->nombre_foto != null) {

        $foto_array = array(
            "nombre_foto" => $foto->nombre_foto,
        );


        http_response_code(200);

        echo json_encode($foto_array);
    } else {

        http_response_code(500);

        echo json_encode(array("message" => "There has been an error processing your request"));
    }
}
