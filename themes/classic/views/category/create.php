<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Категория'=>array('index'),
	'Create',
);
?>

<h1 class="text-center">Создать категорию</h1>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>