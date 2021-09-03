<?php
/** @var ImpresionController $this */
/** @var Impresion $model */
$this->breadcrumbs=array(
	'Impresions'=>array('index'),
	$model->COD_IMPRESION,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Impresion::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Impresion::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->COD_IMPRESION)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->COD_IMPRESION), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Impresion::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'COD_IMPRESION',
        'FECHA',
        'COD_USUARIO',
        'COD_RECIBO',
        'COD_IMPRESORA',
        'OBS',
        array(
                'name'=>'TIPO',
                'type'=>'boolean'
            ),
        'COD_JUNTA',
	),
)); ?>
</fieldset>