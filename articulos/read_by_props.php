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
$database = new Database();
$db = $database->getConnection();

$articulo = new Articulo($db);

$stmt = $articulo->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $articulos_array = array();
    $articulos_array["records"] = array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $articulo_item  = array(
            "articuloID" => $articuloID,
            "titulo" => $titulo,
            "etiquetas" => $etiquetas,
            "imagen" => $imagen,
            "categoriaID" => $categoriaID,
            "tamanoPorcion" => $tamanoPorcion,
            "calorias" => $calorias,
            "proteina" => $proteina,
            "lipidos" => $lipidos,
            "carbohidratos" => $carbohidratos
        );

        array_push($articulos_array["records"], $articulo_item);
    }

    http_response_code(200);

    echo json_encode($articulos_array);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "Articulo Not Found")
    );
}
