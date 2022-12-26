<?php
namespace App\Controllers;

// Импорт необходимого класса
use App\Models\Post;
use App\Models\Setting;
use App\Paginator;
use App\View\View;

class HomeController
{
    public function index(): View
    {
        // Запрос количества элементов на главной странице сайта
        $home_elements_per_page = Setting::where('name', 'home_elements_per_page')->get()[0]->value;
        // Создание экземпляра "Пагинатор"
        $result['paginator'] = (new Paginator(Post::count(), PAGINATION_BUTTONS, ['default' => $home_elements_per_page]))->run();
        // Запрос статей сайта:
        // сортировка по убыванию даты создания,
        // смещение до первого элемента необходимой страницы,
        // ограничение по количеству записей на одной странице.
        $result['posts'] = Post::orderBy('created_at', 'desc')
            ->offset($result['paginator']['offset'])
            ->limit($result['paginator']['limit'])
            ->get();
        // Заголовок страницы
        $result['title'] = 'Главная страница';
        // Возврат объекта - шаблона страницы "Главная страница"
        return new View('homepage', $result);
    }
}
