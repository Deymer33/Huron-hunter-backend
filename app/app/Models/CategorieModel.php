<?php

namespace App\Models;

class CategoriesModel extends AbstractModel {
    public function getCategories() {
        $sql = "SELECT * FROM categories";
        return $this->fetchAll($sql);
    }

}