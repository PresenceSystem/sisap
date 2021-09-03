<div class="form">
    <?php
    /** @var ParametroController $this */
    /** @var Parametro $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'parametro-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
    <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

    <?php echo $form->textFieldRow($model, 'DESCRIPCION', array('class' => 'span5', 'maxlength' => 100)) ?>
    <?php echo $form->textFieldRow($model, 'VALOR', array('class' => 'span5', 'maxlength' => 6)) ?>
    <?php echo $form->textFieldRow($model, 'VALOR_MIN', array('class' => 'span5', 'maxlength' => 6)) ?>
    <?php echo $form->textFieldRow($model, 'VALOR_MAX', array('class' => 'span5', 'maxlength' => 6)) ?>
        <?php echo $form->checkBoxRow($model, 'ESTADO') ?>
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