<?php

// Импорт классов из разных пространств имён
use App\Application;
use App\Controllers\AuthorizationController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\ProfileController;
use App\Controllers\RegistrationController;
use App\Controllers\StaticPageController;
use App\Router;
use App\Session;

// Включение отображения в браузере всех ошибок и предупреждений
error_reporting(E_ALL);
ini_set('display_errors',true);

// Подключение всех классов и функций приложения
require_once __DIR__ . '/bootstrap.php';

// Создание экземпляра сессии
$session = new Session();
// Продление сессии
$session->run();

// Создание маршрутизатора
$router = new Router();
// Добавление в роутер страницы сайта "Главная" с HTTP-методом запроса GET
$router->get(PATH_HOME, [HomeController::class, 'index']);
// Добавление в роутер страницы сайта "О нас" с HTTP-методом запроса GET
$router->get(PATH_ABOUT, [StaticPageController::class, 'about']);
// Страница "Детальная страница статьи"
$router->get(PATH_POSTS . '/*', [PostController::class, 'posts']);
// Страница "Детальная страница статьи - добавление комментария"
$router->post(PATH_POSTS . '/*', [PostController::class, 'posts']);
// Страница "Профиль пользователя"
$router->get(PATH_PROFILE, [ProfileController::class, 'profile']);
// Добавление в роутер страницы сайта "Тест" с HTTP-методом запроса GET
$router->get('test/*/test2/*', [StaticPageController::class, 'test']);
// Страница "Авторизация"
$router->get(PATH_AUTHORIZATION, [AuthorizationController::class, 'authorization']);
// Страница "Авторизация - отправка формы"
$router->post(PATH_AUTHORIZATION, [AuthorizationController::class, 'authorization']);
// Страница "Разавторизация"
$router->get(PATH_LOGOUT, [AuthorizationController::class, 'logOut']);
// Страница "Регистрация"
$router->get(PATH_REGISTRATION, [RegistrationController::class, 'registration']);
// Страница "Регистрация - отправка формы"
$router->post(PATH_REGISTRATION, [RegistrationController::class, 'registration']);
// Страница "Правила пользования сайтом"
$router->get(PATH_TERMS, [StaticPageController::class, 'terms']);

// Создание класса приложения
$application = new Application($router);
// Запуск выполнения приложения с указанием URL текущей страницы и метода запроса
$application->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
