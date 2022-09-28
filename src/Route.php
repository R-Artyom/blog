<?php
namespace App;

use Closure;

// Класс "Экземпляр маршрута". Хранит параметры маршрута, запускает выполнение текущего маршрута
class Route
{
    // HTTP-метод запроса
    private string $method;
    // URL-адрес маршрута
    private string $path;
    // Массив из двух значений - имя класса контроллера и имя метода, которые
    // нужно выполнить в качестве обработчика маршрута
    private Closure $callback;

    // Инициализация всех свойств класса
    public function __construct(string $method, string $path, array $callback)
    {
        $this->method   = $method;
        $this->path     = $path;
        $this->callback = $this->prepareCallback($callback);
    }

    // Преобразование параметра $callback в выполняемую функцию (чтобы потом
    // использовать её для выполнения маршрута)
    private function prepareCallback(array $callback): Closure
    {
        return function (...$params) use ($callback) {
            list($class, $method) = $callback;
            return (new $class)->{$method}(...$params);
        };
    }

    // Запрос текущего значения свойства $path
    public function getPath(): string
    {
        return $this->path;
    }

    // Проверка, подходит ли текущий маршрут текущему запросу
    public function match(string $uri, string $method): bool
    {
        // @todo: добавьте сюда еще проверку http-метода запроса, на совпадение с http-методом текущего маршрута
        return trim($this->getPath(), '/') === $uri && $this->method === $method;
    }

    // Запуск обработчика маршрута и возврат результата его работы
    public function run()
    {
        return call_user_func_array($this->callback, []);
    }
}
