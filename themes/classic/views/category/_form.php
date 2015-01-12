<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'category-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal'
    )
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'slug', array('class' => 'col-md-4 control-label')); ?>

        <div class="col-md-8">
            <?php echo $form->textField($model, 'slug', array('size' => 32, 'maxlength' => 32)); ?>
            <?php echo $form->error($model, 'slug'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-4 control-label')); ?>

        <div class="col-md-8">
            <?php echo $form->textField($model, 'name', array('size' => 32, 'maxlength' => 32)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn btn-default')); ?>
            <a href="<?= Y::url('/category/admin'); ?>" class="btn btn-default">Вернуться</a>
        </div>
    </div>

<?php $this->endWidget(); ?>