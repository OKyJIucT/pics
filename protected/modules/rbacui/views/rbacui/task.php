<?php
/* @var array $tasks [] CAuthItem */

$keys = array_keys($tasks);
sort($keys);
$options = (count($keys) > 0) ? array_combine($keys, $keys) : array();
?>
<div class="row" style="display:inline-block">
    <div class="col-md-3">
        <?php echo CHtml::dropDownList('task', '', $options, array('size' => 14, 'style' => 'width:100%;', 'onchange' => 'selectAuthItem(this,"' . $this->createAbsoluteUrl('ajax/infoAuthItem') . '");')); ?>
    </div>
    <div class="col-md-6" id="task-info">

    </div>
    <div class="col-md-3">
        <?php
        if ($this->isAdmin()):
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'New Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogCreate(1);'));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Change Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogChange(1,"' . $this->createAbsoluteUrl('ajax/getAuthItem') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Delete Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'deleteAuthItem(1,"' . $this->createAbsoluteUrl('ajax/deleteAuthItem') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Attach Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAttach(1,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Detach Task'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogDetach(1,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Attach Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAttach(1,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Detach Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogDetach(1,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
        endif;
        ?>
    </div>
</div>