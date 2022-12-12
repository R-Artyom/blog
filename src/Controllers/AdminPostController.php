<?php

namespace App\Controllers;

use App\Exception\NotFoundException;
use App\Models\Post;
use App\View\View;
use Exception;

class AdminPostController extends FormController
{
    // Страница "Управление статьями"
    public function adminPost(): View
    {
        // Массив объектов таблицы posts модели Post, отсортированный по убыванию даты создания
        $result['posts'] = Post::orderBy('created_at', 'desc')->get();
        // Заголовок страницы
        $result['title'] = 'Управление статьями';
        // Возврат объекта - шаблона страницы "Управление статьями"
        return new View('admin_posts', $result);
    }

    // Страница "Редактирование статьи"
    public function adminPostEdit($idPost): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Массив объектов таблицы posts модели Post
        $post = Post::where('id', $idPost)->get();
        // Если в БД не найдено ни одной статьи с указанным id
        if (count($post) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Заголовок страницы
        $result['title'] = 'Редактирование статьи';
        // Статья
        $result['post'] = $post[0];
        // Если форма не отправлялась, то некоторые поля надо заполнить сразу
        if ($result['form']['error'] === FORM_NOT_SENT) {
            $result['form']['title'] = $result['post']->title;
            $result['form']['shortText'] = $result['post']->short_text;
            $result['form']['text'] = $result['post']->text;
        }
        // Возврат объекта - шаблона страницы "Редактирование статьи"
        return new View('admin_post_edit', $result);
    }

    // Страница "Добавление новой статьи"
    public function adminPostAdd(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Добавление новой статьи';
        // Возврат объекта - шаблона страницы "Редактирование статьи"
        return new View('admin_post_edit', $result);
    }

    // Страница "Удаление статьи"
    public function adminPostDelete($idPost): View
    {
        // Массив объектов таблицы posts модели Post
        $post = Post::where('id', $idPost)->get();
        // Если в БД не найдено ни одной статьи с указанным id
        if (count($post) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Заголовок страницы
        $result['title'] = 'Удаление статьи';
        // Статья
        $result['post'] = $post[0];
        // Возврат объекта - шаблона страницы "Редактирование статьи"
        return new View('admin_post_edit', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
    {
        // Если это не страница удаления статьи
        if (!isset($data['delete'])) {
            // Если поле 'Заголовок' не заполнено
            if (!(isset($data['title']) && $data['title'] !== '')) {
                throw new Exception('Введите заголовок статьи', FORM_TITLE);
            }
            // Если поле 'Краткое описание статьи' не заполнено
            if (!(isset($data['shortText']) && $data['shortText'] !== '')) {
                throw new Exception('Введите краткое описание статьи', FORM_SHORT_TEXT);
            }
            // Если поле 'Текст' не заполнено
            if (!(isset($data['text']) && $data['text'] !== '')) {
                throw new Exception('Введите текст статьи', FORM_TEXT);
            }
            // Если причина ошибки - слишком большой размер файла
            if ($_FILES['imgName']['error'] === UPLOAD_ERR_FORM_SIZE) {
                throw new Exception("Файл \"{$_FILES['imgName']['name']}\" не загружен!!! Размер файла не должен превышать 2 Мб.", FORM_IMAGE);
            }
            // Если тип файла не найден в списке разрешенных и если это не удаление статьи
            if (($_FILES['imgName']['tmp_name'] !== '')
                && !in_array (mime_content_type($_FILES['imgName']['tmp_name']), ALLOWED_IMG_TYPE, true)) {
                // Вывести сообщение и прекратить выполнение текущего скрипта
                throw new Exception("Файл \"{$_FILES['imgName']['name']}\" не загружен!!! Тип файла не поддерживается.", FORM_IMAGE);
            }
            // Если "Изображение к статье" не загружено и это страница добавления новой статьи
            if (($_FILES['imgName']['tmp_name'] === '') && !isset($data['idPost'])) {
                throw new Exception('Загрузите изображение к статье', FORM_IMAGE);
            }
        }
    }

    // Сохранение данных
    protected function saveData(array $data)
    {
        // Если это удаление статьи
        if (isset($data['delete'])) {
            // Получить данные статьи
            $post = Post::where('id', $data['idPost'])->get();
            // Если в БД есть такая запись
            if (count($post) > 0) {
                // Удалить файл изображения на сервере
                $imgPath = $_SERVER['DOCUMENT_ROOT'] . PATH_IMG_POSTS;
                // Список файлов и каталогов, расположенных в директории изображений к статьям
                $files = scandir($imgPath);
                $a = $post[0]->img_name;
                // Если в папке есть файл, который необходимо удалить (без этой проверки
                // нельзя удалять файл, т.к. в случае отсутствия файла сработает "Warning")
                if (in_array($post[0]->img_name, $files, true)) {
                    // Удаление файла изображения из папки
                    unlink($imgPath . '/' . $post[0]->img_name);
                }
                // Удалить запись из БД
                Post::where('id', $data['idPost'])->delete();
            }
            throw new Exception('Статья успешно удалена!', FORM_SUCCESS);
        }
        // Если это редактирование статьи
        if (isset($data['idPost'])) {
            // Загрузить изображение на сервер
            $newNamePhoto = uploadFile($_FILES['imgName'],PATH_IMG_POSTS, $data['idPost']);
            // Обновление данных в базе
            Post::where('id', $data['idPost'])
                ->update([
                    'title' => $data['title'],
                    'short_text' => $data['shortText'],
                    'text' => $data['text'],
                    'img_name' => $newNamePhoto ?? $data['imgName'],
                ]);
            throw new Exception('Статья успешно отредактирована!', FORM_SUCCESS);
        }
        // Если это добавление новой статьи
        // Создать новую запись в таблице (без названия файла изображения)
        Post::insert([
            'title' => $data['title'],
            'short_text' => $data['shortText'],
            'text' => $data['text'],
        ]);
        // Прочитать последнюю запись
        $post = Post::orderBy('created_at', 'desc')->take(1)->get();
        // Загрузить изображение на сервер
        $newNamePhoto = uploadFile($_FILES['imgName'], PATH_IMG_POSTS, $post[0]->id);
        // Обновить название файла изображения в базе
        Post::where('id', $post[0]->id)
            ->update([
                'img_name' => $newNamePhoto,
            ]);
        throw new Exception('Статья успешно опубликована!', FORM_SUCCESS);
    }
}