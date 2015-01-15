<div class="row">
    <div class="col-md-8">
        <div class="gallery-page-wrap">
            <img
                src="/static/thumbs/<?= date("Y/m/d", $model->date); ?>/<?= $model->file; ?>"
                title="<?= $model->name; ?>"
                alt="<?= $model->name; ?>">

            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <?php
                        foreach ($model->colors as $item) {
                            echo '<div style="background: #' . $item->color . '; width: 20px; height: 30px; margin: 8px 4px; float: left" title="#' . $item->color . '"></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        SideBar
    </div>
</div>