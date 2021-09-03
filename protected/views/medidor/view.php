<?php
/** @var MedidorController $this */
/** @var Medidor $model */
$this->breadcrumbs=array(
	'Medidors'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Medidor::label(2), 'icon' => 'list', 'url' => array('index')),
   // array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Medidor::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
   // array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>


<fieldset>
    <legend class="btn-primary text-center">MEDIDOR N°:  <?php echo CHtml::encode($model) ?></legend> 

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'ID',
        'NUMERO',
        array(
            'name'=>'ID_GRUPO',
            'value'=>($model->iDGRUPO !== null) ? CHtml::encode($model->iDGRUPO, array('/grupo/view', 'id' => $model->iDGRUPO->COD_GRUPO)).' ' : null,
            'type'=>'html',
        ),
        'CONSUMO_INICIAL',
        'ORDEN_RECORIDO',
	),
)); ?>
</fieldset>