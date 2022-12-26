<div class="row d-flex profile-thumbnail m-auto border shadow">
    <?php if (isset($form['error']) && ($form['error'] === FORM_SUCCESS)):?>
        <div class="py-3 px-4 m-auto alert alert-success alert-dismissible fade show rounded-0 text-center" role="alert">
            <?=$form['message']?>
        </div>
    <?php else:?>
        <form method="post" class="py-3 px-4 m-auto" enctype="multipart/form-data" action="<?=PATH_ADMIN_SETTINGS?>">
            <h4 class="mb-3 text-start"><?=$title?></h4>

            <p class="mb-2">
                <strong><?=$settings->description?>:</strong>
            </p>
            <div>
                <label class="placeholder-box">
                    <input type="text" class="form-control form-style-3 rounded-0 <?=$form['error'] === FORM_VALUE ? 'focus' : ''?>" name="value" value="<?= $form['value'] ?? ''?>" required>
                    <span class="placeholder-text">Введите желаемое количество статей на странице <strong class="text-danger">*</strong></span>
                </label>
                <?php if ($form['error'] === FORM_VALUE):?>
                    <div class="mt-n1 mb-2"><span class="text-danger small"><?=$form['message']?></span></div>
                <?php else:?>
                    <div class="mb-3"></div>
                <?php endif?>
            </div>

            <div class="row mb-3">
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-style-4 width-200 rounded-0" name="save" value="yes" formnovalidate>Сохранить изменения</button>
                </div>
            </div>
        </form>
    <?php endif?>
</div>
