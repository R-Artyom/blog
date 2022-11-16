<?php

// Импорт классов из разных пространств имён
use App\Application;
use App\Controllers\AuthorizationController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\RegistrationController;
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
// Страница "Детальная страница статьи"
$router->get('posts/*', [PostController::class, 'posts']);
// Страница "Добавление комментария на детальной странице статьи"
$router->post('posts/*', [PostController::class, 'posts']);
// Добавление в роутер страницы сайта "Тест" с HTTP-методом запроса GET
$router->get('test/*/test2/*', [StaticPageController::class, 'test']);
// Страница "Авторизация"
$router->get('authorization', [AuthorizationController::class, 'authorization']);
// Страница "Регистрация"
$router->get('registration', [RegistrationController::class, 'registration']);
// Страница "Правила пользования сайтом"
$router->get('terms', [StaticPageController::class, 'terms']);

// Создание класса приложения
$application = new Application($router);

// Запуск выполнения приложения с указанием URL текущей страницы и метода запроса
$application->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
