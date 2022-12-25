<?php if (isset($posts) && count($posts) > 0):?>
    <div class="row g-0 m-auto">
        <?php foreach ($posts as $post):?>
            <div class="post row g-0 border shadow">
                <div class="col p-4 position-relative link-style-3">
                    <p class="mb-1 h4"><?=$post->title?></p>
                    <p class="mb-3 text-style-1 small">
                        <i class="bi bi-stopwatch"></i>
                        <?=date('d-m-Y, H:i', strtotime($post->created_at))?>
                    </p>
                    <p class="mb-3"><?=$post->short_text?></p>
                    <p><a href="<?=PATH_POSTS . '/' . $post->id?>" class="stretched-link link-style-1">Читать статью</a></p>
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
