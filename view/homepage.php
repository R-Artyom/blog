<?php if (isset($posts) && count($posts) > 0):?>
    <div class="row g-0 m-auto">
        <?php foreach ($posts as $post):?>
            <div class="post row g-0 border shadow">
                <div class="col p-4 position-relative link-style-3">
                    <p class="mb-1 h4"><?=$post->title?></p>
                    <p class="mb-3 text-style-1 small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
                        </svg>
                        <?=date('d-m-Y, H:i', strtotime($post->created_at))?>
                    </p>
                    <p class="mb-3"><?=$post->short_text?></p>
                    <p><a href="/posts/<?=$post->id?>" class="stretched-link link-style-1">Читать статью</a></p>
                </div>
                <div class="col-auto d-none d-lg-block align-self-center">
                    <img class="post-thumbnail-sm" src="/img/posts/<?=$post->img_name?>" alt="dots icon">
                </div>
            </div>
        <?php endforeach?>
    </div>
<?php else:?>
    <span class="h3">Извините, автор ещё не опубликовал ни одной статьи</span>
<?php endif?>
