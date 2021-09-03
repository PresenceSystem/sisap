<?php
/** @var SubcuentaContableController $this */
/** @var SubcuentaContable $model */
$this->breadcrumbs=array(
	'Subcuenta Contables'=>array('index'),
	$model->ID,
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . SubcuentaContable::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . SubcuentaContable::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend class="btn-info text-center"><?= $model->SUBCUENTA ?></legend>

<?php 
/*$this->widget('bootstrap.widgets.TbDetailView',array(
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
)); */
?>
    <table class="table table-condensed table-hover table-responsive table-bordered">
            <thead>
            <th>EMISIÓN N°</th>
            <th>CI</th>
            <th>SOCIO</th>		
            <th>VALOR</th>
            </thead>
            <tbody>
                <?php
               
                $suma = 0;

                
                    $lista_detalles_deuda = Detalle::model()->findAllBySql('SELECT 
  d.`ID`,
  d.`ID_FACTURA`,
  d.`ID_RUBRO`,
  d.`CANTIDAD`,
  d.`V_UNITARIO`,
  SUM(d.`V_TOTAL`) AS V_TOTAL,
  d.`IVA`,
  d.`PORC_MORA`,
  d.`VALOR_MORA`,
  d.`FECHA`,
  d.`FECHA_COBRO`,
  d.`ESTADO`,
  d.`COD_USUARIO`,
  d.`FECHA_ACTUALIZACION`,
  d.`FACTURA_COBRA`
 FROM detalle AS d 
INNER JOIN rubro AS r
ON r.`ID` = d.`ID_RUBRO`
WHERE r.ID_SUBCUENTA = ' . $model->ID
                            . ' AND d.ESTADO = 1 AND r.TIPO = 1 '
                            . ' AND YEAR(d.FECHA_COBRO) = ' . $anio
                            . ' AND MONTH(d.FECHA_COBRO) = ' . $mes
                            . ' AND DAY(d.FECHA_COBRO) = ' . $dia
                            .' group by d.`FACTURA_COBRA`');
                    
                    foreach ($lista_detalles_deuda as $detalle) {
                        echo "<tr>";                    
                        // Existe valores en deuda
                        echo "<td>".CHtml::link($detalle->FACTURA_COBRA , array('factura/view/',
                            'id' => $detalle->FACTURA_COBRA))."</td>";
                        
                        echo "<td>" . $detalle->FACTURA_COBRA . "</td>";
                        echo "<td> " . $detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->CI . "</td>";
                        echo "<td> " . $detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO . "</td>";
//                        $nuevo_parametro = $fecha_parametro_aux.'_'.$subcuenta->ID;
//                        echo "<td>".CHtml::link($subcuenta->SUBCUENTA, array('subcuentaContable/ver/',
//                            'fecha_parametro' => $nuevo_parametro))."</td>";
                        echo "<td>" . $detalle->V_TOTAL . "</td>";
                         
                    $suma = $suma + $detalle->V_TOTAL;                    
                    echo "</tr>";
                    }
                
                ?>
                <tr>
                    <td colspan="4" style="text-align: right;">TOTAL</td>
                    <td><?= $suma ?></td>
                </tr>
            </tbody>
        </table>
</fieldset>