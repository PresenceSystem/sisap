<?php
/** @var FacturaController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'ID_MEDIDOR_SOCIO', CHtml::listData(SocioMedidor::model()->findAll(), 'ID', SocioMedidor::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'CONSUMO_ANTERIOR', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'CONSUMO_ACTUAL', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'CONSUMO_CALCULADO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'MES_COBRO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'ANIO_COBRO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5')); ?>

<?php echo $form->checkBoxRow($model, 'TIPO'); ?>

<?php echo $form->textFieldRow($model, 'NUMERO_FACTURA', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
