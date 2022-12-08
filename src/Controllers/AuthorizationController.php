<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Models\User;
use App\Session;
use App\View\View;
use Exception;

class AuthorizationController extends FormController
{
    // Страница "Авторизация"
    public function authorization(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Если форма не отправлялась и существует куки 'login'
        if ($result['form']['error'] === FORM_NOT_SENT && isset($_COOKIE['login'])) {
            // Автозаполнение поля 'email'
            $result['form']['email'] = htmlspecialchars($_COOKIE['login']);
        }
        // Заголовок страницы
        $result['title'] = 'Авторизация';
        // Возврат объекта - шаблона страницы "Авторизация"
        return new View('authorization', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
    {
        // Если поле 'Email' не заполнено
        if (!(isset($data['email']) && $data['email'] !== '')) {
            throw new Exception('Введите email', FORM_EMAIL);
        }
        // Если поле 'Email' не соответствует формату
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            throw new Exception('Email не соответствует формату', FORM_EMAIL);
        }
        // Если поле 'Пароль' не заполнено
        if (!(isset($data['password']) && $data['password'] !== '')) {
            throw new Exception('Введите пароль', FORM_PASSWORD);
        }
        // Поиск пользователя в базе данных
        $user = User::where('email', $data['email'])->get();
        // Если в БД нет пользователя с таким email
        if (count($user) < 1) {
            throw new Exception('Неправильный email или пароль', FORM_PASSWORD);
        }
        // Если пароль неверный
        if (!password_verify($data['password'], $user[0]['password'])) {
            throw new Exception('Неправильный email или пароль', FORM_PASSWORD);
        }
    }
    // Работа с сессией
    protected function saveData(array $data)
    {
        // Создание экземпляра сессии
        $session = new Session();
        // Старт сессии
        $session->start($data['email']);
        // Сообщение
        throw new Exception('Поздравляем! Вы успешно авторизировались!', FORM_SUCCESS);
    }

    // Страница "Разавторизация"
    public function logOut()
    {
        // Создание экземпляра сессии
        $session = new Session();
        // Остановить сессию
        $session->stop();
    }
}
