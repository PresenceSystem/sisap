<?php
/** @var SocioMedidorController $this */
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'ID', array('class' => 'span5', 'maxlength' => 11)); ?>
 
<?php //echo $form->textFieldRow($model, 'CODIGO_SOCIO', array('class' => 'span5', 'maxlength' => 11)); ?>
<?php echo $form->textFieldRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn())); ?>
<?php //echo $form->textFieldRo(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn()); ?>

<?php echo $form->textFieldRow($model, 'ID_MEDIDOR', CHtml::listData(Medidor::model()->findAll(), 'ID', Medidor::representingColumn())); ?>

<?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
