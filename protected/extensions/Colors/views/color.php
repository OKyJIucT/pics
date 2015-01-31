<?php foreach ($colors as $item) : ?>
    <a href="<?= Y::url('/colors/view', array('color' => $item->color)); ?>">
        <div class="color-item pull-left" style="background: #<?= $item->color; ?>;"
             title="#<?= $item->color; ?>"></div>
    </a>
<?php endforeach; ?>