<?php
/** @var ReunionController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'CODIGO_REUNION', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->dropDownListRow($model, 'CODIGO_TIPO', CHtml::listData(TipoReunion::model()->findAll(), 'CODIGO_TIPO', TipoReunion::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'HORA_INGRESO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'TIEMPO_ESPERA', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'VALOR_ATRASO', array('class' => 'span5', 'maxlength' => 4)); ?>

<?php echo $form->textFieldRow($model, 'VALOR_FUGA', array('class' => 'span5', 'maxlength' => 4)); ?>

<?php echo $form->textFieldRow($model, 'VALOR_FALTA', array('class' => 'span5', 'maxlength' => 4)); ?>

<?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5', 'maxlength' => 1)); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
