<?php

    require_once "../config/database.php";
    require_once "../config/jwt_config.php";
    require_once "../vendor/autoload.php";
    require_once "User.php";

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    class AuthController {
        private $db;
        private $user;

        public function __construct() {
            $database = new Database();
            $this->db = $database;
            $this->user = new User($this->db);
        }

       public function login() {
         $data = json_decode(file_get_contents("php://input"));

         if(!empty($data->correo) && !empty($data->contrasenia)) {
            $this->user->correo = $data->correo;
            $user = $this->user->findByEmail();

            if ($user && password_verify($data->contrasenia, $user["contrasenia"])) {
                $token = [
                    "iss" => JwtConfig::getIssuer(),
                    "aud" => JwtConfig::getAudience(),
                    "iat" => JwtConfig::getIssueAt(),
                    "exp" => JwtConfig::getExpirationTime(),
                    "data" => [
                        "id" => $user["id"],
                        "correo" => $user["correo"]
                    ]
                ];
               
                $jwt = JWT::encode($token, JwtConfig::getKey(), 'HS256');
                http_response_code(200);
                echo json_encode(["message" => "Inicio de sesión exitoso", "token" => $jwt]);
            } else {
                http_response_code(401);
                echo json_encode(["message" => "Correo o Contraseña Incorrectos"]);
            }
            
         }else {
            http_response_code(400);
            echo json_encode(["message" => "Datos Incompletos"]);
         }
       } 
    }