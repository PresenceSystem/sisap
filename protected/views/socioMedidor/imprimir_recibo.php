<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//ES">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 
$url = '../factura';
Yii::app()->clientScript->registerMetaTag("3;url=$url",null,'refresh');
?>


<!--<FRAMESET FRAMEBORDER="yes">-->
<!--<font FACE="times new roman" SIZE=2>-->
        <!--<frame>-->
            <?php // echo '<h4><b>Tiempo aproximado de espera: </b>'.$model->TIEMPO_ESPERA.' minutos</h4> '; ?>
            <center><b>"COMUNIDAD COYOCTOR"</b></center>
            <br>
            <?php // echo '<b>JUNTA LOCAL: </b>'.$model->cODJUNTA->SECTOR_NOMBRE.'<br>'; ?>
            <?php // echo '<b>TURNO: </b>'.$model->TURNO.'  '; ?>
            <?php echo '<b>Recibo N°:</b> '.$un_dato['ID']; ?>
            <?php echo '<br><b>NOMBRE: </b>'.$un_dato['APELLIDO']; ?>
            <?php echo '<br><b>CI: </b>'.$un_dato['CI']; ?>
            <?php $hoy = date("Y-m-d H:i:s");
                echo '<br><b>FECHA: </b>'.$hoy; ?>
        <!--</frame>-->
             <table border="1" width="100%">
                <thead>
                <th>CANT.</th>
                <th>DESCRIPCIÓN</th>                
                <th>V.U.</th>
                <th>V.T.</th>
                </thead>
                <tbody>
                    <?php 

                  
                    $suma_valor=0;
                  

                    foreach ($datos as $dato) {
                        if ($dato['TIPO'] == 2) { //RECIBO
                            $model_detalle = Detalle::model()->findByPK($dato['DETALLE_ID']);
                            echo '<tr style="text-align:right">';
                            echo '<td style="font-size:100%">';                           
                              echo $dato['CANTIDAD'] ; //Cantidad                            
                            echo "</td>";
                            echo '<td style="text-align:left">';
                            echo $dato['DESCRIPCION'];
                            echo ' </td>  ';
                            echo '<td>';
                            echo number_format($dato['V_UNITARIO'], 2, ',', '.');
                            echo ' </td>  ';
                            echo '<td>';
                            echo number_format($dato['V_TOTAL'], 2, ',', '.') . ' </td>  ';
                            $suma = $suma_valor + $suma_valor['V_TOTAL'];
                            echo '</tr>';
                        }; //Final de la condicion TIPO=FACTURA
                    }
                    ?>
                    <tr>
                        <td style='text-align:right;' colspan="3">TOTAL</td>
                        <td style='text-align:right;'><?php echo $suma_valor.'' ?></td>
                    </tr>
                </tbody>
            </table>
          <?php   
//          echo "<center><img src='".Yii:: app()->baseUrl . "/images/doc/firma.jpg' width='200px'></img><center>";
//          echo "<center>____________________________<br>";

         ?>
     
    <i>este es un documento sin validez tributaria</i>

