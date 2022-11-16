<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\View\View;

class AuthorizationController
{
    // Страница "Авторизация"
    public function authorization(): View
    {
        // Возврат объекта - шаблона страницы "Авторизация"
        return new View('authorization', ['title' => 'Авторизация']);
    }
}