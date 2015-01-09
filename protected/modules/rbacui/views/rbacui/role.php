<?php
/* @var array $roles [] CAuthItem */

$keys = array_keys($roles);
sort($keys);
$options = (count($keys) > 0) ? array_combine($keys, $keys) : array();
?>
<div class="row" style="display:inline-block">
    <div class="col-md-3">
        <?php echo CHtml::dropDownList('role', '', $options, array('size' => 14, 'style' => 'width:100%;', 'onchange' => 'selectAuthItem(this,"' . $this->createAbsoluteUrl('ajax/infoAuthItem') . '");')); ?>
    </div>
    <div class="col-md-6" id="role-info">

    </div>
    <div class="col-md-3">
        <?php
        if ($this->isAdmin()):
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'New Role'), array('class' => 'btn btn-success btn-sm', 'id' => 'btnCreateRole', 'onclick' => 'openDialogCreate(2);'));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Change Role'), array('class' => 'btn btn-success btn-sm', 'id' => 'btnChangeRole', 'onclick' => 'openDialogChange(2,"' . $this->createAbsoluteUrl('ajax/getAuthItem') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Delete Role'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'deleteAuthItem(2,"' . $this->createAbsoluteUrl('ajax/deleteAuthItem') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Attach Role'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAttach(2,2,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Detach Role'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogDetach(2,2,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Attach Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAttach(2,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Detach Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogDetach(2,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Attach Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAttach(2,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Detach Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogDetach(2,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
        endif;
        ?>
    </div>
</div>