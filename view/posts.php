<div class="row g-0">
    <div class="row g-0 mb-4 px-5 py-4 border shadow">
        <p class="h4"><?=$post->title?></p>
        <p class="mb-4 text-style-1 small"><?=date('d.m.Y H:i', strtotime($post->created_at))?></p>
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
            <form class="col" method="post" action="/posts/<?=$post->id?>/comments/add">
                <label for="message" class="form-label h4" hidden>Оставить комментарий:</label>
                <textarea class="mb-2 form-control form-style-3 rounded-0  shadow-sm" id="message" rows="5" placeholder="Введите ваш комментарий"></textarea>
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
                            <b class="me-2"><?=$comment->user_name?></b>
                            <span class="p-1 text-bg-style-2 text-dark" hidden>Не проверено модератором</span>
                        </div>
                        <div>
                            <?=$comment->text?>
                        </div>
                        <span class="text-style-1 small"><?=date('d.m.Y-H:i:s', strtotime($comment->created_at))?></span>
                    </div>
                </div>
            <?php endforeach?>
        <?php endif?>
    </div>
</div>