<?php
/* @var $this TconvocadoController */
/* @var $model Tconvocado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_CONVOCADO'); ?>
		<?php echo $form->textField($model,'COD_CONVOCADO',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_CONVOCATORIA'); ?>
		<?php echo $form->textField($model,'COD_CONVOCATORIA',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_SOCIO'); ?>
		<?php echo $form->textField($model,'COD_SOCIO'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->