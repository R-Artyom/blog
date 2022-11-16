<?php

namespace App\Controllers;

// Импорт необходимого класса
use App\Exception\NotFoundException;
use App\Models\Comment;
use App\Models\Post;
use App\View\View;

class StaticPageController
{
    // Страница "О нас"
    public function about(): View
    {
        // Возврат объекта - шаблона страницы "О нас"
        return new View('about', ['title' => 'Страница о нас']);
    }

    // Страница "Детальная страница статьи"
    public function posts($idPost): View
    {
        // TODO - идентификатор зарегистрированного пользователя
        $user_id = 1;
        // Сообщение, в случае добавления комментария
        $message = $this->addComment();
        // Массив объектов таблицы posts модели Post
        $post = Post::where('id', $idPost)->get();
        // Если в БД не найдено ни одной статьи с указанным id
        if (count($post) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Запрос комментариев пользователей к статье с идентификатором id
        // из таблицы users берутся имя пользователя и название файла-аватарки
        // сортировка комментариев по дате, сначала новые
        $comments = Comment:: where([['post_id', $idPost], ['active', true]])
            ->orWhere([['post_id', $idPost], ['user_id', $user_id], ['active', false]])
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.name as user_name', 'users.img_name')
            ->orderBy('created_at', 'desc')
            ->get();
        // Возврат объекта - шаблона страницы "Детальная страница статьи"
        return new View('posts', ['title' => 'Статьи', 'post' => $post[0], 'comments' => $comments, 'message' => $message]);
    }

    // Страница "Тест"
    public function test($param1, $param2): string
    {
        return "Test Page With param1=$param1 param2=$param2";
    }

    // Страница "Авторизация"
    public function authorization(): View
    {
        // Возврат объекта - шаблона страницы "Авторизация"
        return new View('authorization', ['title' => 'Авторизация']);
    }

    // Страница "Регистрация"
    public function registration(): View
    {
        // Возврат объекта - шаблона страницы "Регистрация"
        return new View('registration', ['title' => 'Регистрация']);
    }

    // Страница "Правила пользования сайтом"
    public function terms(): View
    {
        // Возврат объекта - шаблона страницы "Правила пользования сайтом"
        return new View('terms', ['title' => 'Правила пользования сайтом']);
    }

    // Добавление комментария на странице "Детальная страница статьи"
    private function addComment()
    {
        // Если комментарий был отправлен
        if (!empty($_POST))
        {
//            // TODO - если это незарегистрированный пользователь
//            if ($user['status'] === 'unregistered') {
//                $message['status'] = 'warning';
//                $message['text'] = 'Внимание!!! Отправлять комментарии могут только зарегистрированные пользователи. <a class="link-style-1" href="/registration">Зарегистрироваться?</a>';
//                return $message;
//            }
            // Если поле 'text' заполнено
            if (!empty($_POST['text'])) {
                Comment::insert([
                    'text' => $_POST['text'],
                    'post_id' => $_POST['post-id'],
                    'user_id' => 1,
                ]);
                $message['status'] = 'success';
                $message['text'] = 'Комментарий успешно отправлен';
                return $message;
            }
            // Если поле 'text' не заполнено
            $message['status'] = 'warning';
            $message['text'] = 'Внимание!!! Комментарий не может быть пустым';
            return $message;
        }
        return '';
    }
}
