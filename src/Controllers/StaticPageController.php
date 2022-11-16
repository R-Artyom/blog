<?php

namespace App\Controllers;

// Импорт необходимого класса
use App\Exception\NotFoundException;
use App\Models\Comment;
use App\Models\Post;
use App\View\View;

class StaticPageController
{
    // Страница "О нас"
    public function about(): View
    {
        // Возврат объекта - шаблона страницы "О нас"
        return new View('about', ['title' => 'Страница о нас']);
    }

    // Страница "Тест"
    public function test($param1, $param2): string
    {
        return "Test Page With param1=$param1 param2=$param2";
    }

    // Страница "Правила пользования сайтом"
    public function terms(): View
    {
        // Возврат объекта - шаблона страницы "Правила пользования сайтом"
        return new View('terms', ['title' => 'Правила пользования сайтом']);
    }
}
