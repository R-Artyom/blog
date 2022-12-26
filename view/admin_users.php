<?php use App\Profile;

if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
    <div class="py-3 px-5 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
        <?=$form['message']?>
    </div>
<?php else:?>
    <div class="row g-0">
        <?php require 'layout/pagination_header.php';?>
        <?php foreach ($users as $user):?>
            <div class="row comment g-0 px-5 py-4 border shadow">
                <div class="col-auto pt-2 me-4 mb-4 avatar-thumbnail">
                    <img class="rounded-3 avatar-thumbnail" src="<?=PATH_IMG_USERS . '/' . $user->img_name?>" alt="ava">
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="me-2 d-inline-flex"><strong><?=$user->name?></strong></div>
                        <?php if ($user->id === Profile::getInstance()->get('id')):?>
                            <span class="position-absolute p-1 badge rounded-3 text-style-2 text-bg-style-3">Это Вы</span>
                        <?php endif?>
                    </div>

                    <form class="row" method="post" action="<?=PATH_ADMIN_USERS?>">
                        <div class="col d-flex text-style-1 align-items-end">
                            <span><strong>Зарегистрирован: </strong><?=date('d-m-Y в H:i:s', strtotime($user->created_at))?></span>
                        </div>
                        <div class="col d-flex text-style-1 align-items-end">
                            <span><strong>Статус: </strong><?=ROLES[$user['role_id']]?></span>
                        </div>
                        <div class="col-auto d-flex text-style-1">
                            <select class="form-select form-select-style-1 rounded-0" name="roleId" aria-label="Default select example" <?=$user->id === Profile::getInstance()->get('id') ? 'disabled' : ''?>>
                                <option <?=$user['role_id'] === ADMIN ? 'selected' : ''?> value="<?=ADMIN?>"><?=ROLES[ADMIN]?></option>
                                <option <?=$user['role_id'] === MANAGER ? 'selected' : ''?> value="<?=MANAGER?>"><?=ROLES[MANAGER]?></option>
                                <option <?=$user['role_id'] === USER ? 'selected' : ''?> value="<?=USER?>"><?=ROLES[USER]?></option>
                            </select>
                        </div>
                        <div class="col-auto d-flex justify-content-end <?=$user->id === Profile::getInstance()->get('id') ? 'disabled' : ''?>">
                            <input type="text" name="idUser" value="<?=$user->id?>" hidden>
                            <button class="btn btn-style-5 rounded-0" type="submit" name="apply" value="yes" <?=$user->id === Profile::getInstance()->get('id') ? 'disabled' : ''?>>Применить</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach?>
        <?php require 'layout/pagination_footer.php';?>
    </div>
<?php endif?>
