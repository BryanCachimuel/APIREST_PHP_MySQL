<?php

    class Product {

        private $conn;
        private $table_name = "tm_productos";

        public $id;
        public $nombre;
        public $descripcion;
        public $precio;
        public $creado_en;

        // se inicializa la petición de conexión hacia la base de datos
        public function __construct($db) {
            $this->conn = $db;
        }

        public function create() {
            $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, precio=:precio";
            $stmt = $this->conn->prepare($query);

            // se limpian los atributos antes de ser ingresados
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->precio = htmlspecialchars(strip_tags($this->precio));

            // Parámetros que se quieren enviar para llenarlos de información
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":precio", $this->precio);

            // si todo esta correcto
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function read() {
            $query = "SELECT id, nombre, descripcion, precio FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function update() {
            $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id";
            $stmt = $this->conn->prepare($query);

             // se limpian los atributos antes de ser ingresados
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->precio = htmlspecialchars(strip_tags($this->precio));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Parámetros que se quieren enviar para llenarlos de información
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->bindParam(":id", $this->id);

            // si todo esta correcto
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function delete() {
            
        }

    }