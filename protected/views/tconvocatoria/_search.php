<?php
/** @var TconvocatoriaController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'COD_CONVOCATORIA', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'ENCABEZADO', array('class' => 'span5', 'maxlength' => 1000)); ?>

<?php echo $form->textFieldRow($model, 'TITULO', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($model, 'TIPO', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'FECHA', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

<?php echo $form->textFieldRow($model, 'HORA', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'CUERPO', array('class' => 'span5', 'maxlength' => 500)); ?>

<?php echo $form->textFieldRow($model, 'NOTA', array('class' => 'span5', 'maxlength' => 500)); ?>

<?php echo $form->textFieldRow($model, 'FIRMA', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5', 'maxlength' => 100)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
