<?php
namespace App;

// Класс "Конфигурация приложения" (Порождающий шаблон проектирования Singleton)
final class Config
{
    // Переменная для хранение единственного экземпляра данного класса
    private static $instance;
    // Конфигурация приложения в виде многомерного ассоциативного массива
    private array $configurations = [];
    // Защита от создания через new Config
    private function __construct()
    {
        // Загрузка конфигурации при инициализации (один раз)
        $this->load();
    }
    // Защита от создания через клонирование
    private function __clone() {}
    // Защита от создания через unserialize
    private function __wakeup() {}

    // Запрос экземпляра класса (с созданием, в случае, если не создан)
    public static function getInstance(): Config
    {
        // Если экземпляр еще не создан
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    // Загрузка конфигурации
    private function load()
    {
        // Список файлов и каталогов, расположенных по указанному пути
        $files = scandir(CONFIGS_DIR);
        // Формирование массива конфиграции (первый ключ - название файла)
        foreach ($files as $key => $value) {
            // Если элемент массива - это файл, а не каталог
            if (is_file(CONFIGS_DIR . $value)) {
                // Загрузка массива из файла
                $this->configurations[pathinfo($value, PATHINFO_FILENAME)] = require CONFIGS_DIR . $value;
            }
        }
    }

    /**
     * Запрос конфигурации
     * @param string $config - ключ в виде строки, где каждый уровень вложенности отделён точкой
     * @param $default - значение элемента по умолчанию (если элемент не найден)
     */
    public function get(string $config, $default = null)
    {
        // Запрос через вспомогательную ф-цию
        return array_get($this->configurations, $config, $default);
    }
}
