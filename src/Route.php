<?php
namespace App;

use Closure;

class Route
{
    private string $method;
    private string $path;
    private Closure $callback;

    public function __construct(string $method, string $path, array $callback)
    {
        $this->method   = $method;
        $this->path     = $path;
        $this->callback = $this->prepareCallback($callback);
    }

    private function prepareCallback(array $callback): Closure
    {
        return function (...$params) use ($callback) {
            list($class, $method) = $callback;
            return (new $class)->{$method}(...$params);
        };
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function match(string $uri, string $method): bool
    {
        // @todo: добавьте сюда еще проверку http-метода запроса, на совпадение с http-методом текущего маршрута
        return trim($this->getPath(), '/') === $uri;
    }

    public function run()
    {
        return call_user_func_array($this->callback, []);
    }
}
