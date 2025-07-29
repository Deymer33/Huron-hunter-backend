<?php
require_once __DIR__ . '/../../vendor/autoload.php';


use App\Controllers\AbstractController;
use App\Models\CategoriesModel;

class CategoriesController extends AbstractController {
    protected function handleRequest(){
        $this->getCategories();
    }

    public function getCategories() {
        $model = new CategoriesModel();
        $categories = $model->getCategories();
        $this->jsonResponse($categories);
    }

}