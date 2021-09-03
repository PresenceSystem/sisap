<?php
/** @var RecuentoController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'ID_CAJA', CHtml::listData(Caja::model()->findAll(), 'ID', Caja::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'UNO', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'CINCO', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'DIEZ', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'VIENTICINCO', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'CINCUENTA', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'UNO_D', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'CINCO_D', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'DIEZ_D', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'VIENTE_D', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'CINCUENTA_D', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'CIEN_D', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'TOTAL', array('class' => 'span5', 'maxlength' => 7)); ?>

<?php echo $form->dropDownListRow($model, 'COD_USUARIO', CHtml::listData(Usuario::model()->findAll(), 'id', Usuario::representingColumn()), array('prompt' => Yii::t('AweApp', 'None'))); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
