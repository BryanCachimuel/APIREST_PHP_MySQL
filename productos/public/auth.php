<?php

require_once "../src/AuthController.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER["REQUEST_METHOD"];
$authController = new AuthController();

switch ($method) {
    case 'POST':
        $authController->login();
        break;

    default:
        // método que no está permitido en la API 
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido"]);
        break;
}
