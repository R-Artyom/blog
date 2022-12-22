<?php

namespace App;

use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Support\Collection;

class Notification
{
    // Массив токенов подписчиков (ключ массива - email подписчика)
    private array $tokens;
    // Массив параметров статьи
    private array $post;

    // Задать свойства при создании экземпляра
    public function __construct(Collection $tokens, Collection $post)
    {
        $this->tokens = $tokens->toArray();
        $this->post = $post[0]->toArray();
    }

    // Формирование содержимого уведомления
    private function create($email, $count)
    {
        return [
            "----------------------------------Письмо № $count----------------------------------" . PHP_EOL,
            "Адресат: " . $email . PHP_EOL,
            "Дата отправки: " . date('d-m-Y H:i:s', time()) . PHP_EOL,
            "Заголовок письма: На сайте добавлена новая запись \"{$this->post['title']}\"" . PHP_EOL,
            "Содержимое письма: " . PHP_EOL,
            "Новая статья: \"{$this->post['title']}\"," . PHP_EOL,
            $this->post['short_text'] . PHP_EOL,
            "Читать: " . ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . PATH_POSTS . '/' . $this->post['id'] . PHP_EOL,
            "---" . PHP_EOL,
            "Отписаться от рассылки: " . ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . PATH_SUBSCRIPTION . '/' . "?token={$this->tokens[$email]}" . PHP_EOL,
            PHP_EOL,
        ];
    }

    // Отправка уведомления
    public function send()
    {
        // Если есть хотя бы один подписчик
        if (count($this->tokens) > 0) {
            // Формирование
            foreach ($this->tokens as $email => $token) {
                // Счётчик писем
                static $i = 1;
                // Результирующий массив
                static $result = [];
                // Создать содержимое уведомления
                $data = $this->create($email, $i);
                // Подсчет писем
                $i++;
                // Слияние (объединение) двух массивов
                $result = array_merge($result, $data);
            }
            // Запись элементов массива в файл (с предварительным объединением элементов в строку)
            file_put_contents(APP_DIR . PATH_LOGS_MAILS . '/' . time() . '_mails_log.txt', $result);
        }
    }
}
