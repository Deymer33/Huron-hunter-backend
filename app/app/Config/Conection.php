<?php

namespace App\Config;


use PDO;
use PDOException;
use Dotenv\Dotenv;

class Conection{

    private $conn;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../../'); 
        $dotenv->load();
    }

    public function getConection() {
        $this->conn = null;

        $host = $_ENV['DB_HOST'];
        $namedb = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
           $dsn = "mysql:host={$host};dbname={$namedb};charset=utf8mb4";
            $this->conn = new PDO($dsn, $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error of conexión: " . $e->getMessage();
            exit;
        }

        return $this->conn;
    }
}