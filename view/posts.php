<?php foreach ($posts as $post):?>
<p>
    Статья <?=$post->id?><br/>
    <?=$post->text?>
</p>
<?php endforeach?>
