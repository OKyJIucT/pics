<div class="row">
    <div class="col-md-8">
        <div class="gallery-page-wrap">


            <img
                src="/static/thumbs/<?= date("Y/m/d", $model->date); ?>/<?= $model->file; ?>"
                title="<?= $model->name; ?>"
                alt="<?= $model->name; ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="m8">Добавлено: <?= Y::rus_date('d M в H:i', $model->date); ?></div>
                </div>
                <div class="col-md-6">
                    <div class="m8">Скачать оригинал: <?= $model->width . 'x' . $model->height; ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php
                    $tags = array();
                    foreach ($model->tags as $tag) {
                        $tags[] = '<a href="' . Y::url('/tags/view', array('slug' => $tag->slug)) . '">' . $tag->name . '</a>';
                    }
                    $tags = implode(', ', $tags);
                    ?>
                    <div class="m8"><i class="fa fa-tags"></i> <?= $tags; ?></div>

                </div>
                <div class="col-md-6">
                    <div class="m8">
                        <?php $this->widget('ext.Colors.Color', array('colors' => $model->colors)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        SideBar
    </div>
</div>