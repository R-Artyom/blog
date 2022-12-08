<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Models\Subscriber;
use App\View\View;
use Exception;

class SubscriptionController extends FormController
{
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
