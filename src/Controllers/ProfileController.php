<?php

namespace App\Controllers;

use App\Profile;
use App\View\View;

class ProfileController
{
    // Страница "Профиль пользователя"
    public function profile(): View
    {
        // Данные пользователя
        $result['user'] = Profile::getInstance()->getAll();
        // Заголовок страницы
        $result['title'] = 'Профиль пользователя';
        // Возврат объекта - шаблона страницы "Профиль пользователя"
        return new View('profile', $result);
    }
}