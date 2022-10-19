<?php
namespace App\Controllers;

// Импорт необходимого класса
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

    // Страница "Статьи"
    public function posts(): View
    {
        // Массив объектов таблицы posts модели Post
        $posts = Post::get();
        // Возврат объекта - шаблона страницы "Статьи"
        return new View('posts', ['title' => 'Статьи', 'posts' => $posts]);
    }

    // Страница "Тест"
    public function test($param1, $param2): string
    {
        return "Test Page With param1=$param1 param2=$param2";
    }
}
