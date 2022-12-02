<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Exception\ApplicationException;
use App\Models\User;
use App\Session;
use App\View\View;
use Exception;
use RuntimeException;

class RegistrationController
{
    // Страница "Регистрация"
    public function registration(): View
    {
        // Регистрация пользователя, если требуется
        $result = $this->addUser();
        // Заголовок страницы
        $result['title'] = 'Регистрация';
        // Возврат объекта - шаблона страницы "Регистрация"
        return new View('registration', $result);
    }

    // Регистрация пользователя
    private function addUser()
    {
        // Если форма была отправлена
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Копирование всех непустых данных формы
            foreach ($_POST as $key => $value) {
                if (!empty($value)) {
                    $result[$key] = htmlspecialchars($value);
                }
            }
            try {
                // Валидация полей формы регистрации
                $this->validateForm($result);
                // Сохранение данных пользователя в базе
                $this->saveData($result);
            // Исключения ORM Eloquent (класс PDOException является наследником RuntimeException)
            } catch (RuntimeException $e) {
                // Вывод на страницу ошибки при работе с базой данных
                throw new ApplicationException("Ошибка базы данных");
            // Исключения формы регистрации
            } catch (Exception $e) {
                // Сообщение выброшенного исключения
                $result['message'] = $e->getMessage();
                // Код выброшенного исключения
                $result['error'] = $e->getCode();
            }
        // Если форма не отправлялась
        } else {
            $result['error'] = FORM_NOT_SENT;
        }
        return $result;
    }

    // Валидация полей формы
    private function validateForm(array $data)
    {
        // Если поле 'Имя' не заполнено
        if (empty($data['name'])) {
            throw new Exception('Введите имя', FORM_NAME);
        }
        // Если поле 'Email' не заполнено
        if (empty($data['email'])) {
            throw new Exception('Введите email', FORM_EMAIL);
        }
        // Если поле 'Email' не соответствует формату
        if ( filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            throw new Exception('Email не соответствует формату', FORM_EMAIL);
        }
        // Если поле 'Пароль' не заполнено
        if (empty($data['password'])) {
            throw new Exception('Введите пароль', FORM_PASSWORD);
        }
        // Если поле 'Повторите пароль' не заполнено
        if (empty($data['repeatPassword'])) {
            throw new Exception('Подтвердите пароль', FORM_REPEAT_PASSWORD);
        }
        // Если пароли не совпадают
        if ($data['password'] !== $data['repeatPassword']) {
            throw new Exception('Пароли не совпадают', FORM_REPEAT_PASSWORD);
        }
        // Если чекбокс 'Правила сайта' не установлен
        if (empty($data['terms'])) {
            throw new Exception('Необходимо согласиться с правилами сайта', FORM_TERMS);
        }
        // Если в БД уже есть пользователь с таким email
        if (count(User::where('email', $data['email'])->get()) > 0) {
            throw new Exception('Пользователь с таким email уже существует. <a class="text-danger" href="/authorization">Войти?</a>', FORM_EMAIL);
        }
    }

    // Сохранение данных пользователя в базе
    private function saveData(array $data)
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
