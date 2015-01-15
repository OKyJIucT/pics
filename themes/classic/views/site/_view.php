<div class="col-xs-12 col-sm-6 col-md-4 img-gallery">
    <div class="gallery-page-wrap">
        <a href="<?= Y::url('/category/image', array('slug' => $data->category->slug, 'id' => $data->id, 'title' => $data->title)); ?>"><img
                src="/static/thumbs/<?= Y::getDir($data->date, 'thubms'); ?>/<?= $data->file; ?>"
                title="<?= $data->name; ?>"
                alt="<?= $data->name; ?>">
        </a>

        <div class="row">
            <div class="col-md-6">
                <div class="m8 mb0 small">
                    <a href="<?= Y::url('/category/view', array('slug' => $data->category->slug)); ?>"><?= $data->category->name; ?></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="m8 mb0 small text-center">
                    <?= Y::rus_date('d M в H:i', $data->date); ?><br/>
                    <?= $data->width; ?>x<?= $data->height; ?>
                </div>
            </div>
        </div>
    </div>
</div>