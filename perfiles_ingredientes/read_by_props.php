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
include_once '../objects/perfil_ingredientes.php';

$database = new Database();
$db = $database->getConnection();

$perf = new PerfilIngredientes($db);

$perf->acidosGrasos = isset($_GET['perfil_busqueda']) ? json_decode($_GET['perfil_busqueda']) : die();

$stmt = $perf->readByProps();
$num = sizeof($stmt);

if ($num > 0) {
    $perfs_array = array();
    $perfs_array["records"] = array();

    for ($i = 0; $i < $num; $i++) {
        while ($row = $stmt[$i]->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $perf_item  = array(
                "articuloID" => $articuloID,
                "ingredienteID" => $ingredienteID,
                "alergeno" => $alergeno
            );

            array_push($perfs_array["records"], $perf_item);
        }
    }

    http_response_code(200);

    echo json_encode($perfs_array);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "Perfil acidos grasos Not Found")
    );
}
