<?php
/** @var DetalleController $this */
/** @var Detalle $model */
$this->breadcrumbs=array(
	'Detalles'=>array('index'),
	$model->ID,
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Detalle::label(2), 'icon' => 'list', 'url' => array('index')),
//  //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Detalle::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    //array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend>
        <h3 class="btn-primary text-center">
            ACCIONES PARA EL DETALLE
        </h3>
    </legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
       // 'ID',
        array(
			'name'=>'ID_FACTURA',
			'value'=>($model->iDFACTURA !== null) ? CHtml::encode($model->iDFACTURA, array('/factura/view', 'ID' => $model->iDFACTURA->ID)).' ' : null,
			'type'=>'html',
		),
        array(
			'name'=>'ID_RUBRO',
			'value'=>($model->iDRUBRO !== null) ? CHtml::encode($model->iDRUBRO, array('/rubro/view', 'ID' => $model->iDRUBRO->ID)).' ' : null,
			'type'=>'html',
		),
        'CANTIDAD',
        'V_UNITARIO',
        'V_TOTAL',
        'IVA',
        'PORC_MORA',
        'VALOR_MORA',
      /*   'FECHA',
        'FECHA_COBRO',
        'ESTADO',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION', */
	),
)); ?>
    
    
    
    <?php if (isset($model_cuotas)) 
    {
        ?>
    
    <div class="btn-primary text-center">
     CUOTAS PARCIALES
    </div>
    <table class="table table-bordered table-condensed table-hover table-responsive">
        <thead>
            <th>N°</th>
            <th>FECHA</th>
            <th>ABONO</th>
            <th>SALDO</th>
        </thead>
   
    <?php 
    $cont=1;
    $sum = 0;
    foreach ($model_cuotas as $det)
      {
         echo '<tr>';
            echo '<td>'.$cont++.'</td>';
            echo '<td>'.$det->FECHA.'</td>';
            echo '<td>'.$det->ABONO.'</td>';
            echo '<td>'.$det->SALDO.'</td>'; 
            $sum = $sum + $det->ABONO;
        echo '</tr>';
      }    
    ?>
        <tr>
            <td colspan="2" class="text-right"><b>TOTAL</b></td>
            <td> <?php echo $sum; ?> </td>
            <td></td>
        </tr>
 </table>
    
    <?php 
    }; //fin si existe cuotas
    ?>
</fieldset>