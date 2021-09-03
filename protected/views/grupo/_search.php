<?php
/** @var GrupoController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'COD_GRUPO', array('class' => 'span5', 'maxlength' => 2)); ?>

<?php echo $form->textFieldRow($model, 'GRUPO', array('class' => 'span5', 'maxlength' => 2)); ?>

<?php echo $form->textFieldRow($model, 'DESCRIPCION', array('class' => 'span5', 'maxlength' => 50)); ?>



<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
