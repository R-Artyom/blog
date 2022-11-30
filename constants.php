<?php
/**
 * Роли пользователей на сайте
 */
// Зарегистрированный пользователь
const USER = 1;
// Контент-менеджер
const MANAGER = 2;
// Администратор
const ADMIN = 3;

/**
 * Признак активности комментария
 */
// Комментарий не прошел модерацию
const COMMENT_NO_ACTIVE = 0;
// Комментарий прошел модерацию
const COMMENT_ACTIVE = 1;

/**
 * Коды исключения при работе с формами
 */
// 'Форма не отправлялась'
const FORM_NOT_SENT = 0;
// Поле 'Имя'
const FORM_NAME = 1;
// Поле 'Email'
const FORM_EMAIL = 2;
// Поле 'Пароль'
const FORM_PASSWORD = 3;
// Поле 'Повторите пароль'
const FORM_REPEAT_PASSWORD = 4;
// Чекбокс 'Правила сайта'
const FORM_TERMS = 5;
// 'Успешная регистрация'
const FORM_SUCCESS = 6;
