<?php
namespace App\View;

// Класс "Шаблонизатор приложения" - используется для подключения view страницы
class View implements Renderable
{
    // Название шаблона, который необходимо подключить
    private string $view;
    // Данные для шаблона.
    private array $data;
    // Инициализация свойств
    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }
    // Отображение необходимого шаблона
    public function render()
    {
        // Импорт ключей массива в качестве имён переменных, а их значений -
        // в качестве значений этих переменных
        extract($this->data);
        // Шапка страницы
        require $this->getIncludeTemplate('layout.header');
        // Шаблон страницы
        require $this->getIncludeTemplate($this->view);
        // Подвал страницы
        require $this->getIncludeTemplate('layout.footer');
    }
    // Формирование абсолютного пути к файлу шаблона
    private function getIncludeTemplate($view)
    {
        // Замена в строке всех символов "точка" ('.') на символ "слеш" (DIRECTORY_SEPARATOR)
        // Константа содержит в себе слеш, не зависящий от операционной системы,
        // в которой выполняется приложение
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);
        // Возврат полного пути
        return VIEW_DIR . $view . '.php';
    }
}