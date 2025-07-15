<?php

    class JwtConfig {
        private static $key = "my_secret_key";
        private static $issuer = "http://localhost";
        private static $audience = "http://localhost";
        private static $issueAt = null;
        private static $expirationTime = null;

        public static function getKey() {
            return self::$key;
        }

        public static function getIssuer() {
            return self::$issuer;
        }

        public function getAudience()  {
            return self::$audience;
        }

        public static function getIssueAt() {
            self::$issueAt = time();
            return self::$issueAt;
        }

        public static function getExpirationTime() {
            self::$expirationTime = self::$issueAt + 3600;
            return self::$expirationTime;
        }
    }