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
            $stmt = $this->product->read();
            $num = $stmt->rowCount();

            if($num > 0) {
                $product_array = [];
                $product_array["registros"] = [];

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                    $product_item = [
                        "id" => $id,
                        "nombre" => $nombre,
                        "descripcion" => $descripcion,
                        "precio" => $precio
                    ];

                    array_push($product_array["registros"], $product_item);
                }

                http_response_code(200);
                echo json_encode($product_array);
            }
            else {
                http_response_code(400);
                echo json_encode(["message" => "No se encontraron productos"]);
            }
        }

        public function update() {
            
        }

        public function delete() {
            
        }

    }