<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' RESUMEN COMPLETO' , 'icon' => 'list', 'url' => array('resumen_x_rubro')),
	array('label' =>  ' Exportar a Word' , 'icon' => 'list', 'url' => array('resumen_x_rubro_cobro_word')),
	//array('label' =>  'APLICAR A TODOS ' , 'icon' => 'icon-ok', 'url' => array('nuevoRubro/aplicar_a_todos_local', 'id' => $model->ID)),
    //    array('label' =>  'QUITAR A TODOS ' , 'icon' => 'icon-ok', 'url' => array('nuevoRubro/quitar_a_todos_local', 'id' => $model->ID)),
       // array('label' =>  'APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('nuevoRubro/aplicar_a_lista_local', 'id' => $model->ID)),
       // array('label' =>  'NO APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('nuevoRubro/no_aplicar_a_lista_local', 'id' => $model->ID)),
);
$suma_full_realizado = 0;
$suma_full_deuda = 0;
$suma_full_total = 0;
echo '<h5 class="text-info">'.DATE('d/M/Y H:i:s').'</h5>'
?>

 <h3 class="text-info text-center"> FACTURA </h3>
    <table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>DETALLE</th>
		<th>COBROS DEL DIA</th>		
        
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_total=0;
			$suma_total_deuda=0;
			$suma_total_realizado=0;
            
            foreach ($model as $rubro)
            {
				// ************* COBRO REALIZADO
				//	$detalle_realizado = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 1');
					$detalle_realizado = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 1'.' and YEAR(t.FECHA_COBRO) = YEAR(CURDATE()) AND MONTH(t.FECHA_COBRO) = MONTH(CURDATE())');
					$sum_realizado=0;
					foreach($detalle_realizado as $det)
					{
						$sum_realizado = $sum_realizado + $det->V_TOTAL;
					}
			if ($rubro->APLICA == 0 and $rubro->TIPO == 1 and $sum_realizado>0)
				{
				  echo '<tr>';
					echo "<td> ".$contador.' </td>  ';
	//                echo "<td> ".$detalle->ID.' </td>  ';
					echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('rubro/view',
						'id' => $rubro->ID))."</td>";
					
					 echo "<td> ".$sum_realizado.' </td>  ';
					 $suma_total_realizado=$suma_total_realizado+$sum_realizado;					
					$contador = $contador+1;
				  echo '</tr>';
				}
				
				 // ************* DEUDA
					$detalle_deuda = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 0');
					$sum_deuda=0;
					foreach($detalle_deuda as $det)
					{
						$sum_deuda = $sum_deuda + $det->V_TOTAL;
					}					 
					 $suma_total_deuda=$suma_total_deuda+$sum_deuda;
					 
					//************* CAPITAL ********
					 $detalle = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID);
					$sum=0;
					foreach($detalle as $det)
					{
						$sum = $sum + $det->V_TOTAL;
					}
					 $suma_total=$suma_total+$sum;
            }
            ?>
            <tr>
                <td colspan="2"><h5>TOTAL</h5></td>
				<td><?php  echo $suma_total_realizado.'' ?></td>
            </tr>
        </tbody>
    </table>
<?php 
$suma_full_deuda = $suma_full_deuda + $suma_total_deuda;
$suma_full_realizado = $suma_full_realizado + $suma_total_realizado;
$suma_full_total = $suma_full_total + $suma_total;
?>
<h3 class="text-info text-center"> RECIBOS PARA LA JAAPA SAN VICENTE DE LACAS </h3>
    <table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>DETALLE</th>
		<th>COBROS DEL DIA</th>
        
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_total=0;
			$suma_total_deuda=0;
			$suma_total_realizado=0;
            
            foreach ($model as $rubro)
            {
				// ************* COBRO REALIZADO
					//$detalle_realizado = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 1');
					$detalle_realizado = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 1'.' and YEAR(t.FECHA_COBRO) = YEAR(CURDATE()) AND MONTH(t.FECHA_COBRO) = MONTH(CURDATE())');
					$sum_realizado=0;
					foreach($detalle_realizado as $det)
					{
						$sum_realizado = $sum_realizado + $det->V_TOTAL;
					}
			if ($rubro->APLICA == 0 and $rubro->TIPO == 2 and $sum_realizado > 0)
				{
				  echo '<tr>';
					echo "<td> ".$contador.' </td>  ';
	//                echo "<td> ".$detalle->ID.' </td>  ';
					echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('rubro/ver',
						'id' => $rubro->ID))."</td>";
					
					 echo "<td> ".$sum_realizado.' </td>  ';
					 $suma_total_realizado=$suma_total_realizado+$sum_realizado;					
					$contador = $contador+1;
				  echo '</tr>';
				}
				 // ************* DEUDA
					$detalle_deuda = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 0');
					$sum_deuda=0;
					foreach($detalle_deuda as $det)
					{
						$sum_deuda = $sum_deuda + $det->V_TOTAL;
					}
					 $suma_total_deuda=$suma_total_deuda+$sum_deuda;
					 
					//*********************
					$detalle = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID);
					$sum=0;
					foreach($detalle as $det)
					{
						$sum = $sum + $det->V_TOTAL;
					}
					 $suma_total=$suma_total+$sum;
            }
            ?>
            <tr>
                <td colspan="2"><h5>TOTAL</h5></td>
				<td><?php  echo $suma_total_realizado.'' ?></td>
            </tr>
        </tbody>
    </table>
	<?php 

