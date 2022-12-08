<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Models\User;
use App\Session;
use App\View\View;
use Exception;

class RegistrationController extends FormController
{
    // Страница "Регистрация"
    public function registration(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Регистрация';
        // Возврат объекта - шаблона страницы "Регистрация"
        return new View('registration', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
    {
        // Если поле 'Имя' не заполнено
        if (!(isset($data['name']) && $data['name'] !== '')) {
            throw new Exception('Введите имя', FORM_NAME);
        }
        // Если поле 'Email' не заполнено
        if (!(isset($data['email']) && $data['email'] !== '')) {
            throw new Exception('Введите email', FORM_EMAIL);
        }
        // Если поле 'Email' не соответствует формату
        if ( filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            throw new Exception('Email не соответствует формату', FORM_EMAIL);
        }
        // Если поле 'Пароль' не заполнено
        if (!(isset($data['password']) && $data['password'] !== '')) {
            throw new Exception('Введите пароль', FORM_PASSWORD);
        }
        // Если поле 'Повторите пароль' не заполнено
        if (!(isset($data['repeatPassword']) && $data['repeatPassword'] !== '')) {
            throw new Exception('Подтвердите пароль', FORM_REPEAT_PASSWORD);
        }
        // Если пароли не совпадают
        if ($data['password'] !== $data['repeatPassword']) {
            throw new Exception('Пароли не совпадают', FORM_REPEAT_PASSWORD);
        }
        // Если чекбокс 'Правила сайта' не установлен
        if (!(isset($data['terms']) && $data['terms'] !== '')) {
            throw new Exception('Необходимо согласиться с правилами сайта', FORM_TERMS);
        }
        // Если в БД уже есть пользователь с таким email
        if (count(User::where('email', $data['email'])->get()) > 0) {
            throw new Exception('Пользователь с таким email уже существует. <a class="text-danger" href="/authorization">Войти?</a>', FORM_EMAIL);
        }
    }

    // Сохранение данных пользователя в базе
    protected function saveData(array $data)
    {
        // Если в БД не найдено ни одного пользователя с таким email, сохранение данных
        User::insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'img_name' => 'default.jpg',
        ]);
        // Создание экземпляра сессии
        $session = new Session();
        // Старт сессии
        $session->start($data['email']);
        throw new Exception('Поздравляем! Вы успешно зарегистрировались!', FORM_SUCCESS);
    }
}
