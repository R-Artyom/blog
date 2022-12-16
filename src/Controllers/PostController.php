<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Exception\NotFoundException;
use App\Models\Comment;
use App\Models\Post;
use App\Profile;
use App\View\View;
use Exception;

class PostController extends FormController
{
    // Страница "Детальная страница статьи"
    public function posts($idPost): View
    {
        // Данные пользователя
        $result['user'] = Profile::getInstance()->getAll();
        // Проверка формы "Добавление комментария"
        $result['form'] = $this->checkForm();
        // Массив объектов таблицы posts модели Post
        $post = Post::where('id', $idPost)->get();
        // Если в БД не найдено ни одной статьи с указанным id
        if (count($post) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Если это незарегистрированный пользователь
        if (Profile::getInstance()->isUnregUser()) {
            // Запрос комментариев пользователей к статье с идентификатором id.
            // Только отмодерированные комментарии любого пользователя.
            // Из таблицы users берутся имя пользователя, дата регистрации и название файла-аватарки.
            // Сортировка комментариев по дате, сначала новые.
            $result['comments'] = Comment:: where([['post_id', $idPost], ['active', true]])
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.name as user_name', 'users.created_at as user_created_at', 'users.img_name')
                ->orderBy('created_at', 'desc')
                ->get();
        // Если это зарегистрированный пользователь
        } else {
            // Запрос комментариев пользователей к статье с идентификатором id.
            // Отмодерированные комментарии любого пользователя + неотмодерированные текущего пользователя.
            // Из таблицы users берутся имя пользователя, дата регистрации и название файла-аватарки.
            // Сортировка комментариев по дате, сначала новые.
            $result['comments'] = Comment:: where([['post_id', $idPost], ['active', true]])
                ->orWhere([['post_id', $idPost], ['user_id', $result['user']['id']], ['active', false]])
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.name as user_name', 'users.created_at as user_created_at', 'users.img_name')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // Статья
        $result['post'] = $post[0];
        // Заголовок страницы
        $result['title'] = 'Статьи';
        // Возврат объекта - шаблона страницы "Детальная страница статьи"
        return new View('posts', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
    {
        // Если это незарегистрированный пользователь
        if (Profile::getInstance()->isUnregUser()) {
            throw new Exception(
                'Внимание!!! Отправлять комментарии могут только зарегистрированные пользователи.
                    <a class="link-style-1" href="/authorization">Войдите</a>
                    или <a class="link-style-1" href="/registration">зарегистрируйтесь</a>,
                    чтобы у вас появилась такая возможность.',
                FORM_TEXT
            );
        }
        // Если поле 'Text' не заполнено
        if (!(isset($data['text']) && $data['text'] !== '')) {
            throw new Exception('Внимание!!! Комментарий не может быть пустым', FORM_TEXT);
        }
    }

    // Сохранение данных пользователя в базе
    protected function saveData(array $data)
    {
        Comment::insert([
            'text' => $data['text'],
            'post_id' => $data['post-id'],
            'user_id' => $data['user-id'],
            // Для модераторов и администраторов комментарий не требует проверки
            'active' => $data['active'],
        ]);
        throw new Exception('Комментарий успешно отправлен!', FORM_SUCCESS);
    }
}
