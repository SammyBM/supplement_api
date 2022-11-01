<?php

const CARROUSEL_IMGS_DIR = "imagenes_carrousel/";

include '../../config/ROUTE.php';
include '../ImageController.php';
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

$carrouselImg = new Carrousel($db);

var_dump($_POST);
if (isset($_POST['fileToUpload']['name'])) {
    $img_name  =  $_FILES['fileToUpload']['name'];
    $tmp_img_name = $_FILES['fileToUpload']['tmp_name'];

    if (move_uploaded_file($tmp_img_name, $img_name))
        echo json_encode(array('Success' => "Se ha mandado la imagen alv"));
    else
        echo json_encode(array('Error' => "Vales v"));
} else {
    echo json_encode($_POST);
    die();
}
//$data = json_decode(file_get_contents("php://input"));


//echo json_encode($_FILES['imgObj']['name']);

/* if (empty($data->nombre_foto)) {
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create carrouselImg. Data incomplete."));
} else {
    $data->nombre_foto = hash(hash_algos()[2], $data->nombre_foto, false);
    $carrouselImg->nombre_foto = $data->nombre_foto;

    if ($carrouselImg->read_by_name() != false) {
        http_response_code(409);

        echo array("message" => "We have detected an existing file with the same name.");
    } else {

        if (uploadProductImage($carrouselImg->nombre_foto, CARROUSEL_IMGS_DIR, $data->bitmap)) {

            if ($carrouselImg->create()) {
                http_response_code(201);

                echo json_encode(array("success" => "carrouselImg created"));
            }
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "Unable to create carrouselImg."));
        }
    }
} */
