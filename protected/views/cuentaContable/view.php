<?php
/** @var CuentaContableController $this */
/** @var CuentaContable $model */
$this->breadcrumbs=array(
	'Cuenta Contables'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . CuentaContable::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . CuentaContable::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . CuentaContable::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'ID',
        array(
			'name'=>'ID_GRUPO',
			'value'=>($model->iDGRUPO !== null) ? CHtml::link($model->iDGRUPO, array('/grupoContable/view', 'ID' => $model->iDGRUPO->ID)).' ' : null,
			'type'=>'html',
		),
        'CODIGO',
        'CUENTA',
//        'COD_USUARIO',
        'FECHA',
	),
)); ?>
</fieldset>