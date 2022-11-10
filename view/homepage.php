<div class="row g-0 m-auto">
    <?php foreach ($posts as $post):?>
        <div class="post row g-0 border shadow">
            <div class="col p-4 position-relative">
                <p class="mb-1 h3"><?=$post->title?></p>
                <p class="mb-3 text-style-1 small">Опубликовано: <?=date('d.m.Y, H:i', strtotime($post->created_at))?></p>
                <p class="mb-3"><?=$post->short_text?></p>
                <p><a href="/posts/<?=$post->id?>" class="stretched-link link-style-1">Читать статью</a></p>
            </div>
            <div class="col-auto d-none d-lg-block align-self-center">
                <img class="post-thumbnail-sm" src="/img/posts/<?=$post->img_name?>" alt="dots icon">
            </div>
        </div>
    <?php endforeach?>
</div>
