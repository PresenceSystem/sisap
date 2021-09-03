<?php
/** @var CuotaController $this */
/** @var Cuota $model */
$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Cuota::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Cuota::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Cuota::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'ID',
        array(
			'name'=>'ID_DETALLE',
			'value'=>($model->iDDETALLE !== null) ? CHtml::link($model->iDDETALLE, array('/detalle/view', 'ID' => $model->iDDETALLE->ID)).' ' : null,
			'type'=>'html',
		),
        'FECHA',
        'ABONO',
        'SALDO',
        'OBSERVACION',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
	),
)); ?>
</fieldset>