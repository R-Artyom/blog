<?php

namespace App\Controllers;

use App\Exception\ApplicationException;
use Exception;
use RuntimeException;

abstract class FormController
{
    // Проверка формы
    protected function checkForm()
    {
        // Если форма была отправлена
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Копирование всех непустых данных формы
            $result = filterData($_POST);
            try {
                // Валидация полей формы
                $this->validateForm($result);
                // Сохранение данных из формы
                $this->saveData($result);
                // Исключения ORM Eloquent (класс PDOException является наследником RuntimeException)
            } catch (RuntimeException $e) {
                var_dump($e->getMessage());
                // Вывод на страницу ошибки при работе с базой данных
                throw new ApplicationException("Ошибка базы данных");
                // Исключения формы регистрации
            } catch (Exception $e) {
                // Сообщение выброшенного исключения
                $result['message'] = $e->getMessage();
                // Код выброшенного исключения
                $result['error'] = $e->getCode();
            }
            // Если форма не отправлялась
        } else {
            $result['error'] = FORM_NOT_SENT;
        }
        return $result;
    }

    // Валидация полей формы
    abstract protected function validateForm(array $data);
    // Сохранение данных
    abstract protected function saveData(array $data);
}