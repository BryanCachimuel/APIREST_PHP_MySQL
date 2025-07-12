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
    }
