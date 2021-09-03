<?php
/** @var DetalleController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'ID_FACTURA', CHtml::listData(Factura::model()->findAll(), 'ID', Factura::representingColumn())); ?>

<?php echo $form->dropDownListRow($model, 'ID_RUBRO', CHtml::listData(Rubro::model()->findAll(), 'ID', Rubro::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'CANTIDAD', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'V_UNITARIO', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'V_TOTAL', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'IVA', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'PORC_MORA', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'VALOR_MORA', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_COBRO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
