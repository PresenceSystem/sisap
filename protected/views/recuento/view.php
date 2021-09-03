<?php
/** @var RecuentoController $this */
/** @var Recuento $model */
$this->breadcrumbs=array(
	'Recuentos'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Recuento::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Recuento::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Recuento::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'ID',
        array(
			'name'=>'ID_CAJA',
			'value'=>($model->iDCAJA !== null) ? CHtml::link($model->iDCAJA, array('/caja/view', 'ID' => $model->iDCAJA->ID)).' ' : null,
			'type'=>'html',
		),
        'UNO',
        'CINCO',
        'DIEZ',
        'VIENTICINCO',
        'CINCUENTA',
        'UNO_D',
        'CINCO_D',
        'DIEZ_D',
        'VIENTE_D',
        'CINCUENTA_D',
        'CIEN_D',
        'TOTAL',
        array(
			'name'=>'COD_USUARIO',
			'value'=>($model->cODUSUARIO !== null) ? CHtml::link($model->cODUSUARIO, array('/usuario/view', 'id' => $model->cODUSUARIO->id)).' ' : null,
			'type'=>'html',
		),
        'FECHA_ACTUALIZACION',
	),
)); ?>
</fieldset>