<?php

    class Database {

        private $host = "localhost";
        private $db_name = "api-rest-categorias";
        private $username = "root";
        private $password = "";
        
        public $conn;

        public function getConnection(){
            // se asegura que no exista ninguna conexión
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch (Exception $e) {
                echo "Error en la conexión: " . $e->getMessage();
            }

            return $this->conn;
        }

    }