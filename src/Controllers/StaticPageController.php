<?php
namespace App\Controllers;

// Импорт необходимого класса
use App\View\View;

class StaticPageController
{
    public function about()
    {
        // Возврат объекта - шаблона страницы "О нас"
        return new View('about', ['title' => 'Страница о нас']);
    }
}
