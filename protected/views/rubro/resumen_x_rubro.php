<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . NuevoDetalle::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' =>  'APLICAR A TODOS ' , 'icon' => 'icon-ok', 'url' => array('nuevoRubro/aplicar_a_todos_local', 'id' => $model->ID)),
    //    array('label' =>  'QUITAR A TODOS ' , 'icon' => 'icon-ok', 'url' => array('nuevoRubro/quitar_a_todos_local', 'id' => $model->ID)),
       // array('label' =>  'APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('nuevoRubro/aplicar_a_lista_local', 'id' => $model->ID)),
       // array('label' =>  'NO APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('nuevoRubro/no_aplicar_a_lista_local', 'id' => $model->ID)),
);
$suma_full_realizado = 0;
$suma_full_deuda = 0;
$suma_full_total = 0;
?>

 <h3 class="text-info text-center"> FACTURA </h3>
    <table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>DETALLE</th>
		<th>COBROS DEL DIA</th>
		<th>EN DEUDA</th>
		<th>TOTAL</th>
        
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
			if ($rubro->APLICA == 0 and $rubro->TIPO == 1)// and $sum_realizado>0)
				{
				  echo '<tr>';
					echo "<td> ".$contador.' </td>  ';
	//                echo "<td> ".$detalle->ID.' </td>  ';
					echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('rubro/view',
						'id' => $rubro->ID))."</td>";
					
					 echo "<td> ".$sum_realizado.' </td>  ';
					 $suma_total_realizado=$suma_total_realizado+$sum_realizado;
					 // ************* DEUDA
					$detalle_deuda = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 0');
					$sum_deuda=0;
					foreach($detalle_deuda as $det)
					{
						$sum_deuda = $sum_deuda + $det->V_TOTAL;
					}
					 echo "<td> ".$sum_deuda.' </td>  ';
					 $suma_total_deuda=$suma_total_deuda+$sum_deuda;
					 
					//*********************
					$detalle = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID);
					$sum=0;
					foreach($detalle as $det)
					{
						$sum = $sum + $det->V_TOTAL;
					}
					 echo "<td> ".$sum.' </td>  ';
					 $suma_total=$suma_total+$sum;
					$contador = $contador+1;
				  echo '</tr>';
				}
            }
            ?>
            <tr>
                <td colspan="2"><h5>TOTAL</h5></td>
				<td><?php  echo $suma_total_realizado.'' ?></td>
				<td><?php  echo $suma_total_deuda.'' ?></td>
                <td><?php  echo $suma_total.'' ?></td>
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
		<th>EN DEUDA</th>
		<th>TOTAL</th>
        
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
			if ($rubro->APLICA == 0 and $rubro->TIPO == 2) // and $sum_realizado > 0)
				{
				  echo '<tr>';
					echo "<td> ".$contador.' </td>  ';
	//                echo "<td> ".$detalle->ID.' </td>  ';
					echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('rubro/view',
						'id' => $rubro->ID))."</td>";
					
					 echo "<td> ".$sum_realizado.' </td>  ';
					 $suma_total_realizado=$suma_total_realizado+$sum_realizado;
					 // ************* DEUDA
					$detalle_deuda = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 0');
					$sum_deuda=0;
					foreach($detalle_deuda as $det)
					{
						$sum_deuda = $sum_deuda + $det->V_TOTAL;
					}
					 echo "<td> ".$sum_deuda.' </td>  ';
					 $suma_total_deuda=$suma_total_deuda+$sum_deuda;
					 
					//*********************
					$detalle = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID);
					$sum=0;
					foreach($detalle as $det)
					{
						$sum = $sum + $det->V_TOTAL;
					}
					 echo "<td> ".$sum.' </td>  ';
					 $suma_total=$suma_total+$sum;
					$contador = $contador+1;
				  echo '</tr>';
				}
            }
            ?>
            <tr>
                <td colspan="2"><h5>TOTAL</h5></td>
				<td><?php  echo $suma_total_realizado.'' ?></td>
				<td><?php  echo $suma_total_deuda.'' ?></td>
                <td><?php  echo $suma_total.'' ?></td>
            </tr>
        </tbody>
    </table>
	<?php 
$suma_full_deuda = $suma_full_deuda + $suma_total_deuda;
$suma_full_realizado = $suma_full_realizado + $suma_total_realizado;
$suma_full_total = $suma_full_total + $suma_total;
?>
	<h3 class="text-info text-center"> RECIBOS PARA LA COMUNIDAD </h3>
    <table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>DETALLE</th>
		<th>COBROS DEL DIA</th>
		<th>EN DEUDA</th>
		<th>TOTAL</th>
        
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
			if ($rubro->APLICA == 2 and $rubro->TIPO == 2) // and $sum_realizado > 0)
				{
				  echo '<tr>';
					echo "<td> ".$contador.' </td>  ';
	//                echo "<td> ".$detalle->ID.' </td>  ';
					echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('rubro/view',
						'id' => $rubro->ID))."</td>";
					
					 echo "<td> ".$sum_realizado.' </td>  ';
					 $suma_total_realizado=$suma_total_realizado+$sum_realizado;
					 // ************* DEUDA
					$detalle_deuda = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID.' and t.ESTADO = 0');
					$sum_deuda=0;
					foreach($detalle_deuda as $det)
					{
						$sum_deuda = $sum_deuda + $det->V_TOTAL;
					}
					 echo "<td> ".$sum_deuda.' </td>  ';
					 $suma_total_deuda=$suma_total_deuda+$sum_deuda;
					 
					//*********************
					$detalle = Detalle::model()->findAll('t.ID_RUBRO = '.$rubro->ID);
					$sum=0;
					foreach($detalle as $det)
					{
						$sum = $sum + $det->V_TOTAL;
					}
					 echo "<td> ".$sum.' </td>  ';
					 $suma_total=$suma_total+$sum;
					$contador = $contador+1;
				  echo '</tr>';
				}
            }
            ?>
            <tr>
                <td colspan="2"><h5>TOTAL</h5></td>
				<td><?php  echo $suma_total_realizado.'' ?></td>
				<td><?php  echo $suma_total_deuda.'' ?></td>
                <td><?php  echo $suma_total.'' ?></td>
            </tr>
        </tbody>
    </table>
	<?php 
$suma_full_deuda = $suma_full_deuda + $suma_total_deuda;
$suma_full_realizado = $suma_full_realizado + $suma_total_realizado;
$suma_full_total = $suma_full_total + $suma_total;
?>
<div class="badge-success">
	COBRO REALIZADO EL <?php echo DATE('d M Y').' = '.$suma_full_realizado ?>
</div>
<div class="badge-warning">
	DEUDA PENDIENTE = <?php echo $suma_full_deuda ?>
</div>
<div class="badge-info">
	TOTAL (PAGADOS + DEUDORES)= <?php echo $suma_full_total ?>
</div>