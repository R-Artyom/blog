<?php if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
    <div class="py-3 px-5 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
        <?=$form['message']?>
    </div>
<?php else:?>
    <div class="row d-flex profile-thumbnail m-auto border shadow">
        <form method="post" class="py-3 px-4 m-auto" enctype="multipart/form-data" action="<?=isset($post) ? PATH_ADMIN_POSTS . '/' . $post->id . '/edit' : PATH_ADMIN_POSTS . '/add'?>">
            <h4 class="mb-3 text-start"><?=$title?></h4>
            <input type="text" name="idPost" value="<?=isset($post) ? $post->id : null?>" hidden>
            <input type="text" name="imgName" value="<?=isset($post) ? $post->img_name : null?>" hidden>
            <p class="mb-2">
                <strong>Фото:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <div class="mb-4 justify-content-center d-flex">
                        <img class="post-thumbnail-sm rounded-3" id="preview" src="<?=isset($post->img_name) ? PATH_IMG_POSTS . '/' . $post->img_name : PATH_IMG_POSTS . '/' . 'default.jpg'?>" alt="Изображение к статье">
                    </div>
                    <div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?=MAX_FILE_SIZE?>">
                        <input class="form-control form-style-3 <?=$form['error'] === FORM_IMAGE ? 'focus' : ''?>" type="file" name="imgName" id="imgName" accept="<?php foreach (ALLOWED_IMG_TYPE as $value):?><?=$value . ','?><?php endforeach ?>"/>
                    </div>
                </label>
                <?php if ($form['error'] === FORM_IMAGE):?>
                    <div class="mt-n1 mb-2 error"><span class="text-danger small"><?=$form['message']?></span></div>
                    <div class="mb-3 no-error" hidden></div>
                <?php else:?>
                    <div class="mb-3 no-error"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>Заголовок:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-3 rounded-0 <?=$form['error'] === FORM_TITLE ? 'focus' : ''?>" name="title" value="<?= $form['title'] ?? ''?>" required>
                    <span class="placeholder-text">Введите заголовок <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_TITLE):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>Краткое описание статьи:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <textarea class="form-control form-style-3 rounded-0 <?=$form['error'] === FORM_SHORT_TEXT ? 'focus' : ''?>" rows="3" maxlength="255" name="shortText" required><?= $form['shortText'] ?? ''?></textarea>
                    <span class="placeholder-text">Введите краткое описание статьи (не более 255 символов) <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_SHORT_TEXT):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <p class="mb-2">
                <strong>Текст статьи:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <textarea class="form-control form-style-3 rounded-0 <?=$form['error'] === FORM_TEXT ? 'focus' : ''?>" rows="10" name="text" required><?= $form['text'] ?? ''?></textarea>
                    <span class="placeholder-text">Введите текст статьи <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_TEXT):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <div class="row mb-3">
                <div class="col d-flex justify-content-start align-items-end">
                    <a class="link-style-4" href="<?=PATH_ADMIN_POSTS?>">
                        <i class="bi bi-box-arrow-left me-1"></i>
                        <span class="text-decoration-underline">Отмена</span>
                    </a>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-style-4 width-200 rounded-0" name="save" value="yes" formnovalidate><?=isset($post->id) ? 'Сохранить изменения' : 'Опубликовать статью'?></button>
                </div>
            </div>

        </form>
    </div>
<?php endif?>

