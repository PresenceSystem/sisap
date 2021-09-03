<?php
/** @var MedidorController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'NUMERO', array('class' => 'span5', 'maxlength' => 20)); ?>

<?php echo $form->textFieldRow($model, 'CONSUMO_INICIAL', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'ORDEN_RECORIDO', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
