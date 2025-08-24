<?php

use App\Config\Connection;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = Connection::getConnection();
$csvPath = __DIR__ . '/futuretools_con_categorias.csv';

if (!file_exists($csvPath)) {
    die("⚠️ Archivo CSV no encontrado en: $csvPath");
}

$csv = fopen($csvPath, 'r');
fgetcsv($csv, 0, ",", '"', "\\"); // Saltar cabecera

while (($row = fgetcsv($csv, 0, ",", '"', "\\")) !== false) {
    list($nombre, $descripcion, $enlace, $categorias, $pagina) = $row;

    // Verificar si ya existe (por nombre o enlace)
    $stmt = $pdo->prepare("SELECT id FROM tools WHERE name = ? OR link = ?");
    $stmt->execute([$nombre, $enlace]);
    $existingToolId = $stmt->fetchColumn();

    if ($existingToolId) {
        // Ya existe, saltar
        continue;
    }

    // Insertar herramienta
    $stmt = $pdo->prepare("INSERT INTO tools (name, description, link) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $enlace]);
    $tool_id = $pdo->lastInsertId();

    // Insertar categorías y relaciones
    $cats = explode(',', $categorias);
    foreach ($cats as $categoria) {
        $categoria = trim($categoria);

        $stmt = $pdo->prepare("SELECT id FROM categories WHERE name = ?");
        $stmt->execute([$categoria]);
        $cat_id = $stmt->fetchColumn();

        if (!$cat_id) {
            $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
            $stmt->execute([$categoria]);
            $cat_id = $pdo->lastInsertId();
        }

        // Verificar si la relación ya existe antes de insertar
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM tool_category WHERE tool_id = ? AND category_id = ?");
        $stmt->execute([$tool_id, $cat_id]);
        if (!$stmt->fetchColumn()) {
            $stmt = $pdo->prepare("INSERT INTO tool_category (tool_id, category_id) VALUES (?, ?)");
            $stmt->execute([$tool_id, $cat_id]);
        }
    }
}

fclose($csv);
echo json_encode(['status' => 'success', 'message' => 'Importación completada sin duplicados.']);
