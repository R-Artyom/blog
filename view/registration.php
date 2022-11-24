<div class="row d-flex form-thumbnail m-auto border shadow">
    <?php if (isset($error) && ($error === FORM_SUCCESS)):?>
        <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
            <?=$message?>
        </div>
    <?php else:?>
        <form method="post" class="py-3 px-4 m-auto" action="/registration">
            <h4 class="mb-3 text-start">Регистрация пользователя</h4>
            <div>
                <label for="name" class="form-label" hidden>Имя</label>
                <input type="text" class="form-control form-style-1 rounded-0 <?= $error === FORM_NAME ? 'focus' : ''?>" id="name" name="name" <?=isset($name) ? 'value=' . $name : ''?> placeholder="Введите ваше имя">
                <?php if ($error === FORM_NAME):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$message?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label for="email" class="form-label" hidden>Адрес электронной почты</label>
                <input type="text" class="form-control form-style-1 rounded-0 <?= $error === FORM_EMAIL ? 'focus' : ''?>" id="email" name="email" <?=isset($email) ? 'value=' . $email : ''?> placeholder="Введите ваш email">
                <?php if ($error === FORM_EMAIL):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$message?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label for="password" class="form-label" hidden>Пароль</label>
                <input type="password" class="form-control form-style-1 rounded-0 <?= $error === FORM_PASSWORD ? 'focus' : ''?>" id="password" name="password" <?=isset($password) ? 'value=' . $password : ''?> placeholder="Введите ваш пароль">
                <?php if ($error === FORM_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$message?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label for="repeat-password" class="form-label" hidden>Подтверждение пароля</label>
                <input type="password" class="form-control form-style-1 rounded-0 <?= $error === FORM_REPEAT_PASSWORD ? 'focus' : ''?>" id="repeat-password" name="repeatPassword" <?=isset($repeatPassword) ? 'value=' . $repeatPassword : ''?> placeholder="Введите ваш пароль повторно">
                <?php if ($error === FORM_REPEAT_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$message?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div class="form-check">
                <input class="form-check-input check-style-1 <?= $error === FORM_TERMS ? 'focus' : ''?>" type="checkbox" name="terms" value="yes" id="terms" <?=isset($terms) ? 'checked="checked"' : ''?>>
                <label class="form-check-label ms-2" for="terms">
                    Cогласен c <a class="link-style-1" href="/terms">правилами сайта</a>
                </label>
            </div>
            <?php if ($error === FORM_TERMS):?>
                <div class="mt-n1 mb-2"><span class="text-danger small"><?=$message?></span></div>
            <?php else:?>
                <div class="mb-3"></div>
            <?php endif?>
            <button type="submit" class="btn btn-style-2 w-100 rounded-0 mb-3" name="reg" value="yes">Зарегистрироваться</button>
            <a class="link-style-1" href="/authorization">Войти</a>
        </form>
    <?php endif?>
</div>
