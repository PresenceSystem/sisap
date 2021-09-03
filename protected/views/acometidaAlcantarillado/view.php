<?php
/** @var AcometidaAlcantarilladoController $this */
/** @var AcometidaAlcantarillado $model */
$this->breadcrumbs=array(
	'Acometida Alcantarillados'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . AcometidaAlcantarillado::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . AcometidaAlcantarillado::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . AcometidaAlcantarillado::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'ID',
        array(
			'name'=>'ID_SOCIO_MEDIDOR',
			'value'=>($model->iDSOCIOMEDIDOR->ID !== null) ? CHtml::link($model->iDSOCIOMEDIDOR->ID, array('/socioMedidor/view', 'ID' => $model->iDSOCIOMEDIDOR->ID)).' ' : null,
			'type'=>'html',
		),
//             array(
//			'name'=>'ID_MEDIDOR',
//			'value'=>($model->iDMEDIDOR !== null) ? CHtml::link($model->iDMEDIDOR, array('/medidor/view/'. $model->iDMEDIDOR->ID)).' ' : null,
//			'type'=>'html',
//		),
        'ID_GRUPO',
       // 'TIPO',
        array(
                'name'=>'INACTIVO',
                'type'=>'boolean'
            ),
        'INACTIVO_DESCRIPCION',
        'FECHA_INGRESO',
        'FECHA_SALIDA',
	),
)); ?>
</fieldset>