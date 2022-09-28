<?php

// Импорт классов их разных пространств имён
use App\Application;
use App\Controllers\HomeController;
use App\Controllers\StaticPageController;
use App\Router;

// Включение отображения в браузере всех ошибок и предупреждений
error_reporting(E_ALL);
ini_set('display_errors',true);

// Подключение всех классов и функций приложения
require_once __DIR__ . '/bootstrap.php';

// Создание маршрутизатора
$router = new Router();

// Добавление в роутер страницы сайта "Главная" с HTTP-методом запроса GET
$router->get('',      [HomeController::class, 'index']);
// Добавление в роутер страницы сайта "О нас" с HTTP-методом запроса GET
$router->get('about', [StaticPageController::class, 'about']);

// Создание класса приложения
$application = new Application($router);

// Запуск выполнения приложения с указанием URL текущей страницы и метода запроса
$application->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
