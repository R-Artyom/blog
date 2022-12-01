<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS-->
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap icons CSS-->
    <link href="/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="/img/favicon.png" rel="icon" type="image/png">
</head>

<body>
    <header class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-2 d-flex align-items-center mb-2">
                    <a class="navbar-brand text-white fw-bold fs-1" href="/">Blog</a>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <form class="input-group justify-content-start">
                        <button class="btn btn-style-2 rounded-0" type="submit" name="subscribe" value="yes">Подписаться</button>
                        <input class="form-control form-style-1 rounded-0" type="text" placeholder="Введите ваш email" aria-label="Введите ваш email">
                    </form>
                </div>
                <?php if (!isset($userName)):?>
                    <div class="col-6 d-flex align-items-center">
                        <div class="input-group justify-content-end">
                            <a class="btn btn-style-1 rounded-0" href="/authorization">Войти</a>
                            <a class="btn btn-style-1 rounded-0" href="/registration">Зарегистрироваться</a>
                        </div>
                    </div>
                <?php else:?>
                    <div class="col-6 dropdown d-flex align-items-center justify-content-end">
                        <a class="link-style-2 dropdown-toggle" data-bs-toggle="dropdown"  href="#" role="button" aria-expanded="true">
                            <img class="avatar-thumbnail-sm p-0 me-1" src="/img/users/<?=$imgName?>" alt="dots icon">
                            <span class=""><?=$userName?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-style-1 dropdown-menu-end rounded-0">
                            <?php foreach (DROPDOWN_MENU as $value):?>
                                <?php if (($userStatus & $value['access']) > 0):?>
                                    <li>
                                        <a class="dropdown-item dropdown-item-style-1" href="<?=$value['path']?>">
                                            <?=$value['icon']?>
                                            <?=$value['title']?>
                                            <?=$value['title'] === 'Профиль' ? '(' . ROLES[$userStatus] . ')': ''?>
                                        </a>
                                    </li>
                                <?php endif?>
                            <?php endforeach?>
<!--                            <li><a class="dropdown-item active" href="#">Активная ссылка</a></li>-->
<!--                            <li><a class="dropdown-item disabled" href="#">Отключенная ссылка</a></li>-->
                        </ul>
                    </div>
                <?php endif?>
            </div>
        </div>
        <div class="container py-2 g-2">
            <nav class="nav d-flex justify-content-start">
                <a class="p-2 nav-link link-style-2" href="/">Главная</a>
                <a class="p-2 nav-link disabled" href="#">Неактивная ссылка</a>
                <a class="p-2 nav-link link-style-2" href="/terms">Правила пользования сайтом</a>
            </nav>
        </div>
    </header>
    <main class="d-flex content container my-4">
