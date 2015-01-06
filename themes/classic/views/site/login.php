<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<div class="register">
    <div class="row">

        <div class="col-md-12">
            <div class="lrform">
                <h5>Вход в ваш аккаунт</h5>

                <div class="form">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'login-form',
                        'enableClientValidation' => true,
                        'enableAjaxValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-horizontal'
                        )
                    ));
                    ?>
                    <!-- Username -->
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'username', array('class' => "control-label col-md-3")); ?>
                        <div class="col-md-9">
                            <?php echo $form->textField($model, 'username', array('class' => "form-control")); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'password', array('class' => "control-label col-md-3")); ?>
                        <div class="col-md-9">
                            <?php echo $form->passwordField($model, 'password', array('class' => "form-control")); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-9 col-md-offset-3">
                            <label class="checkbox-inline rememberMe">
                                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                                <?php echo $form->label($model, 'rememberMe'); ?>
                            </label>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-md-9 col-md-offset-3">
                            <?php echo CHtml::submitButton('Войти', array('class' => "btn btn-default")); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                    Нет учетной записи? <a href="register.html">Зарегистрироваться</a>
                </div>
            </div>

        </div>
    </div>
</div>