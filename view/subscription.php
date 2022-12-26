<?php if (isset($form['message'])):?>
    <div class="py-3 px-4 m-auto alert alert-<?= isset($form['error']) && $form['error'] === FORM_SUCCESS ? 'success' : 'danger'?> alert-dismissible fade show rounded-0 text-center" role="alert">
        <?=$form['message']?>
    </div>
<?php endif?>

