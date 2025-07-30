<?php

namespace App\Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connection {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            $host = $_ENV['DB_HOST'];
            $namedb = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];

            try {
                $dsn = "mysql:host=127.0.0.1;dbname={$namedb};charset=utf8mb4";
                self::$conn = new PDO($dsn, $user, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
                exit;
            }
        }

        return self::$conn;
    }
}
