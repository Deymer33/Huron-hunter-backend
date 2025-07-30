<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\CategoriesModel;

class CategoriesController extends AbstractController {
    public function handleRequest(){
        $this->getCategories();
    }

    public function getCategories() {
        $model = new CategoriesModel();
        $categories = $model->getCategories();
        $this->jsonResponse($categories);
    }

}