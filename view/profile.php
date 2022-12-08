<div class="row py-3 px-4 d-flex profile-thumbnail m-auto border shadow">
    <h4 class="mb-4 text-start">Профиль пользователя</h4>
    <p class="mb-4 d-flex justify-content-center">
        <img class="avatar-thumbnail-lg rounded-3" src="<?=PATH_IMG_USERS . '/' . $user['img_name']?>" alt="dots icon">
    </p>
    <hr>
    <p class="mb-2">
        <strong>Имя:</strong> <?=$user['name']?>
    </p>
    <p class="mb-2">
        <strong>Email:</strong> <?=$user['email']?>
    </p>
    <p class="mb-2">
        <strong>Статус:</strong> <?=ROLES[$user['role_id']]?>
    </p>
    <p class="mb-2">
        <strong>О себе:</strong> <?=$user['about_me']?>
    </p>
    <form method="post" class="mb-3" action="<?=PATH_SUBSCRIPTION?>">
        <strong>Подписка на рассылку: </strong>
        <?php if ($user['isSubscriber'] === YES):?>
            <button class="btn btn-sm width-120 btn-style-5 rounded-pill" type="submit" name="subscribe" value="no" text="Вы подписаны" hover-text="Отписаться"></button>
        <?php else:?>
            <button class="btn btn-sm width-120 btn-style-4 rounded-pill" type="submit" name="subscribe" value="yes"><strong>Подписаться</strong></button>
        <?php endif?>
            <input class="" type="text" name="email" placeholder="Введите ваш email" aria-label="Введите ваш email" value="<?=$user['email']?>" hidden>
    </form>
    <hr>
    <div class="d-flex justify-content-start">
        <a class="link-style-4 mb-2" href="<?=PATH_PROFILE_EDIT?>">
            <i class="bi bi-pencil"></i>
            <span class="text-decoration-underline">Редактировать</span>
        </a>
    </div>
</div>
