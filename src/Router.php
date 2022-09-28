<?php
namespace App;

class Router
{
    /** @var array|Route[]  */
    private array $routes = [];

    public function get(string $path, array $callback)
    {
        $this->addRoute('get', $path, $callback);
    }
    
    public function post(string $path, array $callback)
    {
        // @todo: Реализуйте этот метод    
    }
    
    private function addRoute(string $method, string $path, array $callback)
    {
        $this->routes[] = new Route($method, $path, $callback);
    }

    public function dispatch(string $url, string $method)
    {
        $uri = trim($url, '/');
        // @todo: Преобразуйте значение параметра $method к нижнему регистру

        foreach ($this->routes as $route) {
            if ($route->match($uri, $method)) {
                return $route->run();
            }
        }

        return 'page not found';
    }
}
