<?php

static function sendEmail($data){
ini_set("display_errors", true);
error_reporting(E_ALL);
$from = "recuperacion_supplement_arena@samuelbarragan.tech";
$to = $data->correo;
$subject = "Recuperacion de contraseña";
$message = "Hola ".$data->nombre." a continuación están tus credenciales de Supplement Arena. \n".
"correo: ".$data->correo." \n"."Contraseña: ".$data->contraseña
}