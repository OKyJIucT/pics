<?php foreach ($colors as $item) : ?>
    <div class="color-item pull-left" style="background: #<?= $item->color; ?>;" title="#<?= $item->color; ?>"></div>
<?php endforeach; ?>