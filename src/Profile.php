<?php

namespace App;

// Импорт классов
use App\Models\Subscriber;
use App\Models\User;

// Класс "Профиль пользователя" (Порождающий шаблон проектирования Singleton)
class Profile
{
    // Переменная для хранения единственного экземпляра данного класса
    private static $instance;
    // Данные профиля пользователя в виде массива
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
            // Данные пользователя в виде массива
            $this->user = $result->toArray()[0];
            // Признак подписчика
            $this->user['isSubscriber'] = count(Subscriber::where('email', $_SESSION['login'])->get()) > 0 ? YES : NO;
        }
    }

    /**
     * Запрос данных пользователя без обращения к базе данных
     * @param string $param - ключ массива профиля пользователя
     */
    public function get(string $param)
    {
        // Для незарегистрированных пользователей вернётся null
        // Для зарегистрированных - значение элемента массива
        return $this->user[$param] ?? null;
    }

    /**
     * Запрос всех данных пользователя
     */
    public function getAll()
    {
        // Для незарегистрированных пользователей вернётся null
        // Для зарегистрированных - массив строки "user"
        return $this->user;
    }

    /**
     * Признак незарегистрированного пользователя
     */
    public function isUnregUser(): bool
    {
        return $this->user === null;
    }
}
