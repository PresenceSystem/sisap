<?php
/** @var ImpresoraController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'COD_IMPRESORA', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'PC', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'IMPRESORA', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'ANCHO', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'ALTO', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'FORMATO', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'MARG_X', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'MARG_y', array('class' => 'span5', 'maxlength' => 5)); ?>

<?php echo $form->textFieldRow($model, 'DOC', array('class' => 'span5', 'maxlength' => 1)); ?>

<?php echo $form->textFieldRow($model, 'JUNTA_LOCAL', array('class' => 'span5', 'maxlength' => 11)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
