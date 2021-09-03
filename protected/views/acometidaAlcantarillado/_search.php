<?php
/** @var AcometidaAlcantarilladoController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'ID_SOCIO_MEDIDOR', CHtml::listData(SocioMedidor::model()->findAll(), 'ID', SocioMedidor::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'ID_GRUPO', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php //echo $form->textFieldRow($model, 'TIPO', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->checkBoxRow($model, 'INACTIVO'); ?>

<?php echo $form->textFieldRow($model, 'INACTIVO_DESCRIPCION', array('class' => 'span5', 'maxlength' => 800)); ?>

<?php echo $form->textFieldRow($model, 'FECHA_INGRESO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_SALIDA', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
