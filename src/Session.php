<?php

namespace App;

// Класс "Сессия"
final class Session
{
    // Имя сессии сайта
    private $name;
    // Время жизни сессии
    private $timeOut;
    // Время жизни куки с логином
    private $timeOutLogin;

    // Инициализация свойств
    public function  __construct()
    {
        $this->name = Config::getInstance()->get('session.name');
        $this->timeOut = Config::getInstance()->get('session.timeOut');
        $this->timeOutLogin = Config::getInstance()->get('session.timeOutLogin');
    }

    // Запуск сессии
    public function start($login)
    {
        // Если сессия не запущена
        if (empty($_SESSION)) {
            // Установить имя сессии, отличающееся от имени по умолчанию
            session_name($this->name);
            // Старт сессии
            session_start();
        }
        // Фиксирование времени начала сессии
        $_SESSION['startTime'] = time();
        // Признак авторизации - логин пользователя
        $_SESSION['login'] = $login;
        // Создание куки с логином пользователя, длительностью месяц (31 день)
        setcookie('login', $login, time() + $this->timeOutLogin, '/');
    }

    // Продление сессии
    public function run()
    {
        // Если существует кука 'session_id', значит сессия была запущена ранее
        if (isset($_COOKIE[$this->name])) {
            // Установить имя сессии, как в куки, отличающееся от имени по умолчанию
            session_name($this->name);
            // Старт сессии (продление)
            session_start();
            // Флаг - отсутствуют данные о сессии
            $dataSessionError = (isset($_SESSION['startTime']) && isset($_SESSION['login'])) === false;
            // Флаг - время жизни сессии закончилось
            // Если время жизни сессии еще не закончилось, то переменная инициализируется значением false, иначе - true
            $sessionTimeOut = (($_SESSION['startTime'] + $this->timeOut) > time()) === false;
            // Если отсутствуют данные о сессии или время жизни сессии уже закончилось
            if ($dataSessionError || $sessionTimeOut) {
                // То необходимо разавторизировать пользователя и завершить сессию
                $this->stop();
            // Если такой пользователь существует и время жизни сессии не закончилось
            } else {
                // Обновление данных сессии
                $this->update();
            }
        }
    }

    // Остановка сессии
    public function stop()
    {
        // Удаление временного хранилища на сервере
        session_destroy();
        // Очистка массива $_SESSION
        unset($_SESSION['startTime']);
        unset($_SESSION['login']);
        // Удаление сессионного куки на сервере
        unset($_COOKIE[$this->name]);
        // Удаление сессионного куки в браузере
        setcookie($this->name, '', 1, '/');
        // Перенаправление на страницу авторизации
        header ('Location:' . PATH_AUTHORIZATION);
        // Прерывание выполнения скрипта
        exit();
    }

    // Обновление данных сессии
    private function update()
    {
        // Обновление времени начала сессии
        $_SESSION['startTime'] = time();
        // Создание куки с логином пользователя, длительностью месяц (31 день)
        setcookie('login', $_SESSION['login'], time() + $this->timeOutLogin, '/');
    }
}
