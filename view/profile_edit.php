<div class="row d-flex profile-thumbnail m-auto border shadow">
    <?php if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
        <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
            <?=$form['message']?>
        </div>
    <?php else:?>

        <form method="post" class="py-3 px-4 m-auto" enctype="multipart/form-data" action="<?=PATH_PROFILE_EDIT?>">
            <h4 class="mb-3 text-start">Редактирование профиля пользователя</h4>

            <p class="mb-2">
                <strong>Аватар:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <div class="mb-4 justify-content-center d-flex">
                        <img class="avatar-thumbnail-lg rounded-3" id="preview" src="<?=PATH_IMG_USERS . '/' . $user['img_name']?>" alt="dots icon">
                    </div>
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?=MAX_FILE_SIZE?>">
                        <input class="form-control form-style-3 <?= $form['error'] === FORM_IMAGE ? 'focus' : ''?>" type="file" name="imgName" id="imgName" accept="<?php foreach (ALLOWED_IMG_TYPE as $value):?><?=$value . ','?><?php endforeach ?>"/>
                    </div>
                </label>
                <?php if ($form['error'] === FORM_IMAGE):?>
                    <div class="mt-n1 mb-2 error"><span class="text-danger small"><?=$form['message']?></span></div>
                    <div class="mb-3 no-error" hidden></div>
                <?php else:?>
                    <div class="mb-3 no-error"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>Имя:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-3 rounded-0 <?= $form['error'] === FORM_NAME ? 'focus' : ''?>" name="name" value="<?= $form['name'] ?? ''?>" required>
                    <span class="placeholder-text">Введите ваше имя <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_NAME):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>Email:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-3 rounded-0 <?= $form['error'] === FORM_EMAIL ? 'focus' : ''?>" name="email" value="<?= $form['email'] ?? ''?>" required>
                    <span class="placeholder-text">Введите ваш email <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_EMAIL):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>О себе:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <textarea class="mb-3 form-control form-style-3 rounded-0" maxlength="255" name="aboutMe" placeholder="Введите краткую информацию о себе"><?= $form['aboutMe'] ?? ''?></textarea>
                </label>
            </div>

            <p class="mb-2">
                <strong>Новый пароль:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <input type="password" class="form-control form-style-3 rounded-0 <?= $form['error'] === FORM_PASSWORD ? 'focus' : ''?>" name="password" value="<?= $form['password'] ?? ''?>" required>
                    <span class="placeholder-text">Введите новый пароль</span>
                </label>
                <?php if ($form['error'] === FORM_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>Подтверите новый пароль:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <input type="password" class="form-control form-style-3 rounded-0 <?= $form['error'] === FORM_REPEAT_PASSWORD ? 'focus' : ''?>" name="repeatPassword" value="<?= $form['repeatPassword'] ?? ''?>" required>
                    <span class="placeholder-text">Введите новый пароль повторно</span>
                </label>
                <?php if ($form['error'] === FORM_REPEAT_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-4"></div>
                <?php endif?>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="submit" class="btn btn-style-4 width-200 rounded-0 mb-3" name="save" value="yes" formnovalidate>Сохранить изменения</button>
            </div>
            <div class="col d-flex justify-content-start">
                <a class="link-style-4 mb-2" href="<?=PATH_PROFILE?>">
                    <i class="bi bi-box-arrow-left"></i>
                    <span class="text-decoration-underline">Отмена</span>
                </a>
            </div>
        </form>
    <?php endif?>
</div>
