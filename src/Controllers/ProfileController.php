<?php

namespace App\Controllers;

use App\Exception\ApplicationException;
use App\Models\User;
use App\Profile;
use App\Session;
use App\View\View;
use Exception;
use RuntimeException;

class ProfileController
{
    // Страница "Профиль пользователя"
    public function profile(): View
    {
        // Данные пользователя
        $result['user'] = Profile::getInstance()->getAll();
        // Заголовок страницы
        $result['title'] = 'Профиль пользователя';
        // Возврат объекта - шаблона страницы "Профиль пользователя"
        return new View('profile', $result);
    }

    // Страница "Редактирование профиля пользователя"
    public function profileEdit(): View
    {
        // Данные пользователя
        $result['user'] = Profile::getInstance()->getAll();
        // Проверка формы
        $result['form'] = $this->checkForm();
        if ($result['form']['error'] === FORM_NOT_SENT) {
            $result['form']['name'] = $result['user']['name'];
            $result['form']['email'] = $result['user']['email'];
            $result['form']['aboutMe'] = $result['user']['about_me'];
        }
        // Заголовок страницы
        $result['title'] = 'Профиль пользователя';
        // Возврат объекта - шаблона страницы "Профиль пользователя"
        return new View('profile_edit', $result);
    }

    // Проверка формы
    private function checkForm()
    {
        // Если форма была отправлена
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Копирование всех непустых данных формы
            foreach ($_POST as $key => $value) {
                if (isset($value) && $value !== '') {
                    $result[$key] = htmlspecialchars($value);
                }
            }
            try {
                // Валидация полей формы регистрации
                $this->validateForm($result);
                // Сохранение данных пользователя в базе
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
    private function validateForm(array $data)
    {
        // Если причина ошибки - слишком большой размер файла
        if ($_FILES['imgName']['error'] === UPLOAD_ERR_FORM_SIZE) {
            throw new Exception("Файл \"{$_FILES['imgName']['name']}\" не загружен!!! Размер файла не должен превышать 2 Мб.", FORM_IMAGE);
        }
        // Если тип файла не найден в списке разрешенных
        if (($_FILES['imgName']['tmp_name'] !== '')
            && !in_array (mime_content_type($_FILES['imgName']['tmp_name']), ALLOWED_IMG_TYPE, true)) {
            // Вывести сообщение и прекратить выполнение текущего скрипта
            throw new Exception("Файл \"{$_FILES['imgName']['name']}\" не загружен!!! Тип файла не поддерживается.", FORM_IMAGE);
        }
        // Если поле 'Имя' не заполнено
        if (!(isset($data['name']) && $data['name'] !== '')) {
            throw new Exception('Введите имя', FORM_NAME);
        }
        // Если поле 'Email' не заполнено
        if (!(isset($data['email']) && $data['email'] !== '')) {
            throw new Exception('Введите email', FORM_EMAIL);
        }
        // Если поле 'Email' не соответствует формату
        if ( filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            throw new Exception('Email не соответствует формату', FORM_EMAIL);
        }
        // Если поле 'Пароль' не заполнено, а поле 'Подтвердите пароль' заполнено
        if (!(isset($data['password']) && $data['password'] !== '')
            && isset($data['repeatPassword']) && $data['repeatPassword'] !== '') {
            throw new Exception('Введите пароль', FORM_PASSWORD);
        }
        // Если поле 'Повторите пароль' не заполнено, а поле 'Пароль' заполнено
        if (!(isset($data['repeatPassword']) && $data['repeatPassword'] !== '')
            && isset($data['password']) && $data['password'] !== '') {
            throw new Exception('Подтвердите пароль', FORM_REPEAT_PASSWORD);
        }
        // Если пароли не совпадают
        if (isset($data['password'])
            && isset($data['repeatPassword'])
            && $data['password'] !== $data['repeatPassword']) {
            throw new Exception('Пароли не совпадают', FORM_REPEAT_PASSWORD);
        }
        // Если в БД уже есть пользователь с таким email
        if ($data['email'] !== Profile::getInstance()->get('email')
            && count(User::where('email', $data['email'])->get()) > 0) {
            throw new Exception('Пользователь с таким email уже существует. <a class="text-danger" href="/authorization">Войти?</a>', FORM_EMAIL);
        }
    }

    // Сохранение данных пользователя в базе
    private function saveData(array $data)
    {
        // Если на сервер необходимо загрузить новую аватарку
        if ($_FILES['imgName']['tmp_name'] !== '') {
            // Определение номера позиции знака "точка" в названии зашружаемого файла
            while (true) {
                // Начальное смещение при поиске
                static $offset = 0;
                // Поиск первой точки в названии файла, начиная с $offset
                $positionPointTmp  = mb_strpos($_FILES['imgName']['name'], '.', $offset);
                // Если ни одной точки больше не найдено
                if ($positionPointTmp === false) {
                    break;
                } else {
                    $positionPoint = $positionPointTmp;
                    // Менем смещение, для поиска следующей точки в названии
                    $offset = $positionPoint + 1;
                }
            }
            // Определение расширение файла, зная позицию знака "точка"
            $filenameExtension = mb_substr($_FILES['imgName']['name'], $positionPoint);
            // Новое уникальное название изображения, которое будет присвоено пользователю
            // (состоит из ID пользователя + расширение загружаемого файла)
            $newNamePhoto = Profile::getInstance()->get('id') . $filenameExtension;
            // Загрузка файла в папку, если нет никаких ошибок
            move_uploaded_file($_FILES['imgName']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . PATH_IMG_USERS . '/' . $newNamePhoto);
        }

        // Обновление данных в базе
        User::where('id', Profile::getInstance()->get('id'))
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'about_me' => $data['aboutMe'] ?? '',
                'password' => isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : Profile::getInstance()->get('password'),
                'img_name' => $newNamePhoto ?? Profile::getInstance()->get('img_name'),
            ]);

        // Создание экземпляра сессии
        $session = new Session();
        // Старт сессии с новым логином
        $session->start($data['email']);
        // Перенаправление на страницу авторизации
        header ('Location:' . PATH_PROFILE);
        // Прерывание выполнения скрипта
        exit();
    }
}
