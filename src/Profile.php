<?php

namespace App;

// Импорт классов
use App\Models\User;

// Класс "Профиль пользователя" (Порождающий шаблон проектирования Singleton)
class Profile
{
    // Переменная для хранения единственного экземпляра данного класса
    private static $instance;
    // Данные профиля пользователя в виде объекта или null
    private $user;
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
    public static function getInstance(): Profile
    {
        // Если экземпляр еще не создан
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    // Загрузка профиля из базы
    private function load()
    {
        // Если пользователь авторизован
        if (isset($_SESSION['login'])) {
            // Поиск пользователя в базе данных
            $result = User::where('email', $_SESSION['login'])->get();
            // Сохранение данных пользователя в свойстве класса
            $this->user = $result[0];
        }
    }

    /**
     * Запрос данных пользователя без обращения к базе данных
     * @param string $param - название столбца таблицы "users"
     */
    public function get(string $param)
    {
        // Для незарегистрированных пользователей вернётся null
        // Для зарегистрированных - значение ячейки строки "user"
        return is_object($this->user) ? $this->user->$param : null;
    }
}
