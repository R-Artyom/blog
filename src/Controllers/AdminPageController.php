<?php

namespace App\Controllers;

use App\Config;
use App\Exception\NotFoundException;
use App\Models\Page;
use App\Paginator;
use App\View\View;
use Exception;

class AdminPageController extends FormController
{
    // Страница "Управление статичными страницами"
    public function adminStatic(): View
    {
        // Создание экземпляра "Пагинатор"
        $result['paginator'] = (new Paginator(Page::count(), PAGINATION_BUTTONS))->run();
        // Массив объектов таблицы pages модели Page, отсортированный по убыванию даты создания
        // смещение до первого элемента необходимой страницы
        // ограничение по количеству записей на одной странице
        $result['pages'] = Page::orderBy('created_at', 'desc')
            ->offset($result['paginator']['offset'])
            ->limit($result['paginator']['limit'])
            ->get();
        // Заголовок страницы
        $result['title'] = 'Управление статичными страницами';
        // Возврат объекта - шаблона страницы "Управление статичными страницами"
        return new View('admin_pages', $result);
    }

    // Страница "Редактирование статичной страницы"
    public function adminStaticEdit($idPage): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Массив объектов
        $page = Page::where('id', $idPage)->get();
        // Если в БД не найдено ни одной статичной страницы с указанным id
        if (count($page) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Заголовок страницы
        $result['title'] = 'Редактирование статичной страницы';
        // Страница
        $result['page'] = $page[0];
        // Если форма не отправлялась, то некоторые поля надо заполнить сразу
        if ($result['form']['error'] === FORM_NOT_SENT) {
            $result['form']['title'] = $result['page']->title;
            $result['form']['text'] = $result['page']->text;
        }
        // Возврат объекта - шаблона страницы "Редактирование статичной страницы"
        return new View('admin_page_edit', $result);
    }

    // Страница "Добавление новой статичной страницы"
    public function adminStaticAdd(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Добавление новой статичной страницы';
        // Возврат объекта - шаблона страницы "Редактирование статичной страницы"
        return new View('admin_page_edit', $result);
    }

    // Страница "Удаление статичной страницы"
    public function adminStaticDelete($idPage): View
    {
        // Массив объектов
        $page = Page::where('id', $idPage)->get();
        // Если в БД не найдено ни одной статичной страницы с указанным id
        if (count($page) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Удаление статичной страницы';
        // Статья
        $result['page'] = $page[0];
        // Возврат объекта - шаблона страницы "Редактирование статичной страницы"
        return new View('admin_page_edit', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
    {
        // Если это не удаление статичной страницы
        if (!isset($data['delete'])) {
            // Если поле 'Заголовок' не заполнено
            if (!(isset($data['title']) && $data['title'] !== '')) {
                throw new Exception('Введите заголовок статичной страницы', FORM_TITLE);
            }
            // Если поле 'Текст' не заполнено
            if (!(isset($data['text']) && $data['text'] !== '')) {
                throw new Exception('Введите текст статичной страницы', FORM_TEXT);
            }
            // Если причина ошибки - слишком большой размер файла
            if ($_FILES['imgName']['error'] === UPLOAD_ERR_FORM_SIZE) {
                throw new Exception("Файл \"{$_FILES['imgName']['name']}\" не загружен!!! Размер файла не должен превышать 2 Мб.", FORM_IMAGE);
            }
            // Если тип файла не найден в списке разрешенных
            if (($_FILES['imgName']['tmp_name'] !== '')
                && !in_array (mime_content_type($_FILES['imgName']['tmp_name']), Config::getInstance()->get('image.allowedType'), true)) {
                // Вывести сообщение и прекратить выполнение текущего скрипта
                throw new Exception("Файл \"{$_FILES['imgName']['name']}\" не загружен!!! Тип файла не поддерживается.", FORM_IMAGE);
            }
            // Если "Изображение к странице" не загружено и это добавления новой страницы
            if (($_FILES['imgName']['tmp_name'] === '') && !isset($data['idPage'])) {
                throw new Exception('Загрузите изображение к статичной странице', FORM_IMAGE);
            }
        }
    }

    // Сохранение данных
    protected function saveData(array $data)
    {
        // Если это удаление страницы
        if (isset($data['delete'])) {
            // Получить данные страницы
            $page = Page::where('id', $data['idPage'])->get();
            // Если в БД есть такая запись
            if (count($page) > 0) {
                // Удалить файл изображения на сервере
                deleteFile(PATH_IMG_PAGES, $page[0]->img_name);
                // Удалить запись из БД
                Page::where('id', $data['idPage'])->delete();
            }
            throw new Exception('Статичная страница успешно удалена!', FORM_SUCCESS);
        }
        // Если это редактирование страницы
        if (isset($data['idPage'])) {
            // Получить данные страницы
            $page = Page::where('id', $data['idPage'])->get();
            // Загрузить изображение на сервер
            $newNamePhoto = uploadFile($_FILES['imgName'],PATH_IMG_PAGES, $data['idPage']);
            // Удалить старое изображение на сервере
            if (isset($newNamePhoto) && $page[0]->img_name !== 'default.jpg') {
                deleteFile(PATH_IMG_PAGES, $page[0]->img_name);
            }
            // Обновление данных в базе
            Page::where('id', $data['idPage'])
                ->update([
                    'title' => $data['title'],
                    'text' => $data['text'],
                    'img_name' => $newNamePhoto ?? $data['imgName'],
                ]);
            throw new Exception('Статичная страница успешно отредактирована!', FORM_SUCCESS);
        }
        // Если это добавление новой страницы
        // Создать новую запись в таблице (без названия файла изображения)
        Page::insert([
            'title' => $data['title'],
            'text' => $data['text'],
        ]);
        // Прочитать последнюю запись
        $page = Page::orderBy('created_at', 'desc')->take(1)->get();
        // Загрузить изображение на сервер
        $newNamePhoto = uploadFile($_FILES['imgName'], PATH_IMG_PAGES, $page[0]->id);
        // Обновить название файла изображения в базе
        Page::where('id', $page[0]->id)
            ->update(['img_name' => $newNamePhoto]);
        throw new Exception('Статичная страница успешно добавлена!', FORM_SUCCESS);
    }
}
