<?php if (isset($pages) && count($pages) > 0):?>
    <div class="row g-0 m-auto">
        <?php require 'layout/pagination_header.php';?>
        <?php foreach ($pages as $page):?>
            <div class="post row g-0 border shadow">
                <div class="col p-4 position-relative link-style-3">

                    <p class="mb-1 h4"><?=$page->title?></p>
                    <p class="mb-3 text-style-1 small">
                        <i class="bi bi-stopwatch"></i>
                        <?=date('d-m-Y, H:i', strtotime($page->created_at))?>
                    </p>

                    <div class="row mb-2">
                        <a class="col d-flex link-style-4 justify-content-start align-items-end" href="<?=PATH_ADMIN_PAGES . '/' . $page->id . '/edit'?>">
                            <i class="bi bi-pencil me-1"></i>
                            <span class="text-decoration-underline">Редактировать страницу</span>
                        </a>
                        <form class="col-auto d-flex justify-content-end" method="post" action="<?=PATH_ADMIN_PAGES . '/' . $page->id . '/delete'?>">
                            <input type="text" name="idPage" value="<?=$page->id?>" hidden>
                            <button class="btn btn-style-5 rounded-0" type="submit" name="delete" value="yes">
                                <i class="bi bi-trash me-1"></i>Удалить страницу
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-auto d-none d-lg-block align-self-center">
                    <img class="post-thumbnail-sm" src="<?=PATH_IMG_PAGES . '/' . $page->img_name?>" alt="dots icon">
                </div>
            </div>
        <?php endforeach?>
        <?php require 'layout/pagination_footer.php';?>
    </div>
<?php else:?>
    <div class="row g-0 m-auto">
        <div class="post row g-0">
            <span class="post h3">На данный момент не создано ни одной статичной страницы</span>
        </div>
        <div class="post row g-0 border">
            <div class="col d-flex link-style-3 justify-content-center align-items-center position-relative border shadow">
                <a class="link-style-5 stretched-link" href="<?=PATH_ADMIN_PAGES . '/add'?>">
                    <i class="bi bi-plus-circle h1 me-1"></i>
                    <span class="h1">Создать страницу</span>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block align-self-center border shadow">
                <img class="post-thumbnail-sm" src="<?=PATH_IMG_PAGES . '/' . 'default.jpg'?>" alt="dots icon">
            </div>
        </div>
    </div>
<?php endif?>
