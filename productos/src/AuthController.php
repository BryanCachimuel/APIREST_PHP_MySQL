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

        
    }