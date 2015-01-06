<div class="register">
    <div class="row">

        <div class="col-md-12">
            <div class="lrform">
                <h5>Регистрация</h5>

                <div class="form">
                    <!-- Register form (not working)-->
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'users-form',
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

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'username', array('class' => "control-label col-md-3")); ?>
                        <div class="col-md-9">
                            <?php echo $form->textField($model, 'username', array('class' => "form-control")); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'email', array('class' => "control-label col-md-3")); ?>
                        <div class="col-md-9">
                            <?php echo $form->textField($model, 'email', array('class' => "form-control")); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'password', array('class' => "control-label col-md-3")); ?>
                        <div class="col-md-9">
                            <?php echo $form->textField($model, 'password', array('class' => "form-control")); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-md-9 col-md-offset-3">
                            <?php echo CHtml::submitButton('Регистрация', array('class' => "btn btn-default")); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                    Уже зарегистрированы? <a href="/login">Войти</a>
                </div>
            </div>

        </div>
    </div>
</div>