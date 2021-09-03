<?php
/** @var MovimientoCajaController $this */
/** @var MovimientoCaja $model */
$this->breadcrumbs=array(
	'Movimiento Cajas'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . MovimientoCaja::label(2), 'icon' => 'list', 'url' => array('index')),
   // array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . MovimientoCaja::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
  //  array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
   
<div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <?php 
                    if ($model->TIPO == 0)
                    {
                        echo '<h3 class="panel-title"><center>INGRESO</center></h3>';
                    }
                    else
                    {
                        echo '<h3 class="panel-title"><center>EGRESO</center></h3>';
                    }
                    ?>                        
                    </div>
                    <div class="panel-body">  
                        <?php $this->widget('bootstrap.widgets.TbDetailView',array(
                        	'data' => $model,
                        	'attributes' => array(
                              /*  'ID',
                                array(
                        			'name'=>'ID_CAJA',
                        			'value'=>($model->iDCAJA !== null) ? CHtml::link($model->iDCAJA, array('/caja/view', 'ID' => $model->iDCAJA->ID)).' ' : null,
                        			'type'=>'html',
                        		), 
                                array(
                                        'name'=>'TIPO',
                                        'type'=>'boolean'
                                    ), */
                                'VALOR',
                                'DESCRIPCION',
                                'FECHA',
                                //'COD_USUARIO',
                                //'FECHA_ACTUALIZACION',
                        	),
                        )); ?>
                    </div>
                </div>
    </div>
</fieldset>