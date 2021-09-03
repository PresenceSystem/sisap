<?php
/** @var MovimientoCajaController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'ID_CAJA', CHtml::listData(Caja::model()->findAll(), 'ID', Caja::representingColumn())); ?>

<?php echo $form->checkBoxRow($model, 'TIPO'); ?>

<?php echo $form->textFieldRow($model, 'VALOR', array('class' => 'span5', 'maxlength' => 8)); ?>

<?php echo $form->textFieldRow($model, 'DESCRIPCION', array('class' => 'span5', 'maxlength' => 3000)); ?>

<?php echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
