<?php
require_once __DIR__ . '/../../vendor/autoload.php';


use App\Controllers\AbstractController;
use App\Models\ToolsModel;

class ToolsController extends AbstractController {
    protected function handleRequest(){
    }

    public function getByCategory(string $category) {
        $model = new ToolModels();
        $tools = $model->getToolsByCategoryName($category);
        $this->jsonResponse($tools);
    }

}