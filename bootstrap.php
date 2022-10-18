<?php

// Корень проекта
const APP_DIR = __DIR__ . '/';
// Путь к шаблонам приложения
const VIEW_DIR = APP_DIR . 'view/';
// Путь к файлам конфигурации приложения
const CONFIGS_DIR = APP_DIR . 'configs/';
// Вспомогательные функции
require_once APP_DIR . '/helpers.php';
// Функция автоподгрузки файлов с классами
require_once APP_DIR . '/vendor/autoload.php';
