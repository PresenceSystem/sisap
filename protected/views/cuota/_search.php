<?php
/** @var CuotaController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'ID_DETALLE', CHtml::listData(Detalle::model()->findAll(), 'ID', Detalle::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'ABONO', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'SALDO', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'OBSERVACION', array('class' => 'span5', 'maxlength' => 1000)); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
