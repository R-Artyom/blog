<?php
/**
 * Загрузка файлов
 */
// Максимально допустимый размер загружаемого файла (в байтах)
const MAX_FILE_SIZE = 2097152; // 2 Мб
// Список разрешенных типов изображений
const ALLOWED_IMG_TYPE = ['image/jpeg', 'image/png'];

/**
 * Ссылки.
 * Замечание. Если в конце ссылки ставить символ '/' (слеш), то при отправке
 * формы метод POST превращается в GET, хотя в action формы явно указан POST
 */
// Аватарки пользователей
const PATH_IMG_USERS = '/img/users';
// Изображения к статьям
const PATH_IMG_POSTS = '/img/posts';
// Изображения к статичным страницам
const PATH_IMG_PAGES = '/img/pages';
// Логи писем с уведомлениями
const PATH_LOGS_MAILS = '/logs/mails';
// Страница "Главная"
const PATH_HOME = '/';
// Страница "О нас"
const PATH_ABOUT = '/about';
// Страница "Управление комментариями"
const PATH_ADMIN_COMMENTS = '/admin/comments';
// Страница "Управление статьями"
const PATH_ADMIN_POSTS = '/admin/posts';
// Страница "Управление статичными страницами"
const PATH_ADMIN_PAGES = '/admin/pages';
// Страница "Управление пользователями"
const PATH_ADMIN_USERS = '/admin/users';
// Страница "Статичная"
const PATH_STATIC_PAGES = '/static_pages';
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
// Страница "Оформление подписки"
const PATH_SUBSCRIPTION = '/subscription';

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
    'admin_comments' => ADMIN | MANAGER, // Управление комментариями
    'admin_post_edit' => ADMIN | MANAGER, // Редактирование статьи
    'admin_posts'   => ADMIN | MANAGER, // Управление статьями
    'admin_pages'  => ADMIN | MANAGER, // Управление статичными страницами
    'admin_page_edit'  => ADMIN | MANAGER, // Редактирование статичной страницы
    'admin_users'   => ADMIN, // Управление пользователями
    'authorization' => UNREG, // Авторизация
    'homepage'      => ALL, // Главнаая
    'pages'         => ALL, // Страница статичная
    'posts'         => ALL, // Детальная страница статьи
    'profile'       => REG, // Профиль пользователя
    'profile_edit'  => REG, // Редактирование профиля пользователя
    'registration'  => UNREG, // Регистрация
    'subscription'  => ALL, // Оформление подписки
    'terms'         => ALL, // Правила пользования сайтом
    'errors/404'    => ALL, // Страница не найдена
    'errors/error'  => ALL, // Шаблон странцы не найден
];

/**
 * Признак активности в базе данных
 */
// Неактивен
const NO = 0;
// Активен
const YES = 1;

/**
 * Признак активности комментария
 */
// Комментарий не прошел модерацию
const COMMENT_NO_ACTIVE = NO;
// Комментарий прошел модерацию
const COMMENT_ACTIVE = YES;

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
// Поле 'Загрузить изображение'
const FORM_IMAGE = 8;
// Поле 'Заголовок'
const FORM_TITLE = 9;
// Поле 'Краткое описание статьи'
const FORM_SHORT_TEXT = 10;

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
        'path' => PATH_ADMIN_POSTS,
        'icon' => '<i class="bi bi-book"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Комментарии',
        'path' => PATH_ADMIN_COMMENTS,
        'icon' => '<i class="bi bi-chat-square-text"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Статичные страницы',
        'path' => PATH_ADMIN_PAGES,
        'icon' => '<i class="bi bi-filetype-html"></i>',
        'access' => MANAGER | ADMIN,
    ],
    [
        'title' => 'Пользователи',
        'path' => PATH_ADMIN_USERS,
        'icon' => '<i class="bi bi-people"></i>',
        'access' => ADMIN,
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
