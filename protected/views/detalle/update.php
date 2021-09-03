<?php
/** @var DetalleController $this */
/** @var Detalle $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('app', $model->ID) => array('view', 'id'=>$model->ID),
	Yii::t('AweCrud.app', 'Update'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Detalle::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Detalle::label(), 'icon' => 'plus', 'url' => array('create')),
	//array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'url'=>array('view', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
	array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend class='btn-primary text-center'> Editando...</legend>
    <?php 
	$this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
       // 'ID',
        array(
			'name'=>'ID_FACTURA',
			'value'=>($model->iDFACTURA !== null) ? CHtml::encode($model->iDFACTURA).' ' : null,
			'type'=>'html',
		),
		array(
			'name'=>'USUARIO',
			'value'=>($model->iDFACTURA !== null) ? CHtml::encode($model->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO).' ' : null,
			'type'=>'html',
		),
        array(
			'name'=>'ID_RUBRO',
			'value'=>($model->iDRUBRO !== null) ? CHtml::encode($model->iDRUBRO).' ' : null,
			'type'=>'html',
		),
		 array(
			'name'=>'SALDO',
			'value'=>($model->iDRUBRO !== null) ? CHtml::encode($model->iDRUBRO->SALDO).' ' : null,
			'type'=>'html',
		),
        'CANTIDAD',
        'V_UNITARIO',
        'V_TOTAL',
       // 'IVA',
       // 'PORC_MORA',
       // 'VALOR_MORA',
      /*   'FECHA',
        'FECHA_COBRO',
        'ESTADO',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION', */
	),
));
	echo $this->renderPartial('_form',array('model' => $model)); ?>
</fieldset>