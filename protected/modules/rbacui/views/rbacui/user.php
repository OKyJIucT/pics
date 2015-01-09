<?php
/* @var $this RbacuiController */
/* @array $users[] User */

?>
<div class="row" style="display:inline-block">
    <div class="col-md-3">

        <?php echo CHtml::textField('search', '', array('style' => 'width:100%;')); ?>

        <?php echo CHtml::dropDownList('user[]', '', CHtml::listData($users, $this->module->userIdColumn, $this->module->userNameColumn),
            array('onchange' => 'selectUser("' . $this->createAbsoluteUrl('ajax/infoUserAssignments') . '");', 'multiple' => true, 'size' => '20', 'style' => 'width:100%;')); ?>

    </div>
    <div class="col-md-6" id="user-info">

    </div>
    <div class="col-md-3">
        <?php
        echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Assign Role'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAssign(2,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
        echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Revoke Role'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogRevoke(2,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
        if ($this->isAdmin() || $this->isAssign()):
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Assign Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAssign(1,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Revoke Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogRevoke(1,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Assign Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAssign(0,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Revoke Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogRevoke(0,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
        endif;
        ?>
    </div>
</div>