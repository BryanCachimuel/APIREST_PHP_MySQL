<?php

require_once "../src/ProductController.php";
require_once "../src/AuthController.php";
require_once "../src/UserController.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER["REQUEST_METHOD"];
$headers = getallheaders();
$authHeader = isset($headers["Authorization"]) ? $headers["Authorization"] : "";
$publicRoutes = ["register"];

$page = isset($_GET["user"]) ? $_GET["user"] : "/";

if (!in_array($page, $publicRoutes)) {
    if (preg_match("/Bearer\s(\S+)/", $authHeader, $matches)) {
        $token = $matches[1];

        try {
            AuthController::validateToken($token);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["message" => "Acceso no autorizado", "error" => $e->getMessage()]);
            exit();
        }
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Token no autorizado"]);
        exit();
    }
}

$productController = new ProductController();
$userController = new UserController();

switch ($method) {
    case 'POST':
        if ($page == "register") {
            $userController->register();
        } elseif ($page == "create-product") {
            $productController->create();
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Método no permitido"]);
        }
        break;

    case 'GET':
        if ($page == "/") {
            $productController->read();
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Método no permitido"]);
        }
        break;

    case 'PUT':
        if($page == "/") {
            $productController->update();
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Método no permitido"]);
        }
        break;

    case 'DELETE':
        if($page == "/") {
            $productController->delete();
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Método no permitido"]);
        }
        break;

    default:
        // método que no está permitido en la API 
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido"]);
        break;
}
