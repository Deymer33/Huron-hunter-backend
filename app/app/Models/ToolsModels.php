<?php


namespace App\Models;

class ToolsModels extends AbstractModel {
    public function getToolsByCategoryName(string $category): array {
        $sql = "
            SELECT t.id, t.description, t.link, t.name
            FROM tools t
            JOIN tool_category tc ON t.id = tc.tool_id
            JOIN categories c ON c.id = tc.category_id
            WHERE c.name = :name
        ";

        return $this->fetchAll($sql, ['name' => $category]);
    }
}