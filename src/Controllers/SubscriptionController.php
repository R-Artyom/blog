<?php

namespace App\Controllers;

use App\Exception\ApplicationException;
use App\Models\Subscriber;
use App\View\View;
use Exception;
use RuntimeException;

class SubscriptionController
{
    // Страница "Оформление подписки"
    public function subscription(): View
    {;
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Оформление подписки';
        // Возврат объекта - шаблона страницы "Оформление подписки"
        return new View('subscription', $result);
    }

    // Проверка формы
    private function checkForm()
    {
        // Если форма была отправлена
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Копирование всех непустых данных формы
            foreach ($_POST as $key => $value) {
                if (isset($value) && $value !== '') {
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
                var_dump($e->getMessage());
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
        if (!(isset($data['email']) && $data['email'] !== '')) {
            throw new Exception('Для оформления подписки необходимо ввести email', FORM_EMAIL);
        }
        // Если поле 'Email' не соответствует формату
        if ( filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            throw new Exception('Email не соответствует формату', FORM_EMAIL);
        }
    }

    // Сохранение данных в базе
    private function saveData(array $data)
    {
        // Подписка
        if ($data['subscribe'] === 'yes') {
            // Если данный email еще не подписан на рассылку
            if (count(Subscriber::where('email', $data['email'])->get()) < 1) {
                Subscriber::insert(['email' => $data['email']]);
            }
            throw new Exception("Поздравляем! Почтовый адрес \"{$data['email']}\" подписан на получение уведомлений о появлении новой статьи на сайте!", FORM_SUCCESS);
        // Отписка
        } else {
            // Если данный email подписан на рассылку
            if (count(Subscriber::where('email', $data['email'])->get()) > 0) {
                Subscriber::where('email', $data['email'])->delete();
            }
            throw new Exception('Вы успешно отписались от рассылки!', FORM_SUCCESS);
        }
    }
}
