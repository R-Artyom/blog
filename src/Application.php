<?php
namespace App;

// Класс "Приложение"
class Application
{
    // Свойство "Роутер"
    private Router $router;

    // Инициализация свойства класса
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    // Запуск выполнения приложения с указанием URL текущей страницы и метода запроса
    public function run(string $url, string $method)
    {
        // Отображение результата работы метода dispatch() маршрутизатора
        echo $this->router->dispatch($url, $method);
    }
}
