<?php
/** @var CloracionController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'CODIGO', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'LLAVET1', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($model, 'LLAVET2', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($model, 'TANQUE1', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'TANQUE2', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'TANQUE3', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'VALVULA_CL', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'F_CL', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'PH', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'LLAVE_DISTRIBUCION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
