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
    <p class="mb-3">
        <strong>Подписка:</strong> <?=$user['subscription'] === ACTIVE ? 'Подписан' : 'Не подписан'?>
    </p>
    <hr>
    <a class="link-style-1 mb-2" href="<?=PATH_PROFILE_EDIT?>">
        <i class="bi bi-pencil"></i>
        Редактировать
    </a>
</div>