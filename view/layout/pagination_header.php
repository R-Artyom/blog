<div class="post row g-0 justify-content-between">
    <span class="d-flex h4 py-2 w-auto rounded-3 align-items-center"><?=$title?></span>
    <?php if (getActiveUrl() === PATH_ADMIN_POSTS):?>
        <a class="d-flex min-height-55 px-4 py-2 ms-auto me-2 w-auto rounded-3 link-style-3 align-items-center link-style-5 border shadow-sm" href="<?=PATH_ADMIN_POSTS . '/add'?>">
            <i class="bi bi-plus-circle me-1"></i><strong>Добавить статью</strong>
        </a>
    <?php endif?>
    <?php if (getActiveUrl() === PATH_ADMIN_PAGES):?>
        <a class="d-flex min-height-55 px-4 py-2 ms-auto me-2 w-auto rounded-3 link-style-3 align-items-center link-style-5 border shadow-sm" href="<?=PATH_ADMIN_PAGES . '/add'?>">
            <i class="bi bi-plus-circle me-1"></i><strong>Создать страницу</strong>
        </a>
    <?php endif?>
    <form class="d-flex min-height-55 px-4 py-2 w-auto rounded-3 border shadow-sm" method="get" action="<?=getActiveUrl()?>">
        <label for="quantity" class="d-flex mb-2 me-3 align-items-end"><strong>Количество записей на странице:</strong></label>
        <div class="d-flex text-style-1 me-3">
            <select class="form-select form-select-style-1 rounded-0" id="quantity" name="quantity" aria-label="Default select example">
                <?php foreach (ELEMENTS_PER_PAGE as $value):?>
                    <option <?=$paginator['quantity'] == $value ? 'selected' : ''?> value="<?=$value?>"><?=$value?></option>
                <?php endforeach?>
            </select>
        </div>
        <div class="d-flex">
            <button class="btn btn-style-5 rounded-0" type="submit">Применить</button>
        </div>
    </form>
</div>
