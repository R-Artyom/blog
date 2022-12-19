<?php

namespace App\Controllers;

use App\Models\User;
use App\Profile;
use App\View\View;
use Exception;

class AdminUserController extends FormController
{
    // Страница "Управление пользователями"
    public function adminUsers(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Запрос всех пользователей.
        // Сортировка пользователей по уровню доступа к сайту, начиная от админа.
        // Сортировка пользователей по дате регистрации, сначала старые.
        $result['users'] = User::orderBy('role_id', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();
        // Заголовок страницы
        $result['title'] = 'Управление пользователями';
        // Возврат объекта - шаблона страницы "Управление пользователями"
        return new View('admin_users', $result);
    }

    // Валидация формы
    protected function validateForm(array $data)
    {

    }

    // Сохранение данных
    protected function saveData(array $data)
    {
        // Если это профиль администратора
        if ($data['idUser'] === Profile::getInstance()->get('role_id')) {
            throw new Exception('Внимание!!! Администраторам запрещено менять свой статус', FORM_SUCCESS);
        }
        // Обновление данных в базе
        User::where('id', $data['idUser'])
            ->update(['role_id' => $data['roleId']]);
        throw new Exception('Статус пользователя изменён', FORM_SUCCESS);
    }
}