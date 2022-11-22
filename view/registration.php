<div class="row d-flex form-thumbnail m-auto border shadow">
    <?php if (isset($success)):?>
        <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
            <?=$success?>
        </div>
    <?php else:?>
        <form method="post" class="py-3 px-4 m-auto" action="/registration">
            <h4 class="mb-3 text-start">Регистрация пользователя</h4>
            <div>
                <label for="name" class="form-label" hidden>Имя</label>
                <input type="text" class="form-control form-style-1 rounded-0" id="name" name="name" <?=isset($name) ? 'value=' . htmlspecialchars($name) : ''?> placeholder="Введите ваше имя">
                <?php if (isset($errors['name'])):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small">Введите имя</span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label for="email" class="form-label" hidden>Адрес электронной почты</label>
                <input type="email" class="form-control form-style-1 rounded-0" id="email" name="email" <?=isset($email) ? 'value=' . htmlspecialchars($email) : ''?> placeholder="Введите ваш email">
                <?php if (isset($errors['email'])):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$errors['email']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label for="password" class="form-label" hidden>Пароль</label>
                <input type="password" class="form-control form-style-1 rounded-0" id="password" name="password" <?=isset($password) ? 'value=' . htmlspecialchars($password) : ''?> placeholder="Введите ваш пароль" >
                <?php if (isset($errors['password'])):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small">Введите пароль</span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label for="repeat-password" class="form-label" hidden>Подтверждение пароля</label>
                <input type="password" class="form-control form-style-1 rounded-0" id="repeat-password" name="repeat-password" <?=isset($repeatPassword) ? 'value=' . htmlspecialchars($repeatPassword) : ''?> placeholder="Введите ваш пароль повторно" >
                <?php if (isset($errors['repeatPassword'])):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$errors['repeatPassword']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div class="form-check">
                <input class="form-check-input check-style-1" type="checkbox" name="terms" value="yes" id="terms" <?=isset($terms) ? 'checked="checked"' : ''?>>
                <label class="form-check-label ms-2" for="terms">
                    Cогласен c <a class="link-style-1" href="/terms">правилами сайта</a>
                </label>
            </div>
            <?php if (isset($errors['terms'])):?>
                <div class="mt-n1 mb-2"><span class="text-danger small">Необходимо согласиться с правилами сайта</span></div>
            <?php else:?>
                <div class="mb-3"></div>
            <?php endif?>
            <button type="submit" class="btn btn-style-2 w-100 rounded-0 mb-3" name="login" value="yes">Зарегистрироваться</button>
            <a class="link-style-1" href="/authorization">Войти</a>
        </form>
    <?php endif?>
</div>
