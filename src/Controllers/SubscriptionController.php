<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Exception\NotFoundException;
use App\Models\Subscriber;
use App\View\View;
use Exception;

class SubscriptionController extends FormController
{
    // Страница "Отписка по ссылке"
    public function unsubscriptionByLink(): View
    {
        // Если есть GET-параметры
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Конвертирование для безопасности
            foreach ($_GET as $key => $value) {
                if (isset($value) && $value !== '') {
                    $result[$key] = htmlspecialchars($value);
                }
            }
        }
        // Поиск подписчика
        $subscriber = Subscriber::where('token', $result['token'])->get();
        // Если данный email подписан на рассылку
        if (isset($result['token']) && count($subscriber) > 0) {
            // Удаление подписчика из таблицы
            Subscriber::where('token', $result['token'])->delete();
            // Сообщение без выброса исключения
            $result['form']['message'] = "Почтовый адрес \"{$subscriber[0]->email}\" успешно отписан от рассылки!";
            // Код
            $result['form']['error'] = FORM_SUCCESS;
        } else {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Заголовок страницы
        $result['title'] = 'Оформление отписки';
        // Возврат объекта - шаблона страницы "Оформление подписки"
        return new View('subscription', $result);
    }

    // Страница "Оформление подписки"
    public function subscription(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Оформление подписки';
        // Возврат объекта - шаблона страницы "Оформление подписки"
        return new View('subscription', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
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
    protected function saveData(array $data)
    {
        // Подписка
        if ($data['subscribe'] === 'yes') {
            // Если данный email еще не подписан на рассылку
            if (count(Subscriber::where('email', $data['email'])->get()) < 1) {
                Subscriber::insert([
                    'email' => $data['email'],
                    'token' => genToken($data['email'])
                ]);
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
