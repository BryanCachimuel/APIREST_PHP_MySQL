<?php

    require_once "../config/database.php";
    require_once "Product.php";

    class ProductController {

        private $db;
        private $product;

        // Inicializando la conexión hacia la base de datos y al model Product
        public function __construct() {
            $database = new Database();
            $this->db = $database->getConnection();
            $this->product = new Product($this->db);
        }

        public function create() {
            // decodificando el json que viene desde el formulario y desde sus respectivos inputs
            $data = json_decode(file_get_contents("php://input"));

            // validando que no vengan los campos vacios
            if (!empty($data->nombre) && !empty($data->descripcion) && !empty($data->precio)) {
                $this->product->nombre = $data->nombre;
                $this->product->descripcion = $data->descripcion;
                $this->product->precio = $data->precio;

                // guardar el nuevo registro
                if ($this->product->create()) {
                    // código que afirma la creación de un registro
                    http_response_code(201);
                    echo json_encode(["message" => "Producto Creado Exitosamente"]);
                } else {
                    // código de error en el servidor
                    http_response_code(503);
                    echo json_encode(["message" => "El Producto no se creo"]);
                }
            } else {
                // código de error con el cliente
                http_response_code(400);
                echo json_encode(["message" => "Datos incompletos para crear el producto"]);
            }
            
        }

        public function read() {
            
        }

        public function update() {
            
        }

        public function delete() {
            
        }

    }