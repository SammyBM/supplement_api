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
include_once '../objects/usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

if (
    empty($data->tipoUsuarioID) &&
    empty($data->correo) &&
    empty($data->nombre) &&
    empty($data->apellido) &&
    empty($data->nombreUsuario) &&
    empty($data->fechaNacimiento) &&
    empty($data->contrasena)
) {
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create usuario. Data incomplete."));
} else {
    $contrasena_hash = password_hash($data->contrasena, PASSWORD_DEFAULT);

    $usuario->tipoUsuarioID = $data->tipoUsuarioID;
    $usuario->correo = $data->correo;
    $usuario->nombre = $data->nombre;
    $usuario->apellido = $data->apellido;
    $usuario->nombreUsuario = $data->nombreUsuario;
    $usuario->fechaNacimiento = $data->fechaNacimiento;
    $usuario->contrasena = $contrasena_hash;

    if ($usuario->login() == null) {

        if ($usuario->create()) {

            http_response_code(201);

            echo json_encode(array("success" => "usuario created"));
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "Unable to create usuario."));
        }
    } else {
        echo json_encode(array("message" => "User already exists"));
    }
}
