<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\View\View;

class RegistrationController
{
    // Страница "Регистрация"
    public function registration(): View
    {
        // Возврат объекта - шаблона страницы "Регистрация"
        return new View('registration', ['title' => 'Регистрация']);
    }
}
