<?php

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
