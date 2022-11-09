<div class="row d-flex form-thumbnail m-auto border shadow">
    <form method="post" class="p-4 m-auto" action="/authorization/?login=yes">
        <h4 class="mb-3 text-start">Регистрация пользователя</h4>
        <div class="mb-3">
            <label for="name" class="form-label" hidden>Имя</label>
            <input type="text" class="form-control form-style-1 rounded-0" id="name" placeholder="Введите ваше имя">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" hidden>Адрес электронной почты</label>
            <input type="email" class="form-control form-style-1 rounded-0" id="exampleInputEmail1" placeholder="Введите ваш email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" hidden>Пароль</label>
            <input type="password" class="form-control form-style-1 rounded-0" id="exampleInputPassword1" placeholder="Введите ваш пароль" >
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label" hidden>Подтверждение пароля</label>
            <input type="password" class="form-control form-style-1 rounded-0" id="exampleInputPassword2" placeholder="Введите ваш пароль повторно" >
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input check-style-1" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label ms-2" for="flexCheckDefault">
                Cогласен c <a class="link-style-1" href="/terms">правилами сайта</a>
            </label>
        </div>
        <button type="submit" class="btn btn-style-2 w-100 rounded-0 mb-3" name="login" value="yes">Зарегистрироваться</button>
        <a class="link-style-1" href="/authorization">Войти</a>
    </form>
</div>
