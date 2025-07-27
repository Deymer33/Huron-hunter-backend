<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Conection;


echo "Intentando conectar a la base de datos...\n";

try {
    $dbConnection = new Conection();
    $pdo = $dbConnection->getConection();

    if ($pdo instanceof PDO) {
        echo "¡Conexión exitosa a la base de datos!\n";
        $server_info = $pdo->getAttribute(PDO::ATTR_SERVER_INFO);
        echo "Información del servidor: " . $server_info . "\n";
    } else {
        echo "La conexión no devolvió un objeto PDO válido.\n";
    }

} catch (Exception $e) {
    echo "Se produjo un error al intentar conectar: " . $e->getMessage() . "\n";
}
