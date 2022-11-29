<div class="row g-0">
    <div class="row g-0 mb-4 px-5 py-4 border shadow">
        <p class="h4"><?=$post->title?></p>
        <p class="mb-4 text-style-1 small">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="watch" viewBox="0 0 16 16">
                <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
                <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
            </svg>
            <?=date('d-m-Y H:i', strtotime($post->created_at))?>
        </p>
        <p class="row mb-4 g-0 justify-content-center">
            <img class="post-thumbnail shadow" src="/img/posts/<?=$post->img_name?>" alt="dots icon">
        </p>
        <p class="row mb-3 g-0"><?=$post->text?></p>
    </div>

    <div class="row g-0 mb-4 px-5 py-4 border shadow">
        <div class="row mb-3 text-left h4">Комментарии (<?=count($comments)?>)</div>

        <div class="row mb-3 g-0">
            <div class="col-auto me-4 mb-4 avatar-thumbnail">
                <img class="rounded-3 avatar-thumbnail" src="/img/users/1.jpg" alt="ava">
            </div>
            <form class="col" method="post" action="/posts/<?=$post->id?>">
                <label for="message" class="form-label h4" hidden>Оставить комментарий:</label>
                <textarea class="mb-2 form-control form-style-3 rounded-0 shadow-sm <?= !empty($message) ? 'focus' : ''?> " name="text" id="message" rows="5" placeholder="Введите ваш комментарий"></textarea>
                <input type="text" name="post-id" value="<?=$post->id?>" hidden>
                <input type="text" name="user-id" value="<?=$post->id?>" hidden>
                <?php if (!empty($message)):?>
                    <div class="alert alert-<?=$message['status']?> alert-dismissible fade show rounded-0" role="alert" tabindex="0" >
                        <?=$message['text']?>
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
                        <img class="rounded-3 avatar-thumbnail" src="/img/users/<?=$comment->img_name?>" alt="ava">
                    </div>
                    <div class="col">
                        <div>
                            <div class="me-2 d-inline-flex"><strong><?=$comment->user_name?></strong></div>
                            <?php if ($comment->active === 0):?>
                                <span class="position-absolute p-1 badge rounded-3 text-style-2 text-bg-style-3">Не проверено модератором</span>
                            <?php endif?>
                            <div class="mb-2 text-style-1 small"><?=date('Зарегистрирован d-m-Y H:i', strtotime($comment->user_created_at))?></div>
                        </div>
                        <div class="mb-2">
                            <?=$comment->text?>
                        </div>
                        <div class="mb-2 text-style-1 small">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="watch" viewBox="0 0 16 16">
                                <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
                                <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
                            </svg>
                            <?=date('d-m-Y H:i', strtotime($comment->created_at))?>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
        <?php endif?>
    </div>
</div>