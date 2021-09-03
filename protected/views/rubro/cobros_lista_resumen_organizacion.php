<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */

?>
 
<h3 class="alert-success text-center"> <?php echo 'FACTURAS<BR>' ?>  </h3>  
  
<table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
            <th>N°</th> 
            <th>RUBRO</th>
            <th>VALOR</th>        
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_valor=0;
            $model_rubro_cobrado = Rubro::model()->findAllBySql('
			SELECT ID,
SUM(d.V_TOTAL) AS V_UNITARIO,
(SELECT r.`DESCRIPCION` FROM `rubro` AS r WHERE r.`ID` =  d.`ID_RUBRO`) AS DESCRIPCION
FROM detalle AS d
WHERE d.ESTADO = 1
AND d.`ID_FACTURA` IN (SELECT ID FROM factura WHERE TIPO = 1)
GROUP BY d.ID_RUBRO'); 
            foreach ($model_rubro_cobrado as $rubro)
            {
                echo '<tr>';
                echo "<td> ".$contador.' </td>  ';
//                echo "<td> ".$rubro->DESCRIPCION.' </td>  '; 
                echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('junta/cobros_lista_comprobantes_pagados_x_rubro',
                    'id' => $rubro->ID))."</td>";
                echo "<td align='rigth'> ".$rubro->V_UNITARIO.' </td>  '; //V_UNITARIO A PAGAR                
                $suma_valor=$suma_valor + $rubro->V_UNITARIO;
                $contador = $contador+1;
              echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="2" align='center'>TOTAL</td>               
                <td class='text-center'><?php echo $suma_valor.'' ?></td>
            </tr>
        </tbody>
    </table>
 

<h3 class="alert-danger text-center"> <?php echo 'RECIBOS<BR>' ?>  </h3>  
 
<table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
            <th>N°</th>
            <th>RUBRO</th>
            <th>VALOR</th>        
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_valor=0;
            $model_rubro_cobrado = Rubro::model()->findAllBySql(
'SELECT ID,
SUM(d.V_TOTAL) AS V_UNITARIO,
(SELECT r.`DESCRIPCION` FROM `rubro` AS r WHERE r.`ID` =  d.`ID_RUBRO`) AS DESCRIPCION
FROM detalle AS d
WHERE d.ESTADO = 1
AND d.`ID_FACTURA` IN (SELECT ID FROM factura WHERE TIPO = 2)
GROUP BY d.ID_RUBRO '); 
             
            foreach ($model_rubro_cobrado as $rubro)
            { echo '<tr>';
                echo "<td> ".$contador.' </td>  ';
//                echo "<td> ".$rubro->RUBRO.' </td>  '; 
                echo "<td> ".CHtml::link($rubro->DESCRIPCION, array('junta/cobros_lista_comprobantes_deuda_x_rubro',
                    'id' => $rubro->ID))."</td>";
                echo "<td align='rigth'> ".$rubro->V_UNITARIO.' </td>  '; //V_UNITARIO A PAGAR                
                $suma_valor=$suma_valor + $rubro->V_UNITARIO;
                $contador = $contador+1;
              echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="2">TOTAL</td>               
                <td align='rigth'><?php echo $suma_valor.'' ?></td>
            </tr>
        </tbody>
    </table>
