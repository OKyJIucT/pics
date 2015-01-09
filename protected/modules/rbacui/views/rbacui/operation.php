<?php
/* @var array $operations [] CAuthItem */

$keys = array_keys($operations);
sort($keys);
$options = (count($keys) > 0) ? array_combine($keys, $keys) : array();
?>
<div class="row" style="display:inline-block">
    <div class="col-md-3">
        <?php echo CHtml::dropDownList('operation', '', $options, array('size' => 14, 'style' => 'width:100%;', 'onchange' => 'selectAuthItem(this,"' . $this->createAbsoluteUrl('ajax/infoAuthItem') . '");')); ?>
    </div>
    <div class="col-md-6" id="operation-info">
        <hr>
    </div>
    <div class="col-md-3">
        <?php
        if ($this->isAdmin()):
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'New Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogCreate(0);'));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Change Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogChange(0,"' . $this->createAbsoluteUrl('ajax/getAuthItem') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Delete Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'deleteAuthItem(0,"' . $this->createAbsoluteUrl('ajax/deleteAuthItem') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Attach Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogAttach(0,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
            echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Detach Operation'), array('class' => 'btn btn-success btn-sm', 'onclick' => 'openDialogDetach(0,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
        endif;
        ?>
    </div>
</div>