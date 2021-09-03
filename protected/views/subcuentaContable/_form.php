<div class="form">
    <?php
    /** @var SubcuentaContableController $this */
    /** @var SubcuentaContable $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'subcuenta-contable-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
    <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

    <?php echo $form->dropDownListRow($model, 'ID_CUENTA', CHtml::listData(CuentaContable::model()->findAll(), 'ID', 'CUENTA', 'CODIGO')) ?>
    <?php echo $form->textFieldRow($model, 'CODIGO', array('class' => 'span5', 'maxlength' => 50)) ?>
        <?php echo $form->textFieldRow($model, 'SUBCUENTA', array('class' => 'span5', 'maxlength' => 200)) ?>
    <div id='seleccionar_mora'>
        <?php
        echo $form->dropDownListRow($model, 'MORA', array(
            '1' => 'Si',
            '0' => 'No',
        ));
        ?>
    </div>
    <?php //echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
        <?php //echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5'))  ?>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            //'buttonType'=>'submit',
            'label' => Yii::t('AweCrud.app', 'Cancel'),
            'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>
</div>