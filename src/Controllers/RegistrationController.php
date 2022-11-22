<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Models\User;
use App\View\View;

class RegistrationController
{
    // Страница "Регистрация"
    public function registration(): View
    {
        // Сообщение о результате добавления пользователя в БД путём регистрации
        $message = $this->addUser();
        // Заголовок страницы
        $message['title'] = 'Регистрация';
        // Возврат объекта - шаблона страницы "Регистрация"
        return new View('registration', $message);
    }

    // Добавление комментария на странице "Детальная страница статьи"
    private function addUser()
    {
        // Если форма регистрации была отправлена
        if (!empty($_POST))
        {
            // Если поле 'Имя' не заполнено
            if (empty($_POST['name'])) {
                $message['errors']['name'] = true;
            } else {
                $message['name'] = $_POST['name'];
            }
            // Если поле 'Email' не заполнено
            if (empty($_POST['email'])) {
                $message['errors']['email'] = 'Введите корректный email';
            } else {
                $message['email'] = $_POST['email'];
            }
            // Если поле 'Пароль' не заполнено
            if (empty($_POST['password'])) {
                $message['errors']['password'] = true;
            } else {
                $message['password'] = $_POST['password'];
                // Если поле 'Подтвердите пароль' не заполнено
                if (empty($_POST['repeat-password'])) {
                    $message['errors']['repeatPassword'] = 'Подтвердите пароль';
                // Если поля 'Пароль' и 'Подтвердите пароль' равны
                } elseif ($_POST['password'] !== $_POST['repeat-password']) {
                    $message['errors']['repeatPassword'] = 'Пароли не совпадают';
                    $message['repeatPassword'] = $_POST['repeat-password'];
                } else {
                    $message['repeatPassword'] = $_POST['repeat-password'];
                }
            }
            // Если чекбокс 'Правила сайта' не установлен
            if (empty($_POST['terms'])) {
                $message['errors']['terms'] = true;
            } else {
                $message['terms'] = $_POST['terms'];
            }
            // Если при заполнении формы регистрации ошибок не было
            if (!isset($message['errors'])) {
                // Проверка уникальности email
                $post = User::where('email', $_POST['email'])->get();
                // Если в БД не найдено ни одного юзера с таким email
                if (count($post) < 1) {
                    // Запись в БД
                    User::insert([
                        'name' => $_POST['name'],
                        'email' => $_POST['email'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'img_name' => 'default.jpg',
                    ]);
                    $message['success'] = 'Поздравляем! Вы успешно зарегистрировались!';
                } else {
                    $message['errors']['email'] = 'Пользователь с таким email уже существует. <a class="text-danger" href="/authorization/">Войти?</a>';
                    $message['email'] = $_POST['email'];
                }
            }
            // Если при заполнении формы регистрации были ошибки
            return $message;
        }
        // Если форма регистрации не отправлялась
        $message['errors']['empty'] = true;
        return $message;
    }
}
