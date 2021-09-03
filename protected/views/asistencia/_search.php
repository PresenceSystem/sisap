<?php
/** @var AsistenciaController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'CODIGO_ASISTENCIA', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn())); ?>

<?php echo $form->dropDownListRow($model, 'CODIGO_REUNION', CHtml::listData(Reunion::model()->findAll(), 'CODIGO_REUNION', Reunion::representingColumn())); ?>

<?php echo $form->datepickerRow($model, 'FECHA', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

<?php echo $form->textFieldRow($model, 'HORA', array('class' => 'span5')); ?>

<?php echo $form->checkBoxRow($model, 'REGISTRA_INGRESO_PUNTUAL'); ?>

<?php echo $form->checkBoxRow($model, 'REGISTRA_ATRASO'); ?>

<?php echo $form->checkBoxRow($model, 'REGISTRA_FUGA'); ?>

<?php echo $form->checkBoxRow($model, 'REGISTRA_SALIDA_PUNTUAL'); ?>

<?php echo $form->textFieldRow($model, 'OBSERVACIONES', array('class' => 'span5', 'maxlength' => 500)); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
