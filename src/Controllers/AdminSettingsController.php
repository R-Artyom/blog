<?php

namespace App\Controllers;

use App\Exception\NotFoundException;
use App\Models\Setting;
use App\View\View;
use Exception;

class AdminSettingsController extends FormController
{

    // Страница "Редактирование статичной страницы"
    public function adminSettings(): View
    {
        // Проверка формы
        $result['form'] = $this->checkForm();
        // Массив объектов
        $settings = Setting::where('name', 'home_elements_per_page')->get();
        // Если в БД не найдено ни одной настройки
        if (count($settings) < 1) {
            // Выброс исключения
            throw new NotFoundException('Страница не найдена', 404);
        }
        // Заголовок страницы
        $result['title'] = 'Настройки';
        // Страница
        $result['settings'] = $settings[0];
        // Если форма не отправлялась, то некоторые поля надо заполнить сразу
        if ($result['form']['error'] === FORM_NOT_SENT) {
            $result['form']['value'] = $result['settings']->value;
        }
        // Возврат объекта - шаблона страницы "Управление настройками"
        return new View('admin_settings', $result);
    }

    protected function validateForm(array $data)
    {
        // Если поле 'Значение' не заполнено
        if (!(isset($data['value']) && $data['value'] !== '')) {
            throw new Exception('Введите значение', FORM_VALUE);
        }
        // Если в поле 'Значение' введено нецелое число
        if ((int)$data['value'] === 0) {
            throw new Exception('Значение должно быть целым положительным числом и не равно нулю', FORM_VALUE);
        }
    }

    protected function saveData(array $data)
    {
        // Обновление данных в базе
        Setting::where('name', 'home_elements_per_page')
            ->update(['value' => (int)$data['value']]);
        throw new Exception('Изменения сохранены! Количество статей, отображаемых на главной странице: ' . (int)$data['value'], FORM_SUCCESS);
    }
}
