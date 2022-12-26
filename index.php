<?php

// Импорт классов из разных пространств имён
use App\Application;
use App\Controllers\AdminCommentsController;
use App\Controllers\AdminPostController;
use App\Controllers\AdminPageController;
use App\Controllers\AdminSettingsController;
use App\Controllers\AdminUserController;
use App\Controllers\AuthorizationController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\ProfileController;
use App\Controllers\RegistrationController;
use App\Controllers\StaticPageController;
use App\Controllers\SubscriptionController;
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
// Добавление в роутер страницы сайта "О нас" с HTTP-методом запроса GET
$router->get(PATH_ABOUT, [StaticPageController::class, 'about']);
// Страница "Управление комментариями"
$router->get(PATH_ADMIN_COMMENTS, [AdminCommentsController::class, 'adminComments']);
// Страница "Редактирование комментария"
$router->post(PATH_ADMIN_COMMENTS . '/*/edit', [AdminCommentsController::class, 'adminComments']);
// Страница "Управление статьями"
$router->get(PATH_ADMIN_POSTS, [AdminPostController::class, 'adminPost']);
// Страница "Редактирование статьи"
$router->get(PATH_ADMIN_POSTS . '/*/edit', [AdminPostController::class, 'adminPostEdit']);
// Страница "Редактирование статьи - отправка формы"
$router->post(PATH_ADMIN_POSTS . '/*/edit', [AdminPostController::class, 'adminPostEdit']);
// Страница "Добавление новой статьи"
$router->get(PATH_ADMIN_POSTS . '/add', [AdminPostController::class, 'adminPostAdd']);
// Страница "Добавление новой статьи - отправка формы"
$router->post(PATH_ADMIN_POSTS . '/add', [AdminPostController::class, 'adminPostAdd']);
// Страница "Удаление статьи"
$router->post(PATH_ADMIN_POSTS . '/*/delete', [AdminPostController::class, 'adminPostDelete']);
// Страница "Управление пользователями"
$router->get(PATH_ADMIN_USERS, [AdminUserController::class, 'adminUsers']);
// Страница "Редактирование профиля пользователя"
$router->post(PATH_ADMIN_USERS, [AdminUserController::class, 'adminUsers']);
// Страница "Авторизация"
$router->get(PATH_AUTHORIZATION, [AuthorizationController::class, 'authorization']);
// Страница "Авторизация - отправка формы"
$router->post(PATH_AUTHORIZATION, [AuthorizationController::class, 'authorization']);
// Добавление в роутер страницы сайта "Главная" с HTTP-методом запроса GET
$router->get(PATH_HOME, [HomeController::class, 'index']);
// Страница "Разавторизация"
$router->get(PATH_LOGOUT, [AuthorizationController::class, 'logOut']);
// Страница "Детальная страница статьи"
$router->get(PATH_POSTS . '/*', [PostController::class, 'posts']);
// Страница "Детальная страница статьи - добавление комментария"
$router->post(PATH_POSTS . '/*', [PostController::class, 'posts']);
// Страница "Профиль пользователя"
$router->get(PATH_PROFILE, [ProfileController::class, 'profile']);
// Страница "Редактирование профиля пользователя"
$router->get(PATH_PROFILE_EDIT, [ProfileController::class, 'profileEdit']);
// Страница "Редактирование профиля пользователя" - отправка формы
$router->post(PATH_PROFILE_EDIT, [ProfileController::class, 'profileEdit']);
// Добавление в роутер страницы сайта "Тест" с HTTP-методом запроса GET
$router->get('test/*/test2/*', [StaticPageController::class, 'test']);
// Страница "Регистрация"
$router->get(PATH_REGISTRATION, [RegistrationController::class, 'registration']);
// Страница "Регистрация - отправка формы"
$router->post(PATH_REGISTRATION, [RegistrationController::class, 'registration']);
// Страница "Управление статичными страницами"
$router->get(PATH_ADMIN_PAGES, [AdminPageController::class, 'adminStatic']);
// Страница "Редактирование статичной страницы"
$router->get(PATH_ADMIN_PAGES . '/*/edit', [AdminPageController::class, 'adminStaticEdit']);
// Страница "Редактирование статичной страницы - отправка формы"
$router->post(PATH_ADMIN_PAGES . '/*/edit', [AdminPageController::class, 'adminStaticEdit']);
// Страница "Добавление новой статичной страницы"
$router->get(PATH_ADMIN_PAGES . '/add', [AdminPageController::class, 'adminStaticAdd']);
// Страница "Добавление новой статичной страницы - отправка формы"
$router->post(PATH_ADMIN_PAGES . '/add', [AdminPageController::class, 'adminStaticAdd']);
// Страница "Удаление статичной страницы"
$router->post(PATH_ADMIN_PAGES . '/*/delete', [AdminPageController::class, 'adminStaticDelete']);
// Страница "Статичная"
$router->get(PATH_STATIC_PAGES . '/*', [StaticPageController::class, 'staticPages']);
// Страница "Управление настройками"
$router->get(PATH_ADMIN_SETTINGS, [AdminSettingsController::class, 'adminSettings']);
// Страница "Управление настройками"
$router->post(PATH_ADMIN_SETTINGS, [AdminSettingsController::class, 'adminSettings']);
// Страница "Оформление подписки"
$router->post(PATH_SUBSCRIPTION, [SubscriptionController::class, 'subscription']);
// Страница "Отписка по ссылке"
$router->get(PATH_SUBSCRIPTION, [SubscriptionController::class, 'unsubscriptionByLink']);
// Страница "Правила пользования сайтом"
$router->get(PATH_TERMS, [StaticPageController::class, 'terms']);

// Создание класса приложения
$application = new Application($router);
// Запуск выполнения приложения с указанием URL текущей страницы и метода запроса
$application->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
