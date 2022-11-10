<?php
namespace App\Controllers;

// Импорт необходимого класса
use App\Models\Post;
use App\View\View;

class HomeController
{
    public function index(): View
    {
        // Массив объектов таблицы posts модели Post, отсортированный по убыванию даты создания
        $posts = Post::orderBy('created_at', 'desc')->get();
        // Возврат объекта - шаблона страницы "Главная"
        return new View('homepage', ['title' => 'Главная страница', 'posts' => $posts]);
    }
}
