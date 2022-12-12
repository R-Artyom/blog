<?php

/**
 * Функция "dump and die" (dd) - вывод на экран параметров и завершение выполнение скрипта
 */
function dd(...$params)
{
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
    die;
}

function dump(...$params)
{
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
}

/**
 * Функция получения из многомерного массива элемента по ключу в виде строки,
 * где каждый уровень вложенности отделён точкой
 * @param array $array - входной массив
 * @param string $key - ключ в виде строки, где каждый уровень вложенности отделён точкой
 * @param $default - значение элемента по умолчанию (если элемент не найден)
 */
function array_get(array $array, string $key, $default = null)
{
    // Начальное значение временного ключа массива
    $keyTmp = '';
    // Перебор всех символов строки
    for ($i = 0; $i < mb_strlen($key); $i++) {
        // Если дошло до символа "точка"
        if ($key[$i] === '.') {
            // Проверка существования ключа в массиве
            if (array_key_exists($keyTmp, $array)) {
                // Копирование элемента массива с данным ключом (сужение поиска)
                $array = $array[$keyTmp];
                // Обнуление временного ключа
                $keyTmp = '';
            // Если такого ключа не существует
            } else {
                // Значение по умолчанию
                return $default;
            }
        // Если до символа "точка" еще не дошло
        } else {
            // Формирование ключа
            $keyTmp = $keyTmp . $key[$i];
            // Если это конец строки
            if ($i == mb_strlen($key) - 1) {
                // Проверка существования ключа в массиве
                if (is_array($array) && array_key_exists($keyTmp, $array)) {
                    // Значения конечного элемента многомерного массива
                    return $array[$keyTmp];
                // Если такого ключа не существует
                } else {
                    // Значение по умолчанию
                    return $default;
                }
            }
        }
    }
    // Значение по умолчанию (для пустой строки)
    return $default;
}

/**
 * Функция определения активности текущей страницы
 * @param $path - ссылка на страницу, куда ведет пункт меню, которую необходимо проверить
 * @return bool возвращает результат проверки (true / false)
 */
function isCurrentUrl($path): bool
{
    // Возврат результата сравнения
    return $path === parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

/**
 * Функция загрузки файла на сервер
 * @param array $file - массив данных файла
 * @param string $path - ссылка на папку, куда загружать файл
 * @param string $name - новое название файла
 * @return string|null возвращает полное новое название файла, включая расширение
 */
function uploadFile(array $file, string $path, string $name): ?string
{
    // Если есть что загружать
    if ($file['tmp_name'] !== '') {
        // Определение номера позиции знака "точка" в названии зашружаемого файла
        while (true) {
            // Начальное смещение при поиске
            static $offset = 0;
            // Поиск первой точки в названии файла, начиная с $offset
            $positionPointTmp = mb_strpos($file['name'], '.', $offset);
            // Если ни одной точки больше не найдено
            if ($positionPointTmp === false) {
                break;
            } else {
                $positionPoint = $positionPointTmp;
                // Новое смещение для поиска следующей точки в названии
                $offset = $positionPoint + 1;
            }
        }
        // Определение расширение файла, зная позицию знака "точка"
        $filenameExtension = mb_substr($file['name'], $positionPoint);
        // Новое полное название файла
        $newNameFile = $name . $filenameExtension;
        // Загрузка файла в папку
        move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $path . '/' . $newNameFile);
    }
    // Новое название файла
    return $newNameFile ?? null;
}
