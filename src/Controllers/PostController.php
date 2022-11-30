<?php

namespace App\Controllers;

// Импорт необходимых классов
use App\Exception\NotFoundException;
use App\Models\Comment;
use App\Models\Post;
use App\Profile;
use App\View\View;

class PostController
{
    // Страница "Детальная страница статьи"
    public function posts($idPost): View
    {
        // Идентификатор пользователя
        $userId = Profile::getInstance()->get('id');
        // Сообщение, в случае добавления комментария
        $message = $this->addComment();
        // Массив объектов таблицы posts модели Post
        $post = Post::where('id', $idPost)->get();
        // Если в БД не найдено ни одной статьи с указанным id
        if (count($post) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Если это незарегистрированный пользователь
        if ($userId === null) {
            // Запрос комментариев пользователей к статье с идентификатором id.
            // Только отмодерированные комментарии любого пользователя.
            // Из таблицы users берутся имя пользователя, дата регистрации и название файла-аватарки.
            // Сортировка комментариев по дате, сначала новые.
            $comments = Comment:: where([['post_id', $idPost], ['active', true]])
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
            $comments = Comment:: where([['post_id', $idPost], ['active', true]])
                ->orWhere([['post_id', $idPost], ['user_id', $userId], ['active', false]])
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.name as user_name', 'users.created_at as user_created_at', 'users.img_name')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // Возврат объекта - шаблона страницы "Детальная страница статьи"
        return new View('posts', ['title' => 'Статьи', 'post' => $post[0], 'comments' => $comments, 'message' => $message]);
    }

    // Добавление комментария на странице "Детальная страница статьи"
    private function addComment()
    {
        // Если комментарий был отправлен
        if (!empty($_POST))
        {
            // Если это незарегистрированный пользователь
            if (Profile::getInstance()->get('id') === null) {
                $message['status'] = 'warning';
                $message['text'] =
                    'Внимание!!! Отправлять комментарии могут только зарегистрированные пользователи.
                    <a class="link-style-1" href="/authorization">Войдите</a>
                    или <a class="link-style-1" href="/registration">зарегистрируйтесь</a>,
                    чтобы у вас появилась такая возможность.';
                return $message;
            }
            // Если поле 'text' не заполнено
            if (empty($_POST['text'])) {
                $message['status'] = 'warning';
                $message['text'] = 'Внимание!!! Комментарий не может быть пустым';
                return $message;
            }
            // Если поле 'text' заполнено
            Comment::insert([
                'text' => $_POST['text'],
                'post_id' => $_POST['post-id'],
                'user_id' => Profile::getInstance()->get('id'),
                // Для модераторов и администраторов комментарий не требует проверки
                'active' => Profile::getInstance()->get('role_id') > USER ? COMMENT_ACTIVE : COMMENT_NO_ACTIVE,
            ]);
            $message['status'] = 'success';
            $message['text'] = 'Комментарий успешно отправлен';
            return $message;
        }
        return '';
    }
}
