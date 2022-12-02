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
        // Удалить символ '/' из начала и конца URL-адреса и вернуть результат
        return trim($this->path, '/');
    }

    // Проверка, подходит ли текущий маршрут текущему запросу
    public function match(string $uri, string $method): bool
    {
        // Поиск в тексте $uri совпадения с шаблоном типа 'test/*/test2/*...', а также проверка HTTP - метода
        return preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $this->getPath()) . '$/', $uri) && $this->method === $method;
    }

    // Запуск обработчика маршрута и возврат результата его работы
    public function run(string $uri)
    {
        // Поиск в тексте $uri совпадения с шаблоном типа 'test/*/test2/*...' и запись всех совпадений в массив $matches
        preg_match('/^' . str_replace(['*', '/'], ['(\w+)', '\/'], $this->getPath()) . '$/', $uri, $matches);
        // Удаление первого элемента массива с результатами совпадений
        unset($matches[0]);
        // Вызов callback - функции
        return call_user_func_array($this->callback, $matches);
    }
}
