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

    }