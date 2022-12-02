<div class="row d-flex form-thumbnail m-auto border shadow">
    <?php if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
        <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
            <?=$form['message']?>
        </div>
    <?php else:?>
        <form method="post" class="py-3 px-4 m-auto" action="<?=PATH_AUTHORIZATION?>">
            <h4 class="mb-3 text-start">Авторизация</h4>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_EMAIL ? 'focus' : ''?>" name="email" <?=isset($form['email']) ? 'value=' . $form['email'] : ''?> required>
                    <span class="placeholder-text">Введите ваш email <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_EMAIL):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label class="placeholder-box">
                    <input type="password" class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_PASSWORD ? 'focus' : ''?>" name="password" <?=isset($form['password']) ? 'value=' . $form['password'] : ''?> required>
                    <span class="placeholder-text">Введите ваш пароль <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <button type="submit" class="btn btn-style-2 w-100 rounded-0 mb-3" name="reg" value="yes" formnovalidate>Войти в личный кабинет</button>
            <a class="link-style-1" href="<?=PATH_REGISTRATION?>">Зарегистрироваться</a>
        </form>
    <?php endif?>
</div>
