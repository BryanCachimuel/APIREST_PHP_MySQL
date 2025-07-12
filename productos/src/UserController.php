<?php

    require_once "../config/database.php";
    require_once "User.php";

    class UserController {

        private $db;
        private $user;
        private $contrasenia;

        public function __construct() {
            $database = new Database();
            $this->db = $database->getConnection();
            $this->user = new User($this->db);
        }

        public function register() {
            $data = json_decode(file_get_contents("php://input"));

            if(!empty($data->nombre) && !empty($data->correo) && !empty($data->contrasenia)) {
                $this->user->nombre = $data->nombre;
                $this->user->correo = $data->correo;
                $this->user->contrasenia = $data->contrasenia;

                if($this->user->register()) {
                    http_response_code(201);
                    echo json_encode(["message" => "Usuario Creado Exitosamente"]);
                } else {
                    http_response_code(503);
                    echo json_encode(["message" => "Ha ocurrido un error en la creación del usuario"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "Datos de Usuario Incompletos"]);
            }
        }

    }