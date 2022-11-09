<div class="row d-flex form-thumbnail m-auto border shadow">
    <form method="post" class="p-4 m-auto" action="/authorization/?login=yes">
        <h4 class="mb-3 text-start">Авторизация</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" hidden>Адрес электронной почты</label>
            <input type="email" class="form-control form-style-1 rounded-0" id="exampleInputEmail1" placeholder="Введите ваш email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" hidden>Пароль</label>
            <input type="password" class="form-control form-style-1 rounded-0" id="exampleInputPassword1" placeholder="Введите ваш пароль" >
        </div>
        <button type="submit" class="btn btn-style-2 w-100 rounded-0 mb-3" name="login" value="yes">Войти в личный кабинет</button>
        <a class="link-style-1" href="/registration">Зарегистрироваться</a>
    </form>
</div>
