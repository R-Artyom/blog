<?php
namespace App;

// Импорт классов
use App\Exception\ApplicationException;
use App\View\Renderable;
use App\View\View;

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
        try {
            // Отображение результата работы метода dispatch() маршрутизатора
            $result = $this->router->dispatch($url, $method);
            // Если $result - объект, реализующий интерфейс Renderable
            if ($result instanceof Renderable) {
                // Вызов метода для отображения
                $result->render();
            } else {
                // Отображение результата
                echo $result;
            }
        } catch (ApplicationException $e) {
            $this->renderException($e);
        }

    }

    private function renderException(ApplicationException $e)
    {
        // Если объект-исключение $e реализует интерфейс Renderable
        if ($e instanceof Renderable) {
            // Вызов метода для отображения
            $e->render();
        // В остальных случаях
        } else {
            // Установить HTTP-статус ответа страницы
            if ($e->getCode() === 0) {
                http_response_code(500);
            } else {
                http_response_code($e->getCode());
            }
            // Созание объекта-шаблона страницы с ошибкой
            $error = new View('errors/error', ['title' => $e->getMessage()]);
            // Отображение шаблона данной страницы
            $error->render();
        }
    }
}
