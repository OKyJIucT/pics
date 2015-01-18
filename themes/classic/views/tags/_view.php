<div class="col-xs-12 col-sm-6 col-md-4 img-gallery">
    <div class="gallery-page-wrap">
        <a href="<?= Y::url('/category/image', array('slug' => $data->image->category->slug, 'id' => $data->image->id, 'title' => $data->image->title)); ?>"><img
                src="/static/thumbs/<?= Y::getDir($data->image->date, 'thubms'); ?>/<?= $data->image->file; ?>"
                title="<?= $data->image->name; ?>"
                alt="<?= $data->image->name; ?>">
        </a>

        <div class="row">
            <div class="col-md-6">
                <div class="m8 mb0 small">
                    <a href="<?= Y::url('/category/view', array('slug' => $data->image->category->slug)); ?>"><?= $data->image->category->name; ?></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="m8 mb0 small text-center">
                    <?= Y::rus_date('d M в H:i', $data->image->date); ?><br/>
                    <?= $data->image->width; ?>x<?= $data->image->height; ?>
                </div>
            </div>
        </div>
    </div>
</div>