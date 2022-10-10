<?php
namespace App\Exception;

// Импорт классов
use App\View\Renderable;
use App\View\View;

// Класс исключения "Страница не найдена" (ошибка 404)
class NotFoundException extends HttpException implements Renderable
{
    // Отображение необходимого шаблона
    public function render()
    {
        // Установить HTTP-статус ответа в значение 404 и заголовок ответа: HTTP/1.0 404 Not Found
        header("HTTP/1.0 404 Not Found");
        // Созание объекта-шаблона страницы "ошибка 404"
        $error = new View('errors/errors', ['title' => 'Ошибка 404. Страница не найдена']);
        // Отображение шаблона данной страницы
        $error->render();
    }
}