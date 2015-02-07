<?php
$this->breadcrumbs = array(
    'Обои по тегу "' . $tag->name . '"',
);
?>
<div class="row">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'ajaxUpdate' => false,
        'template' => "<div class='col-md-12'>{pager}</div><div class='clearfix'></div>{items}<div class='clearfix'></div><div class='col-md-12'>{pager}</div>",
        'pager' => array(
            'maxButtonCount' => '10',
            'prevPageLabel' => '',
            'firstPageLabel' => 'Первая',
            'nextPageLabel' => '',
            'lastPageLabel' => 'Последняя',
            'header' => '',
            'htmlOptions' => array('class' => 'pagination pagination-sm pull-left push-down-20'),
            'firstPageCssClass' => '', //default "first"
            'lastPageCssClass' => '', //default "last"
            'previousPageCssClass' => 'hidden', //default "previours"
            'nextPageCssClass' => 'hidden', //default "next"
            'internalPageCssClass' => '', //default "page"
            'selectedPageCssClass' => 'active', //default "selected"
            'hiddenPageCssClass' => ''//default "hidden"
        ),
    )); ?>
</div>