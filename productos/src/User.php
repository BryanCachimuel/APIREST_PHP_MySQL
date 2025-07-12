<?php

    class User {
        private $conn;
        private $table_name = "tm_usuarios";

        public $id;
        public $nombre;
        public $correo;
        public $contrasenia;

        // se inicializa la petición de conexión hacia la base de datos
        public function __construct($db) {
            $this->conn = $db;
        }

        public function findByEmail(){
            $query = "SELECT * FROM " . $this->table_name . " WHERE correo = :correo LIMIT 1";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":correo", $this->correo);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function register() {
            $query = "INSERT INTO " . $this->table_name . " SET nombre = :nombre, correo = :correo, contrasenia = :contrasenia ";
            $stmt = $this->conn->prepare($query);

            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->correo = htmlspecialchars(strip_tags($this->correo));
            $this->contrasenia = htmlspecialchars(strip_tags($this->contrasenia));

            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":correo", $this->correo);
            $stmt->bindParam(":contrasenia", $this->contrasenia);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
