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
                    <a class="navbar-brand text-white fw-bold fs-1" href="<?=PATH_HOME?>">Blog</a>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <?php if (!isset($user['role_id']) || isset($user['isSubscriber']) && $user['isSubscriber'] === NO):?>
                        <form method="post" class="input-group justify-content-start" action="<?=PATH_SUBSCRIPTION?>">
                            <button class="btn btn-style-2 rounded-0" type="submit" name="subscribe" value="yes">Подписаться</button>
                            <input class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_EMAIL ? 'focus' : ''?>" type="text" name="email" placeholder="Введите ваш email" aria-label="Введите ваш email" value="<?=isset($user['role_id']) ? $user['email'] : ''?>" <?=isset($user['role_id']) ? 'hidden' : ''?> >
                        </form>
                    <?php endif?>
                </div>
                <?php if (!isset($user['name'])):?>
                    <div class="col-6 d-flex align-items-center">
                        <div class="input-group justify-content-end">
                            <a class="btn btn-style-1 rounded-0" href="<?=PATH_AUTHORIZATION?>">Войти</a>
                            <a class="btn btn-style-1 rounded-0" href="<?=PATH_REGISTRATION?>">Зарегистрироваться</a>
                        </div>
                    </div>
                <?php else:?>
                    <div class="col-6 dropdown d-flex align-items-center justify-content-end">
                        <a class="link-style-2 dropdown-toggle" data-bs-toggle="dropdown"  href="#" role="button" aria-expanded="true">
                            <img class="avatar-thumbnail-sm p-0 me-1" src="<?=PATH_IMG_USERS . '/' . $user['img_name']?>" alt="dots icon">
                            <span class=""><?=$user['name']?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-style-1 dropdown-menu-end rounded-0">
                            <?php foreach (DROPDOWN_MENU as $value):?>
                                <?php if (($user['role_id'] & $value['access']) > 0):?>
                                    <li>
                                        <a class="dropdown-item dropdown-item-style-1 <?=isCurrentUrl($value['path']) ? 'active' : ''?>" href="<?=$value['path']?>">
                                            <?=$value['icon']?>
                                            <?=$value['title']?>
                                            <?=$value['title'] === 'Профиль' ? '(' . ROLES[$user['role_id']] . ')': ''?>
                                        </a>
                                    </li>
                                <?php endif?>
                            <?php endforeach?>
                        </ul>
                    </div>
                <?php endif?>
            </div>
        </div>
        <div class="container py-2 g-2">
            <nav class="nav d-flex justify-content-start">
                <a class="p-2 nav-link link-style-2 <?=isCurrentUrl(PATH_HOME) ? 'active' : ''?>" href="<?=PATH_HOME?>">Главная</a>
                <?php foreach ($staticPages as $key => $value):?>
                    <a class="p-2 nav-link link-style-2 <?=isCurrentUrl(PATH_STATIC_PAGES . '/' . $key) ? 'active' : ''?>" href="<?=PATH_STATIC_PAGES . '/' . $key?>"><?=$value?></a>
                <?php endforeach?>
                <a class="p-2 nav-link link-style-2 <?=isCurrentUrl(PATH_TERMS) ? 'active' : ''?>" href="<?=PATH_TERMS?>">Правила пользования сайтом</a>
            </nav>
        </div>
    </header>
    <main class="d-flex content container my-4">
