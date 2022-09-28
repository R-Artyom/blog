<?php

use App\Application;
use App\Controllers\HomeController;
use App\Controllers\StaticPageController;
use App\Router;

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once __DIR__ . '/bootstrap.php';

$router = new Router();

$router->get('',      [HomeController::class, 'index']);
$router->get('about', [StaticPageController::class, 'about']);

$application = new Application($router);

// @todo: передайте http-метод текущего запроса вторым параметром
$application->run($_SERVER['REQUEST_URI'], '');
