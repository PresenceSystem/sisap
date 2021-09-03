<?php
/** @var UsuarioController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'id', array('class' => 'span5', 'maxlength' => 11)); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'nombres', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 250)); ?>

<?php echo $form->textFieldRow($model, 'telefono', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'direccion', array('class' => 'span5', 'maxlength' => 250)); ?>

<?php echo $form->textFieldRow($model, 'foto', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($model, 'id_referencia', array('class' => 'span5')); ?>

<?php echo $form->dropDownListRow($model, 'Rol', CHtml::listData(Rol::model()->findAll(), 'id_rol', Rol::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'codigo_barra', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'descripcion', array('class' => 'span5', 'maxlength' => 500)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
