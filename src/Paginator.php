<?php

namespace App;

// Класс "Постраничный навигатор"
class Paginator
{
    // Общее количество элементов
    private $elementsCount;
    // Количество элементов на одной странице (отображается в меню dropdown - м.б. не число)
    private $elementsPerPageMenu;
    // Количество элементов на одной странице (для запроса к БД - число, м.б. число в виде строки)
    private $elementsPerPageDb;
    // Общее количество страниц (= номер последней страницы))
    private $pagesCount;
    // Номер текущей страницы
    private $activePage;
    // Смещение (для запроса к БД)
    private $pageOffset;
    // Массив "Кнопки постраничной навигации" с установленными начальными значениями
    private $defaultButtons = [];

    /**
     * Инициализация некоторых свойств при создании экземпляра класса
     * @param string $elementsCount - максимальное количество отображаемых элементов
     * @param array $defaultButtons - массив-шаблон постраничной навигации с установленными начальными значениями
     * @param array $defaultDropdownMenu - массив-шаблон выпадающего списка меню с установленными начальными значениями
     */
    public function __construct(string $elementsCount, array $defaultButtons, array $defaultDropdownMenu = ELEMENTS_PER_PAGE)
    {
        // Если есть GET-параметры
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Фильтрация GET-параметров
            $result = filterData($_GET);
        }
        // Кнопки постраничной навигации
        $this->defaultButtons = $defaultButtons;
        // Общее количество элементов
        $this->elementsCount = $elementsCount;
        // Количество записей на одной странице для отображения в dropdown:
        // если не задано - то значение "по умолчанию",
        // если не равен ни одному из элементов массива - то значение "по умолчанию",
        // если это целое число и больше, чем максимум - то последний элемент массива (все записи)
        $this->elementsPerPageMenu = $result['quantity'] ?? $defaultDropdownMenu['default'];
        $this->elementsPerPageMenu = in_array($this->elementsPerPageMenu, $defaultDropdownMenu) ? $this->elementsPerPageMenu : $defaultDropdownMenu['default'];
        $this->elementsPerPageMenu = is_int($this->elementsPerPageMenu) && $this->elementsPerPageMenu > max($defaultDropdownMenu) ? $defaultDropdownMenu[array_key_last($defaultDropdownMenu)] : $this->elementsPerPageMenu;
        // Окончательное значение (число) количества записей на одной странице ()
        // если выбран пункт меню "Все" или если выбран пункт с большим, чем общее количество элементов - то равно общему количеству элементов
        $this->elementsPerPageDb = $this->elementsPerPageMenu === 'Все' || $this->elementsCount < $this->elementsPerPageMenu ? $this->elementsCount : $this->elementsPerPageMenu;
        // Общее количество страниц
        $this->pagesCount = ceil($this->elementsCount / $this->elementsPerPageDb);
        // Номер активной (текущей) страницы:
        // если не задан - то "1",
        // если больше последней страницы - то приравнивается к последней странице
        $this->activePage = $result['page'] ?? 1;
        $this->activePage = $this->activePage < $this->pagesCount ? $this->activePage : $this->pagesCount;
        // Смещение (для запроса к БД)
        $this->pageOffset = $this->elementsPerPageDb * ($this->activePage - 1);
    }

    /**
     * Формирование массива, необходимого для постраничной навигации
     * @return array - результирующий массив
     */
    public function getButtons(): array
    {
        // Копирование массива кнопок пагинации со значениями по умолчанию
        $buttons = $this->defaultButtons;

        // Кнопка "Текущая страница"
        $buttons['active']['num'] = $this->activePage;
        $buttons['active']['text'] = $this->activePage;

        // Кнопка "Последняя страница"
        $buttons['last']['num'] = $this->pagesCount;
        $buttons['last']['text'] = $this->pagesCount;

        // Формирование номера необходимых кнопок страниц
        $buttons['previous']['num'] = $this->activePage - 1;
        $buttons['left2']['num'] = $this->activePage - 2;
        $buttons['left1']['num'] = $this->activePage - 1;
        $buttons['right1']['num'] = $this->activePage + 1;
        $buttons['right2']['num'] = $this->activePage + 2;
        $buttons['next']['num'] = $this->activePage + 1;

        // Формирование текста необходимых кнопок страниц
        $buttons['left2']['text'] = $buttons['left2']['num'];
        $buttons['left1']['text'] = $buttons['left1']['num'];
        $buttons['right1']['text'] = $buttons['right1']['num'];
        $buttons['right2']['text'] = $buttons['right2']['num'];

        // Формирование признака "Показывать кнопку страницы"
        // Левая часть кнопок
        if ($buttons['left1']['num'] < 1) {
            $buttons['left1']['show'] = null;
            $buttons['right2']['show'] = true;
        }
        if ($buttons['active']['num'] == 1) {
            $buttons['previous']['show'] = null;
            $buttons['firstSep']['show'] = null;
            $buttons['first']['show'] = null;
        }
        if ($buttons['active']['num'] == 2) {
            $buttons['first']['show'] = null;
            $buttons['firstSep']['show'] = null;
        }
        if ($buttons['active']['num'] == 3) {
            $buttons['firstSep']['show'] = null;
        }
        // Правая часть кнопок (аналогична левой)
        if ($buttons['right1']['num'] > $this->pagesCount) {
            $buttons['right1']['show'] = null;
            $buttons['left2']['show'] = true;
        }
        if ($buttons['active']['num'] == $this->pagesCount) {
            $buttons['lastSep']['show'] = null;
            $buttons['next']['show'] = null;
            $buttons['last']['show'] = null;
        }
        if ($buttons['active']['num'] >= $this->pagesCount - 1) {
            $buttons['lastSep']['show'] = null;
            $buttons['last']['show'] = null;
        }
        if ($buttons['active']['num'] >= $this->pagesCount - 2) {
            $buttons['lastSep']['show'] = null;
        }
        // Проверка граничных значений вторых кнопок
        if ($buttons['left2']['num'] <= 1) {
            $buttons['left2']['show'] = null;
        }
        if ($buttons['right2']['num'] >= $this->pagesCount) {
            $buttons['right2']['show'] = null;
        }
        if ($this->pagesCount == 1) {
            $buttons['active']['show'] = null;
        }
        if ($this->pagesCount == 4) {
            $buttons['firstSep']['show'] = null;
            $buttons['lastSep']['show'] = null;
        }

        // Возврат массива
        return $buttons;
    }

    /**
     * Запрос количества элементов на одной странице (для работы с БД)
     * @return int|string - результат
     */
    public function getLimit(): string
    {
        return $this->elementsPerPageDb;
    }

    /**
     * Запрос смещения (для работы с БД)
     * @return int|string - результат
     */
    public function getOffset(): int
    {
        return $this->pageOffset;
    }

    /**
     * Запрос количества элементов на странице (для отображения в меню dropdown)
     * @return int|string - результат
     */
    public function getQuantity(): string
    {
        return $this->elementsPerPageMenu;
    }

    /**
     * Запуск пагинатора
     * @return array - результирующий массив с данными, необходимыми для шаблона страницы
     */
    public function run(): array
    {
        // Кнопки постраничной навигации
        $result['buttons'] = $this->getButtons();
        // Количества элементов на странице (для отображения в меню dropdown)
        $result['quantity'] = $this->getQuantity();
        // Смещение (для работы с БД)
        $result['offset'] = $this->getOffset();
        // Количество элементов на одной странице (для работы с БД)
        $result['limit'] = $this->getLimit();
        // Признак "Отображать футер пагинатора"
        $result['showFooter'] = $this->elementsCount === $this->elementsPerPageDb ? null : true;
        // Результирующий массив
        return $result;
    }
}
