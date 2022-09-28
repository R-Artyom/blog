<?php
namespace App\Controllers;

class StaticPageController
{
    public function about()
    {
        // html выводится прямо здесь, лишь для знакомства, позже мы вынесем логику формирования html в шаблонизатор
        return '<a href="/">На главную</a>';
    }
}