$suma_full_realizado = $suma_full_realizado + $suma_total_realizado;

?>
	<h3 class="text-info text-center"> RECIBOS PARA LA COMUNIDAD </h3>
    <table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>DETALLE</th>
		<th>COBROS DEL DIA</th>
        
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_total=0;
			$suma_total_deuda=0;
			$suma_total_realizado=0;
            
            foreach ($model as $rubro)
            {
				// ************* COBRO REALIZADO
					//$detalle_realizado = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 1');
					 $detalle_realizado = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 1'.' and YEAR(t.FECHA_COBRO) = YEAR(CURDATE()) AND MONTH(t.FECHA_COBRO) = MONTH(CURDATE())');
					$sum_realizado=0;
					foreach($detalle_realizado as $det)
					{
						$sum_realizado = $sum_realizado + $det->V_TOTAL;
					}
			if ($rubro->APLICA == 2 and $rubro->TIPO == 2 and $sum_realizado > 0)
				{
				  echo '<tr>';
					echo "<td> ".$contador.' </td>  ';
	//                echo "<td> ".$detalle->ID.' </td>  ';
					echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('rubro/view',
						'id' => $rubro->ID))."</td>";
					
					 echo "<td> ".$sum_realizado.' </td>  ';
					 $suma_total_realizado=$suma_total_realizado+$sum_realizado;
					 
					$contador = $contador+1;
				  echo '</tr>';
				}
				// ************* DEUDA
					$detalle_deuda = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 0');
					$sum_deuda=0;
					foreach($detalle_deuda as $det)
					{
						$sum_deuda = $sum_deuda + $det->V_TOTAL;
					}
					 $suma_total_deuda=$suma_total_deuda+$sum_deuda;
					 
					//*********************
					$detalle = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID);
					$sum=0;
					foreach($detalle as $det)
					{
						$sum = $sum + $det->V_TOTAL;
					}
					 $suma_total=$suma_total+$sum;
            }
            ?>
            <tr>
                <td colspan="2"><h5>TOTAL</h5></td>
				<td><?php  echo $suma_total_realizado.'' ?></td>
            </tr>
        </tbody>
    </table>
	<?php 

$suma_full_realizado = $suma_full_realizado + $suma_total_realizado;

?>
<div class="badge-success">
	COBRO REALIZADO EL <?php echo DATE('d M Y').' = '.$suma_full_realizado.' <b>USD.</b>' ?>
</div>
<div class="badge-warning">	
        <?php 
        $cobros_totalizados = Detalle::model()->findBySql('SELECT
                        SUM(`V_TOTAL`) AS V_TOTAL, MIN(FECHA_COBRO) AS FECHA, MAX(FECHA_COBRO) AS FECHA_COBRO
                      FROM `sisap`.`detalle`
                      WHERE `ESTADO` = 1');
        ?>
    <b>COBROS REALIZADOS</b> = <?php echo $cobros_totalizados->V_TOTAL.' <b>USD.</b>         (DEL:'.$cobros_totalizados->FECHA.' AL:'.$cobros_totalizados->FECHA_COBRO.')' ?>
        <br> <b>CUENTAS POR COBRAR</b> = <?php echo $suma_full_deuda.' <b>USD.</b>' ?>
</div>
<div class="badge-info">
	TOTAL (COBROS REALIZADOS + C. POR COBRAR)= <?php echo $suma_full_total.' <b>USD.</b>' ?>
</div>
