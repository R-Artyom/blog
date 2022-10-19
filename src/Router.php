<?php
namespace App;

// Импорт классов
use App\Exception\NotFoundException;

// Класс "Маршрутизатор"
class Router
{
    /** @var array|Route[] - массив маршрутов */
    private array $routes = [];

    // Регистрация (добавление в массив) нового маршрута для HTTP-метода запроса GET
    public function get(string $path, array $callback)
    {
        $this->addRoute('get', $path, $callback);
    }

    // Регистрация (добавление в массив) нового маршрута для HTTP-метода запроса POST
    public function post(string $path, array $callback)
    {
        $this->addRoute('post', $path, $callback);
    }

    // Регистрация (добавление в массив) нового маршрута внутри маршрутизатора
    private function addRoute(string $method, string $path, array $callback)
    {
        $this->routes[] = new Route($method, $path, $callback);
    }

    // Поиск и запуск маршрута, совпадающего с указанными URL-адресом и методом
    public function dispatch(string $url, string $method)
    {
        // Удалить символ '/' из начала и конца URL-адреса
        $uri = trim($url, '/');
        // Преобразование значения параметра $method к нижнему регистру
        $method = strtolower($method);
        // Перебор всех маршрутов
        foreach ($this->routes as $route) {
            // Если маршрут совпадает с текущим запросом
            if ($route->match($uri, $method)) {
                // Запуск обработчика маршрута
                return $route->run($uri);
            }
        }
        // Если такой страницы не существует
        throw new NotFoundException('Страница не найдена', 404);
    }
}
