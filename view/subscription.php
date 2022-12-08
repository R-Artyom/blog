<div class="row d-flex form-thumbnail m-auto border shadow">
    <?php if (isset($form['message'])):?>
        <div class="py-3 px-4 m-auto alert alert-<?= isset($form['error']) && $form['error'] === FORM_SUCCESS ? 'success' : 'danger'?> alert-dismissible fade show rounded-0 text-center" role="alert">
            <?=$form['message']?>
<!--            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>-->
        </div>
    <?php endif?>
</div>
