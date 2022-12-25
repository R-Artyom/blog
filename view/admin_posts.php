<?php if (isset($posts) && count($posts) > 0):?>
    <div class="row g-0 m-auto">
        <?php require 'layout/pagination_header.php';?>
        <?php foreach ($posts as $post):?>
            <div class="post row g-0 border shadow">
                <div class="col p-4 position-relative link-style-3">

                    <p class="mb-1 h4"><?=$post->title?></p>
                    <p class="mb-3 text-style-1 small">
                        <i class="bi bi-stopwatch"></i>
                        <?=date('d-m-Y, H:i', strtotime($post->created_at))?>
                    </p>
                    <p class="mb-4"><?=$post->short_text?></p>

                    <div class="row mb-2">
                        <a class="col d-flex link-style-4 justify-content-start align-items-end" href="<?=PATH_ADMIN_POSTS . '/' . $post->id . '/edit'?>">
                            <i class="bi bi-pencil me-1"></i>
                            <span class="text-decoration-underline">Редактировать статью</span>
                        </a>
                        <form class="col-auto d-flex justify-content-end" method="post" action="<?=PATH_ADMIN_POSTS . '/' . $post->id . '/delete'?>">
                            <input type="text" name="idPost" value="<?=$post->id?>" hidden>
                            <button class="btn btn-style-5 rounded-0" type="submit" name="delete" value="yes">
                                <i class="bi bi-trash me-1"></i>Удалить статью
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-auto d-none d-lg-block align-self-center">
                    <img class="post-thumbnail-sm" src="<?=PATH_IMG_POSTS . '/' . $post->img_name?>" alt="dots icon">
                </div>
            </div>
        <?php endforeach?>
        <?php require 'layout/pagination_footer.php';?>
    </div>
<?php else:?>
    <span class="h3">Извините, автор ещё не опубликовал ни одной статьи</span>
<?php endif?>
