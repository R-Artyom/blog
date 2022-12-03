<?php
namespace App\View;

// Импорт классов
use App\Exception\ApplicationException;
use App\Exception\NotFoundException;
use App\Profile;

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
        // Проверка наличия файла шаблона, если такого нет - то выброс исключения
        // и выход из метода в точку перехвата
        $this->getIncludeTemplate($this->view);
        // Импорт ключей массива в качестве имён переменных, а их значений -
        // в качестве значений этих переменных
        extract($this->data);
        // Данные о пользователе
        // TODO Вместо запроса одного параметра надо запрашивать массив и делать extract
        $userName = Profile::getInstance()->get('name');
        $imgName = Profile::getInstance()->get('img_name');
        $userStatus = Profile::getInstance()->get('role_id') ?? UNREG;
        // Если это страница с информацией об успешной отправке формы
        if (isset($form['error']) && ($form['error'] !== FORM_SUCCESS)) {
            // Проверка прав доступа пользователя к странице сайта
            if (($userStatus & ACCESS_TO_PAGE[$this->view]) === 0) {
                // Такой страницы не существует
                throw new NotFoundException('Страница не найдена', 404);
            }
        }
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
        // Полный путь к файлу
        $pathTemplate = VIEW_DIR . $view . '.php';
        // Если такой файл существует
        if (file_exists($pathTemplate)) {
            // Возврат полного пути
            return VIEW_DIR . $view . '.php';
        } else {
            // Если такого файла нет - то выбрасывание исключения
            throw new ApplicationException("$view.php шаблон не найден");
        }
    }
}
