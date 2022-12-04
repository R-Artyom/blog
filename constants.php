<?php
/**
 * Ссылки.
 * Замечание. Если в конце ссылки ставить символ '/' (слеш), то при отправке
 * формы метод POST превращается в GET, хотя в action формы явно указан POST
 */
// Аватарки пользователей
const PATH_IMG_USERS = '/img/users';
// Изображения к статьям
const PATH_IMG_POSTS = '/img/posts';
// Страница "Главная"
const PATH_HOME = '/';
// Страница "О нас"
const PATH_ABOUT = '/about';
// Страница "Детальная страница статьи"
const PATH_POSTS = '/posts';
// Страница "Профиль пользователя"
const PATH_PROFILE = '/profile';
// Страница "Редактирование профиля пользователя"
const PATH_PROFILE_EDIT = '/profile/edit';
// Страница "Авторизация"
const PATH_AUTHORIZATION = '/authorization';
// Страница "Разавторизация"
const PATH_LOGOUT = '/logout';
// Страница "Регистрация"
const PATH_REGISTRATION = '/registration';
// Страница "Правила пользования сайтом"
const PATH_TERMS = '/terms';

/**
 * Роли пользователей на сайте (в виде маски для прав доступа к страницам сайта)
 */
const UNREG     = 0b0001; // 1 - Незарегистрированный пользователь
const USER      = 0b0010; // 2 - Зарегистрированный пользователь
const MANAGER   = 0b0100; // 4 - Контент-менеджер
const ADMIN     = 0b1000; // 8 - Администратор
const REG       = 0b1110; // 14 - Любой зарегистрированный
const ALL       = 0b1111; // 15 - Любой пользователь

/**
 * Наименования ролей пользователей для отображения на сайте
 */
const ROLES = [
    USER => 'Пользователь',
    MANAGER => 'Контент-менеджер',
    ADMIN => 'Администратор',
];

/**
 * Массив "Права доступа к шаблонам сайта"
 */
const ACCESS_TO_PAGE = [
    'about'         => ALL, // О нас
    'authorization' => UNREG, // Авторизация
    'homepage'      => ALL, // Главнаая
    'posts'         => ALL, // Детальная страница статьи
    'profile'       => REG, // Профиль пользователя
    'registration'  => UNREG, // Регистрация
    'terms'         => ALL, // Правила пользования сайтом
    'errors/404'    => ALL, // Страница не найдена
    'errors/error'  => ALL, // Шаблон странцы не найден
];

/**
 * Признак активности в базе данных
 */
// Неактивен
const NO_ACTIVE = 0;
// Активен
const ACTIVE = 1;

/**
 * Признак активности комментария
 */
// Комментарий не прошел модерацию
const COMMENT_NO_ACTIVE = NO_ACTIVE;
// Комментарий прошел модерацию
const COMMENT_ACTIVE = ACTIVE;

/**
 * Коды исключения при работе с формами
 */
// 'Форма не отправлялась'
const FORM_NOT_SENT = 0;
// Поле 'Имя'
const FORM_NAME = 1;
// Поле 'Email'
const FORM_EMAIL = 2;
// Поле 'Пароль'
const FORM_PASSWORD = 3;
// Поле 'Повторите пароль'
const FORM_REPEAT_PASSWORD = 4;
// Чекбокс 'Правила сайта'
const FORM_TERMS = 5;
// 'Успешная регистрация'
const FORM_SUCCESS = 6;
// Поле 'Text'
const FORM_TEXT = 7;

/**
 * Выпадающее меню профиля зарегистрированного пользователя
 */
const DROPDOWN_MENU = [
    [
        'title' => 'Профиль', // Название элемента списка
        'path' => PATH_PROFILE, // Ссылка на страницу, куда ведет элемент списка
        'icon' => '<i class="bi bi-person"></i>', // Иконка
        'access' => USER | MANAGER | ADMIN, // Разрешение доступа пользователей к странице
    ],
    [
        'title' => 'Статьи',
        'path' => '/admin/posts',
        'icon' => '<i class="bi bi-book"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Комментарии',
        'path' => '/admin/comments',
        'icon' => '<i class="bi bi-chat-square-text"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Пользователи',
        'path' => '/admin/users',
        'icon' => '<i class="bi bi-people"></i>',
        'access' => ADMIN,
    ],
    [
        'title' => 'Статические страницы',
        'path' => '/admin/static',
        'icon' => '<i class="bi bi-filetype-html"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Настройки',
        'path' => '/settings',
        'icon' => '<i class="bi bi-gear"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Выйти',
        'path' => PATH_LOGOUT,
        'icon' => '<i class="bi bi-box-arrow-right"></i>',
        'access' => USER | MANAGER | ADMIN,
    ],
];
