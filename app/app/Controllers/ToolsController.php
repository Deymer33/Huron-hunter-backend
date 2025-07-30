<?php

namespace App\Controllers;

use App\Models\ToolsModels;
use App\Controllers\AbstractController;

class ToolsController extends AbstractController {
    protected function handleRequest(){
    }

    public function getByCategory(string $category) {
        $model = new ToolsModels();
        $tools = $model->getToolsByCategoryName($category);
        $this->jsonResponse($tools);
    }

}