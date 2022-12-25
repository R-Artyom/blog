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
    private $pageCount;
    // Номер текущей страницы
    private $activePage;
    // Смещение (для запроса к БД)
    private $pageOffset;

    /**
     * Инициализация некоторых свойств при создании экземпляра класса
     * @param string $elementsCount - максимальное количество отображаемых элементов
     * @param string $elementsPerPage - количество элементов на одной странице, введенное пользователем (из GET-параметров)
     * @param string $activePage - номер текущей страницы, введенный пользователем (из GET-параметров)
     */
    public function __construct(string $elementsCount, string $elementsPerPage, string $activePage)
    {
        // Общее количество элементов
        $this->elementsCount = $elementsCount;
        // Количество записей на одной странице для отображения в dropdown:
        // если не задано - то значение "по умолчанию",
        // если не равен ни одному из элементов массива - то значение "по умолчанию",
        // если это целое число и больше, чем максимум - то последний элемент массива (все записи)
        $this->elementsPerPageMenu = $elementsPerPage ?? ELEMENTS_PER_PAGE['default'];
        $this->elementsPerPageMenu = in_array($this->elementsPerPageMenu, ELEMENTS_PER_PAGE) ? $this->elementsPerPageMenu : ELEMENTS_PER_PAGE['default'];
        $this->elementsPerPageMenu = is_int($this->elementsPerPageMenu) && $this->elementsPerPageMenu > max(ELEMENTS_PER_PAGE) ? ELEMENTS_PER_PAGE[array_key_last(ELEMENTS_PER_PAGE)] : $this->elementsPerPageMenu;
        // Окончательное значение (число) количества записей на одной странице (с учетом пункта меню "Все")
        $this->elementsPerPageDb = $this->elementsPerPageMenu === ELEMENTS_PER_PAGE[array_key_last(ELEMENTS_PER_PAGE)] ? $this->elementsCount : $this->elementsPerPageMenu;
        // Общее количество страниц
        $this->pageCount = ceil($this->elementsCount / $this->elementsPerPageDb);
        // Номер активной (текущей) страницы:
        // если не задан - то "1",
        // если больше последней страницы - то приравнивается к последней странице
        $this->activePage = $activePage ?? 1;
        $this->activePage = $this->activePage < $this->pageCount ? $this->activePage : $this->pageCount;
        // Смещение (для запроса к БД)
        $this->pageOffset = $this->elementsPerPageDb * ($this->activePage - 1);
    }

    /**
     * Формирование массива, необходимого для постраничной навигации
     * @param array $pageButtons - массив "Кнопки постраничной навигации"
     * @return array - результирующий массив
     */
    public function getPageButtons(array $pageButtons): array
    {
        // Кнопка "Текущая страница"
        $pageButtons['active']['num'] = $this->activePage;
        $pageButtons['active']['text'] = $this->activePage;

        // Кнопка "Последняя страница"
        $pageButtons['last']['num'] = $this->pageCount;
        $pageButtons['last']['text'] = $this->pageCount;

        // Формирование номера необходимых кнопок страниц
        $pageButtons['previous']['num'] = $this->activePage - 1;
        $pageButtons['left2']['num'] = $this->activePage - 2;
        $pageButtons['left1']['num'] = $this->activePage - 1;
        $pageButtons['right1']['num'] = $this->activePage + 1;
        $pageButtons['right2']['num'] = $this->activePage + 2;
        $pageButtons['next']['num'] = $this->activePage + 1;

        // Формирование текста необходимых кнопок страниц
        $pageButtons['left2']['text'] = $pageButtons['left2']['num'];
        $pageButtons['left1']['text'] = $pageButtons['left1']['num'];
        $pageButtons['right1']['text'] = $pageButtons['right1']['num'];
        $pageButtons['right2']['text'] = $pageButtons['right2']['num'];

        // Формирование признака "Показывать кнопку страницы"
        // Левая часть кнопок
        if ($pageButtons['left1']['num'] < 1) {
            $pageButtons['left1']['show'] = null;
            $pageButtons['right2']['show'] = true;
        }
        if ($pageButtons['active']['num'] == 1) {
            $pageButtons['previous']['show'] = null;
            $pageButtons['firstSep']['show'] = null;
            $pageButtons['first']['show'] = null;
        }
        if ($pageButtons['active']['num'] == 2) {
            $pageButtons['first']['show'] = null;
            $pageButtons['firstSep']['show'] = null;
        }
        if ($pageButtons['active']['num'] == 3) {
            $pageButtons['firstSep']['show'] = null;
        }
        // Правая часть кнопок (аналогична левой)
        if ($pageButtons['right1']['num'] > $this->pageCount) {
            $pageButtons['right1']['show'] = null;
            $pageButtons['left2']['show'] = true;
        }
        if ($pageButtons['active']['num'] == $this->pageCount) {
            $pageButtons['lastSep']['show'] = null;
            $pageButtons['next']['show'] = null;
            $pageButtons['last']['show'] = null;
        }
        if ($pageButtons['active']['num'] >= $this->pageCount - 1) {
            $pageButtons['lastSep']['show'] = null;
            $pageButtons['last']['show'] = null;
        }
        if ($pageButtons['active']['num'] >= $this->pageCount - 2) {
            $pageButtons['lastSep']['show'] = null;
        }
        // Проверка граничных значений вторых кнопок
        if ($pageButtons['left2']['num'] <= 1) {
            $pageButtons['left2']['show'] = null;
        }
        if ($pageButtons['right2']['num'] >= $this->pageCount) {
            $pageButtons['right2']['show'] = null;
        }
        if ($this->pageCount == 1) {
            $pageButtons['active']['show'] = null;
        }
        if ($this->pageCount == 4) {
            $pageButtons['firstSep']['show'] = null;
            $pageButtons['lastSep']['show'] = null;
        }

        // Возврат массива
        return $pageButtons;
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
}
