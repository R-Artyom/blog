<?php
namespace App\Controllers;

// Импорт необходимого класса
use App\View\View;

class HomeController
{
    public function index(): View
    {
        // Возврат объекта - шаблона главной страницы
        return new View('homepage', ['title' => 'Главная страница']);
    }
}
