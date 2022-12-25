<?php if (isset($posts) && count($posts) > 0):?>
    <div class="row g-0 m-auto">
        <div class="post row g-0 justify-content-between">
            <span class="d-flex h4 py-2 w-auto rounded-3 align-items-center"><?=$title?></span>
            <a class="d-flex min-height-55 px-4 py-2 ms-auto me-2 w-auto rounded-3 link-style-3 align-items-center link-style-5 border shadow-sm" href="<?=PATH_ADMIN_POSTS . '/add'?>">
                <i class="bi bi-plus-circle me-1"></i><strong>Добавить статью</strong>
            </a>
            <form class="d-flex min-height-55 px-4 py-2 w-auto rounded-3 border shadow-sm" method="get" action="<?=PATH_ADMIN_POSTS?>">
                <label for="quantity" class="d-flex mb-2 me-3 align-items-end"><strong>Количество записей на странице:</strong></label>
                <div class="d-flex text-style-1 me-3">
                    <select class="form-select form-select-style-1 rounded-0" id="quantity" name="quantity" aria-label="Default select example">
                        <?php foreach (ELEMENTS_PER_PAGE as $value):?>
                            <option <?=$quantity == $value ? 'selected' : ''?> value="<?=$value?>"><?=$value?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="d-flex">
                    <button class="btn btn-style-5 rounded-0" type="submit">Применить</button>
                </div>
            </form>
        </div>

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

        <nav aria-label="Навигация по страницам">
            <ul class="pagination post justify-content-center">
                <?php foreach ($pageButtons as $button => $value): ?>
                    <?php if (isset($value['show'])): ?>
                        <li class="page-item mx-1 ">
                            <a class="page-link page-link-style-1 link-style-1 rounded-0 <?=$value['class']?> <?=$button === 'active' ? 'active' : ''?>"
                                <?php if ($button != 'active' && $button != 'firstSep' && $button != 'lastSep'): ?>
                                    href="<?=PATH_ADMIN_POSTS . '?quantity=' . $quantity . '&page=' . $value['num']?>"
                                <?php endif ?>>
                                <?=$value['text']?>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </nav>

    </div>
<?php else:?>
    <span class="h3">Извините, автор ещё не опубликовал ни одной статьи</span>
<?php endif?>
