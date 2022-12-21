<?php

namespace App\Controllers;

// Импорт необходимого класса
use App\Exception\NotFoundException;
use App\Models\Page;
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

    // Страница "Статичная"
    public function staticPages($idPage): View
    {
        // Поиск страницы с указанным id
        $page = Page::where('id', $idPage)->get();
        // Если в БД не найдено ни одной страницы
        if (count($page) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Страница
        $result['page'] = $page[0];
        // Заголовок страницы
        $result['title'] = $page[0]->title;
        // Возврат объекта - шаблона страницы "Статичная страница"
        return new View('pages', $result);
    }
}
