<?php

// Корень проекта
const APP_DIR = __DIR__ . '/';
// Путь к шаблонам приложения
const VIEW_DIR = APP_DIR . 'view/';

require_once APP_DIR . '/helpers.php';

// Функция автоподгрузки файлов с классами
spl_autoload_register(function($class) {
    // Префикс пространства имён
    $prefix = 'App\\';
    // Базовый каталог для префикса пространства имён
    $baseDir = APP_DIR . 'src/';
    // Длина строки префикса
    $len = strlen($prefix);
    // Использует ли класс префикс пространства имён?
    if (strncmp($prefix, $class, $len) !== 0) {
        // Нет - переход к следующему зарегистрированному автоподгрузчику
        return;
    }
    // Относительное имя класса
    $relativeClass = substr($class, $len);
    // Итоговый путь к файлу
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    // Если такой файл существует
    if (file_exists($file)) {
        // Подключение файла
        require_once $file;
    }
});
