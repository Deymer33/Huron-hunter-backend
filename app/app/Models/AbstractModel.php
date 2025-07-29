<?php

namespace App\Models;

use App\Config\Connection;
use PDO;

abstract class AbstractModel {
    protected PDO $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    protected function fetchAll($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function fetch($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function execute($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}
