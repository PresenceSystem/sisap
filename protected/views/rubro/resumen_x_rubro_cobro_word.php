 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */

$suma_full_realizado = 0;
$suma_full_deuda = 0;
$suma_full_total = 0;
?>

 <h3 class="text-info text-center"> FACTURA </h3>
    <table  border=1 bordercolor="666633">
        <thead>
        <th><center>N°</center></th>
        <th><center>DETALLE</center></th>
		<th><center>COBROS DEL DIA</center></th>		
        
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
					echo "<td> ".CHtml::encode($rubro->DESCRIPCION, array('rubro/view',
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
    <table   border=1 bordercolor="666633">
        <thead>
        <th><center>N°</center></th>
        <th><center>DETALLE</center></th>
		<th><center>COBROS DEL DIA</center></th>
        
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
					echo "<td> ".CHtml::encode($rubro->DESCRIPCION, array('rubro/view',
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
     <table   border=1 bordercolor="666633">
        <thead>
        <th><center>N°</center></th>
        <th><center>DETALLE</center></th>
		<th><center>COBROS DEL DIA</center></th>
        
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
					echo "<td> ".CHtml::encode($rubro->DESCRIPCION, array('rubro/view',
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
