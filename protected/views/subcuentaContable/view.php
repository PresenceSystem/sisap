<?php
/** @var SubcuentaContableController $this */
/** @var SubcuentaContable $model */
$this->breadcrumbs=array(
	'Subcuenta Contables'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . SubcuentaContable::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . SubcuentaContable::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . SubcuentaContable::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'ID',
        array(
			'name'=>'ID_CUENTA',
			'value'=>($model->iDCUENTA !== null) ? CHtml::link($model->iDCUENTA, array('/cuentaContable/view', 'ID' => $model->iDCUENTA->ID)).' ' : null,
			'type'=>'html',
		),
        'CODIGO',
        'SUBCUENTA',
//        'COD_USUARIO',
        'FECHA',
	),
)); ?>
</fieldset>