<?php
/** @var RubroController $this */
/** @var Rubro $model */
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	$model->ID,
);


?>

<fieldset>
    <legend class="text-center btn-success"> <?php echo CHtml::encode($model) ?></legend>
    <h2 class="text-center">POR GRUPOS</h2>


</fieldset>
<?php 

if (isset($model_detalles))
{
    $descripcion_compara= $model->DESCRIPCION;
    $descripcion_base_compara = "CONSUMO DE AGUA POTABLE";
    $posicion_encontrada = strpos($descripcion_compara,$descripcion_base_compara);
    //echo $posicion_encontrada;
    if (($posicion_encontrada !== false) and $posicion_encontrada == 0)
    { //consumo de agua potable ...... ....
?>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
     //   'ID',
       // 'DESCRIPCION',
       // 'V_UNITARIO',
       // 'PORCEN',
        'FEC_CREACION',
//            'TIPO',
	),
)); ?>
<table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>ID DETALLE</th>
        <th>GRUPO</th>
        <th>APELLIDOS Y NOMBRES</th>
        <!--<th>CANTIDAD DE TERRENOS</th>-->
        <!--<th>CANTIDAD TOTAL</th>-->
        <th>Anterior</th>
        <th>Actual</th>
        <th>Consumo</th>
        <th>VALOR A PAGAR</th>
		<th>ESTADO</th>
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_valor=0;
            $sumador_consumo=0;
            
            foreach ($model_detalles as $detalle)
            {
			if ($detalle->ESTADO == 1)
			 { echo '<tr>'; $estado='PAGADO'; }
			else
			{ echo '<tr bgcolor="#f9e9b0">'; $estado='EN DEUDA';  }
			
                echo "<td> ".$contador++.' </td>  ';  
			if ($detalle->ESTADO == 0)
			{  echo "<td> ".CHtml::link($detalle->ID, array('detalle/update/',
			'id' => $detalle->ID))."</td>"; }
				else
				{ echo "<td> ".CHtml::encode($detalle->ID, array('detalle/update/',
                    'id' => $detalle->ID))."</td>";
				}				
                echo "<td> ".$detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->grupo->DESCRIPCION.' </td>  '; 
                echo "<td> ".$detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO.' </td>  '; 
                echo "<td> ".$detalle->iDFACTURA->CONSUMO_ANTERIOR.' </td>  '; 
                echo "<td> ".$detalle->iDFACTURA->CONSUMO_ACTUAL.' </td>  '; 
                echo "<td> ".$detalle->iDFACTURA->CONSUMO_CALCULADO.' m³ </td>  '; 
                echo "<td> ".$detalle->V_TOTAL.' </td>  '; 
				echo "<td> ".$estado.' </td>  '; ; 
                $suma_valor = $suma_valor + $detalle->V_TOTAL;
                $sumador_consumo = $sumador_consumo + $detalle->iDFACTURA->CONSUMO_CALCULADO;
              echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="4">TOTAL</td>
                <td><?php echo $sumador_consumo.'' ?></td>
                <td><?php echo $suma_valor.'' ?></td>                
            </tr>
        </tbody>
    </table>
<?php 
    } //Fin consumo de agua potable
    else
    { // Inicia para otros rubros excepto consumo de agua potable
        ?>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
     //   'ID',
       // 'DESCRIPCION',
        'V_UNITARIO',
      //  'PORCEN',
        'FEC_CREACION',
//            'TIPO',
	),
)); ?>
<table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>ID DETALLE</th>
        <th>GRUPO</th>
        <th>APELLIDOS Y NOMBRES</th>
        <!--<th>CANTIDAD DE TERRENOS</th>-->
        <!--<th>CANTIDAD TOTAL</th>-->
        <th>VALOR ($)</th>
		<th>ESTADO</th>
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_valor=0;
            
            foreach ($model_detalles as $detalle)
            { 
			if ($detalle->ESTADO == 1)
			 { echo '<tr>'; $estado='PAGADO'; }
			else
			{ echo '<tr bgcolor="#f9e9b0">'; $estado='EN DEUDA';  }
		  
                echo "<td> ".$contador++.' </td>  ';                 
				if ($detalle->ESTADO == 0)
			{  echo "<td> ".CHtml::link($detalle->ID, array('detalle/update/',
			'id' => $detalle->ID))."</td>"; }
				else
				{ echo "<td> ".CHtml::encode($detalle->ID, array('detalle/update/',
                    'id' => $detalle->ID))."</td>";
				}
                echo "<td> ".$detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->grupo->DESCRIPCION.' </td>  '; 
                echo "<td> ".$detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO.' </td>  '; 
                echo "<td> ".$detalle->V_TOTAL.' </td>  '; 
				echo "<td> ".$estado.' </td>  '; ; 
				
                $suma_valor = $suma_valor + $detalle->V_TOTAL;
              echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="4">TOTAL</td>
                <td><?php echo $suma_valor.'' ?></td>
				
            </tr>
        </tbody>
    </table>
<?php
    } //Fin para otros rubros excepto consumo de agua potable
}; // FIN si existen aplicados al rubro
?>

<br><br><br>
<a href="<?php echo Yii:: app()->baseUrl . '/index.php/rubro/view/'.$model->ID; ?>" class="btn btn-success span" >                   
    TERMINAR
 </a>