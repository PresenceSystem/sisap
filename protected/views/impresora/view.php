<?php
/** @var ImpresoraController $this */
/** @var Impresora $model */
$this->breadcrumbs=array(
	'Impresoras'=>array('index'),
	$model->COD_IMPRESORA,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Impresora::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Impresora::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->COD_IMPRESORA)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->COD_IMPRESORA), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Impresora::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'COD_IMPRESORA',
        'PC',
        'IMPRESORA',
        'ANCHO',
        'ALTO',
        'FORMATO',
        'MARG_X',
        'MARG_y',
        'DOC',
        'JUNTA_LOCAL',
	),
)); ?>
</fieldset>