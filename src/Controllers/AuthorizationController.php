<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Exception\ApplicationException;
use App\Models\User;
use App\View\View;
use Exception;
use RuntimeException;

class AuthorizationController
{
    // Страница "Авторизация"
    public function authorization(): View
    {
        // Авторизация пользователя, если требуется
        $result = $this->authUser();
        // Заголовок страницы
        $result['title'] = 'Регистрация';
        // Возврат объекта - шаблона страницы "Авторизация"
        return new View('authorization', $result);
    }

    // Авторизация пользователя
    private function authUser()
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
                // Валидация полей формы авторизации
                $this->validateForm($result);
                // Работа с сессией
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
    private function saveData(array $data)
    {
        throw new Exception('Поздравляем! Вы успешно авторизировались!', FORM_SUCCESS);
    }
}
