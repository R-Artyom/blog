<nav aria-label="Навигация по страницам">
    <ul class="pagination post justify-content-center">
        <?php foreach ($pageButtons as $button => $value): ?>
            <?php if (isset($value['show'])): ?>
                <li class="page-item mx-1 ">
                    <a class="page-link page-link-style-1 link-style-1 rounded-0 <?=$value['class']?> <?=$button === 'active' ? 'active' : ''?>"
                        <?php if ($button != 'active' && $button != 'firstSep' && $button != 'lastSep'): ?>
                            href="<?=getActiveUrl() . '?quantity=' . $quantity . '&page=' . $value['num']?>"
                        <?php endif ?>>
                        <?=$value['text']?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</nav>
