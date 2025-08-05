<?php

namespace App\Routers;

use App\Controllers\ToolsController;
use App\Controllers\SearchController;
use App\Controllers\CategoriesController;


class MainRouter {
    public function handle(): void {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

   if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Allow: GET, OPTIONS');
    http_response_code(200);
    return;
    }

    $requestUri = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($requestUri, PHP_URL_PATH);

    try {
        switch ($path) {
            case '/':
                if ($requestMethod === 'GET') {
                    $controller = new CategoriesController();
                    $controller->handleRequest();
                } else {
                    $this->methodNotAllowed(['GET']);
                }
                break;

            case '/tools/category':
                if ($requestMethod === 'GET') {
                    if (!isset($_GET['name']) || trim($_GET['name']) === '') {
                        $this->errorResponse('Missing or empty "name" parameter', 400);
                        return;
                    }
                    $controller = new ToolsController();
                    $controller->getByCategory($_GET['name']);
                } else {
                    $this->methodNotAllowed(['GET']);
                }
                break;

            case '/importar':
                if ($requestMethod === 'GET') {
                    require_once __DIR__ . '/../importacion.php';
                } else {
                    $this->methodNotAllowed(['GET']);
                }
                break;


            default:
                $this->notFound();
                break;
        }
    } catch (Exception $e) {
        $this->errorResponse('Internal Server Error', 500);
        error_log($e->getMessage());
    }
    }


    private function notFound(): void {
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }

    private function methodNotAllowed(array $allowed): void {
        http_response_code(405);
        header('Allow: ' . implode(', ', $allowed));
        echo json_encode(['error' => 'Method Not Allowed']);
    }
}
