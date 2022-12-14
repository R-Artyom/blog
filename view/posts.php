<div class="row g-0">
    <div class="row g-0 mb-4 px-5 py-4 border shadow">
        <p class="h4"><?=$post->title?></p>
        <p class="mb-4 text-style-1 small">
            <i class="bi bi-stopwatch"></i>
            <?=date('d-m-Y H:i', strtotime($post->created_at))?>
        </p>
        <p class="row mb-4 g-0 justify-content-center">
            <img class="post-thumbnail shadow" src="<?=PATH_IMG_POSTS . '/' . $post->img_name?>" alt="dots icon">
        </p>
        <p class="row mb-3 g-0"><?=$post->text?></p>
    </div>

    <div class="row g-0 mb-4 px-5 py-4 border shadow">
        <div class="row mb-3 text-left h4">Комментарии (<?=count($comments)?>)</div>

        <div class="row mb-3 g-0">
            <form class="col" method="post" action="<?=PATH_POSTS . '/' . $post->id?>">
                <label for="message" class="form-label h4" hidden>Оставить комментарий:</label>
                <textarea class="mb-2 form-control form-style-3 rounded-0 shadow-sm <?= $form['error'] === FORM_TEXT ? 'focus' : ''?> " name="text" id="message" rows="5" placeholder="Введите ваш комментарий"></textarea>
                <input type="text" name="post-id" value="<?=$post->id?>" hidden>
                <input type="text" name="user-id" value="<?=$user['id']?>" hidden>
                <input type="text" name="active" value="<?=$user['role_id'] > USER ? COMMENT_ACTIVE : COMMENT_NO_ACTIVE?>" hidden>
                <?php if (isset($form['message'])):?>
                    <div class="alert alert-<?= isset($form['error']) && $form['error'] === FORM_SUCCESS ? 'success' : 'danger'?>  alert-dismissible fade show rounded-0" role="alert" tabindex="0" >
                        <?=$form['message']?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                    </div>
                <?php endif?>
                <div class="d-grid justify-content-end">
                    <button class="btn btn-style-3 rounded-0 justify-content-end d-grid justify-content-end" type="submit" name="send" value="yes">Отправить</button>
                </div>
            </form>
        </div>

        <?php if (isset($comments) && count($comments) > 0):?>
            <?php foreach ($comments as $comment):?>
                <div class="row mb-3 g-0">
                    <div class="col-auto pt-2 me-4 mb-4 avatar-thumbnail">
                        <img class="rounded-3 avatar-thumbnail" src="<?=PATH_IMG_USERS . '/' . $comment->img_name?>" alt="ava">
                    </div>
                    <div class="col">
                        <div>
                            <div class="me-2 d-inline-flex"><strong><?=$comment->user_name?></strong></div>
                            <?php if ($comment->active === NO):?>
                                <span class="position-absolute p-1 badge rounded-3 text-style-2 text-bg-style-3">Не проверено модератором</span>
                            <?php endif?>
                            <div class="mb-2 text-style-1 small"><?=date('Зарегистрирован d-m-Y H:i', strtotime($comment->user_created_at))?></div>
                        </div>
                        <div class="mb-2">
                            <?=$comment->text?>
                        </div>
                        <div class="mb-2 text-style-1 small">
                            <i class="bi bi-stopwatch"></i>
                            <?=date('d-m-Y H:i', strtotime($comment->created_at))?>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
        <?php endif?>
    </div>
</div>