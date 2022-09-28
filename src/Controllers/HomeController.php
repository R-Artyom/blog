<?php
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // html выводится прямо здесь, лишь для знакомства, позже мы вынесем логику формирования html в шаблонизатор
        return '<a href="/about">На страницу О нас</a>';
    }
}
