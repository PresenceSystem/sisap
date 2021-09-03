<?php
/** @var SocioController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'CODIGO', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'CI', array('class' => 'span5', 'maxlength' => 13)); ?>

<?php echo $form->textFieldRow($model, 'APELLIDO', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'GENERO', array('class' => 'span5', 'maxlength' => 1)); ?>

<?php echo $form->textFieldRow($model, 'COD_BARRA', array('class' => 'span5', 'maxlength' => 15)); ?>

<?php echo $form->textFieldRow($model, 'DIRECCION', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'TELEFONO', array('class' => 'span5', 'maxlength' => 20)); ?>

<?php echo $form->textFieldRow($model, 'CELULAR', array('class' => 'span5', 'maxlength' => 15)); ?>

<?php echo $form->textFieldRow($model, 'EMAIL', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'ESTADO_CIVIL', array('class' => 'span5', 'maxlength' => 15)); ?>

<?php echo $form->textFieldRow($model, 'NOMBRE_CONYUGE', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'FOTO', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'TIPO', array('class' => 'span5', 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'FECHA_NACIMIENTO', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

<?php echo $form->textFieldRow($model, 'OBS', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?> 

<?php echo $form->textFieldRow($model, 'FECHA_INGRESO', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_SALIDA', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

<?php echo $form->checkBoxRow($model, 'USU_AGUA_RIEGO'); ?>

<?php echo $form->checkBoxRow($model, 'USU_AGUA_POTABLE'); ?>

<?php echo $form->textFieldRow($model, 'COD_BARRA_RIEGO_OLD', array('class' => 'span5', 'maxlength' => 15)); ?>

<?php echo $form->textFieldRow($model, 'COD_BARRA_POTABLE', array('class' => 'span5', 'maxlength' => 15)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
