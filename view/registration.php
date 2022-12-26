<?php if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
    <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
        <?=$form['message']?>
    </div>
<?php else:?>
    <div class="row d-flex form-thumbnail m-auto border shadow">
        <form method="post" class="py-3 px-4 m-auto" action="<?=PATH_REGISTRATION?>">
            <h4 class="mb-3 text-start">Регистрация пользователя</h4>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_NAME ? 'focus' : ''?>" name="name" value="<?= $form['name'] ?? ''?>" required>
                    <span class="placeholder-text">Введите ваше имя <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_NAME):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_EMAIL ? 'focus' : ''?>" name="email" value="<?= $form['email'] ?? ''?>" required>
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
                    <input type="password" class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_PASSWORD ? 'focus' : ''?>" name="password" value="<?= $form['password'] ?? ''?>" required>
                    <span class="placeholder-text">Введите ваш пароль <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div>
                <label class="placeholder-box">
                    <input type="password" class="form-control form-style-1 rounded-0 <?= $form['error'] === FORM_REPEAT_PASSWORD ? 'focus' : ''?>" name="repeatPassword" value="<?= $form['repeatPassword'] ?? ''?>" required>
                    <span class="placeholder-text">Введите ваш пароль повторно <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_REPEAT_PASSWORD):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>
            <div class="form-check">
                <input class="form-check-input check-style-1 <?= $form['error'] === FORM_TERMS ? 'focus' : ''?>" type="checkbox" name="terms" value="yes" id="terms" <?=isset($form['terms']) ? 'checked="checked"' : ''?>>
                <label class="form-check-label ms-2" for="terms">
                    Согласен c <a class="link-style-1" href="<?=PATH_TERMS?>">правилами сайта</a>
                </label>
            </div>
            <?php if ($form['error'] === FORM_TERMS):?>
                <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
            <?php else:?>
                <div class="mb-3"></div>
            <?php endif?>
            <button type="submit" class="btn btn-style-2 w-100 rounded-0 mb-3" name="reg" value="yes" formnovalidate>Зарегистрироваться</button>
            <a class="link-style-1" href="<?=PATH_AUTHORIZATION?>">Войти</a>
        </form>
    </div>
<?php endif?>
