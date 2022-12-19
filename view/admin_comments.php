<?php if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
    <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
        <?=$form['message']?>
    </div>
<?php elseif (isset($comments) && count($comments) > 0):?>
    <div class="row g-0">
        <?php foreach ($comments as $comment):?>
            <div class="row comment g-0 px-5 py-4 border shadow">
                <div class="col-auto pt-2 me-4 mb-4 avatar-thumbnail">
                    <img class="rounded-3 avatar-thumbnail" src="<?=PATH_IMG_USERS . '/' . $comment->img_name?>" alt="ava">
                </div>
                <div class="col">
                    <div>
                        <div class="me-2 d-inline-flex"><strong><?=$comment->user_name?></strong></div>
                        <div class="mb-2 text-style-1 small"><?=date('Зарегистрирован d-m-Y H:i', strtotime($comment->user_created_at))?></div>
                    </div>
                    <div class="mb-2">
                        <?=$comment->text?>
                    </div>
                    <div class="mb-2 text-style-1 small">
                        <i class="bi bi-stopwatch"></i>
                        <?=date('d-m-Y H:i', strtotime($comment->created_at))?>
                    </div>

                    <form class="row mb-2" method="post" action="<?=PATH_ADMIN_COMMENTS . '/' . $comment->id . '/edit'?>">
                        <div class="col d-flex link-style-4 justify-content-start align-items-end">
                            <input type="text" name="idComment" value="<?=$comment->id?>" hidden>
                            <?php if ($comment->active === YES):?>
                                <button class="btn btn-sm width-120 btn-style-5 rounded-pill" type="submit" name="approve" value="no" text="Одобрен" hover-text="Отклонить"></button>
                            <?php else:?>
                                <button class="btn btn-sm width-120 btn-style-4 rounded-pill" type="submit" name="approve" value="yes">
                                    <strong><i class="bi bi-check2 me-1"></i>Одобрить</strong>
                                </button>
                            <?php endif?>
                        </div>
                        <div class="col-auto d-flex justify-content-end">
                            <input type="text" name="idComment" value="<?=$comment->id?>" hidden>
                            <button class="btn btn-style-5 rounded-0" type="submit" name="delete" value="yes">
                                <i class="bi bi-trash me-1"></i>Удалить комментарий
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach?>
    </div>
<?php else:?>
    <span class="h3">Извините, пользователи ещё не написали ни олного комментария к статьям</span>
<?php endif?>