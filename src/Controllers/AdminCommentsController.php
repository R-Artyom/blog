<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Paginator;
use App\View\View;
use Exception;

class AdminCommentsController extends FormController
{
    // Страница "Управление комментариями"
    public function adminComments(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Создание экземпляра "Пагинатор"
        $result['paginator'] = (new Paginator(Comment::count(), PAGINATION_BUTTONS))->run();
        // Запрос всех комментариев пользователей.
        // Из таблицы users берутся имя пользователя, дата регистрации и название файла-аватарки.
        // Сортировка комментариев по признаку активности, сначала неодобренные.
        // Сортировка комментариев по дате, сначала новые.
        // смещение до первого элемента необходимой страницы
        // ограничение по количеству записей на одной странице
        $result['comments'] = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.name as user_name', 'users.created_at as user_created_at', 'users.img_name')
            ->orderBy('active', 'asc')
            ->orderBy('created_at', 'desc')
            ->offset($result['paginator']['offset'])
            ->limit($result['paginator']['limit'])
            ->get();
        // Заголовок страницы
        $result['title'] = 'Управление комментариями';
        // Возврат объекта - шаблона страницы "Управление комментариями"
        return new View('admin_comments', $result);
    }

    // Валидация полей формы
    protected function validateForm(array $data)
    {
        // TODO: Implement validateForm() method.
    }

    // Сохранение данных
    protected function saveData(array $data)
    {
        // Если это удаление комментария
        if (isset($data['delete'])) {
            // Получить данные комментария
            $comment = Comment::where('id', $data['idComment'])->get();
            // Если в БД есть такая запись
            if (count($comment) > 0) {
                // Удалить запись из БД
                Comment::where('id', $data['idComment'])->delete();
            }
            throw new Exception('Комментарий успешно удален!', FORM_SUCCESS);
        }
        // Если это одобрение комментария
        if (isset($data['approve'])) {
            // Обновление данных в базе
            Comment::where('id', $data['idComment'])
                ->update(['active' => $data['approve'] === 'yes' ? YES : NO]);
            throw new Exception($data['approve'] === 'yes' ? 'Комментарий одобрен!' : 'Комментарий отклонен!', FORM_SUCCESS);
        }
    }
}
