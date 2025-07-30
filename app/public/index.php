<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Routers\MainRouter;

$router = new MainRouter();
$router->handle();