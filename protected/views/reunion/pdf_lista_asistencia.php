<!DOCTYPE html>

<html lang="es">
    <head>
     
    </head>
    <body>
        <!--mpdf
         <htmlpageheader name="myheader">
         <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php // echo'<img src="' . Yii::app()->baseUrl . '/images/jurech.png" alt="JURECH">'; ?></td>
        
         </tr></table>
         </htmlpageheader>
         
        <htmlpagefooter name="myfooter">
         <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
         Página {PAGENO} de {nb}
         </div>
         </htmlpagefooter>
         
        <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
         <sethtmlpagefooter name="myfooter" value="on" />
        
         mpdf-->

  
    <table border="1" width="100%">
        <tr>
            <td>
                <center>
                 <h3>
                    ASISTENCIA
                 </h3>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <div>
                    <?php
                    echo '<center><b>' . $model_reunion->cODIGOTIPO->TIPO . '</b></center>';
                    setlocale(LC_TIME, "spanish");
                    $dateutf = '<br><b>DIA:</b> ' . (strftime("%A, %d de %B de %Y", strtotime($model_reunion->FECHA)));
                    $dateutf = ucfirst(iconv("ISO-8859-1", "UTF-8", $dateutf));
                    echo $dateutf;
                    echo '<br><b>HORA:</b> ' . $model_reunion->HORA_INGRESO;
                    ?>
                    
                    <!--Pie chart example-->
                        <?php 
                        $asistentes_puntuales=100;
                        $total_asistentes=200;
                        date_default_timezone_set("America/Lima");
                        $fecha_actual = date("Y-n-j");
                        $hora_actual = date("H:i:s");
                        //SOCIOS
                        $model_socios = Socio::model()->findAllBySql('select * from socio where (FECHA_INGRESO <= "'.$model_reunion->FECHA.'" AND ESTADO != 0) group by CI order by APELLIDO');
                        $cuenta_socios_activos=0;
                        foreach ($model_socios as $modelo) {
                            $cuenta_socios_activos++;
                        }
                        //TOAL DE SOCIOS REGISTRADOS INICIALMENTE ESTAN ATRASADOS
                        $asistentes_atrasados=$cuenta_socios_activos;
                        //ASISTENTES A LA REUNION
                        $codigo_de_reunion=$model_reunion->CODIGO_REUNION;
                        $model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$codigo_de_reunion.' group by CODIGO_SOCIO');
                        $cuenta_socios_asistentes_puntuales=0; 
                        $cuenta_socios_asistentes_atrasados=0;
                        $cuenta_socios_fugados=0;
                        $cuenta_socios_con_ingreso_y_salida=0;
                        foreach ($model_asistentes as $modelo_asistencia) {
                            if($modelo_asistencia->REGISTRA_ATRASO==1) //ATRASADOS
                            {
                                $cuenta_socios_asistentes_atrasados++;
                            }   
                         else { //ESTA PUNTUAL
                                $cuenta_socios_asistentes_puntuales++;
                            }    
                          if($modelo_asistencia->REGISTRA_SALIDA_PUNTUAL==0) //ATRASADOS
                            {
                                $cuenta_socios_fugados++;
                            }
                          if(($modelo_asistencia->REGISTRA_INGRESO_PUNTUAL==1 or $modelo_asistencia->REGISTRA_ATRASO==1 ) and $modelo_asistencia->REGISTRA_SALIDA_PUNTUAL==1) //ATRASADOS
                            {
                                $cuenta_socios_con_ingreso_y_salida++;
                            }
                        }
                        //Tiempo maximo de ingreso

                                        $connection = Yii::app()->db;
                                        $sql = "SELECT ADDTIME(HORA_INGRESO, TIEMPO_ESPERA) AS HORA_INGRESO  FROM reunion WHERE `CODIGO_REUNION` = ".$codigo_de_reunion."";
                                        $command = $connection->createCommand($sql);
                                        $rows = $command->execute();
                                        $rows = $command->queryAll();

                                        foreach ($rows as $row) {
                                            $tiempo_maximo=$row['HORA_INGRESO'];
                                            }
                                            $faltantes=$cuenta_socios_activos-($cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados);
                        echo "<br><span>TIEMPO MAXIMO DE ENTRADA PUNTUAL: ".$tiempo_maximo.'</span>';
                        echo "<br><span>TOTAL DE SOCIOS REGISTRADOS EN LA JUNTA: ".$cuenta_socios_activos.' socios</span>';
                        echo "<br><span>".$cuenta_socios_asistentes_puntuales.' PUNTUALES <b>( '.round($cuenta_socios_asistentes_puntuales*100/$cuenta_socios_activos).' % )</b></span>';
                        echo "<br><span>".$cuenta_socios_asistentes_atrasados.' ATRASADOS <b>( '.round($cuenta_socios_asistentes_atrasados*100/$cuenta_socios_activos).' % )</b></span>';
                        $presentes=$cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados;                        
                        echo "<br><span>PUNTUALES + ATRASADOS = ".$presentes.' PRESENTES <b>( '.round($presentes*100/$cuenta_socios_activos).' % )</b> </span>';
                        echo "<br><span> ".$faltantes.' FALTANTES <b>( '.round($faltantes*100/$cuenta_socios_activos).' %)</b></span>';
                        if($presentes != $cuenta_socios_fugados)
                        {
                            echo "<br><span>SOCIOS FUGADOS: ".$cuenta_socios_fugados.'</span>';
                        }
                        ?>
                </div>            
            </td>
            
        </tr>
</table>
       
                
               <table border="1" width="100%">
                    <tr>
                        <td>NUMERO</td>
                        <td>NOMBRE</td>
                        <td>CI</td>
                        <td>HORA DE INGRESO</td>
                        <td>HORA DE SALIDA</td>
                        <td>ASISTENCIA</td>
                        <td>DEUDA (USD)</td>
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios as $modelo_socio) {
                                 echo "<tr>";
                                 $modelo_asistente = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$codigo_de_reunion.' and CODIGO_SOCIO = '.$modelo_socio->CODIGO.' group by CODIGO_ASISTENCIA order by CODIGO_ASISTENCIA asc limit 1;');
                                 $bandera=0;
                                  $valor=0;
                                 foreach ($modelo_asistente as $modelo){                                   
                                    $bandera=1; //ya se imprimio
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td>'.$modelo->cODIGOSOCIO->APELLIDO.'</td>';
                                    echo '<td>'.$modelo->cODIGOSOCIO->CI.'</td>';
                                    echo '<td style="text-align:right;">'.$modelo->HORA_INGRESO.'</td>';
                                    echo '<td style="text-align:right;">'.$modelo->HORA_SALIDA.'</td>';
                                    $ASISTENCIA="Puntual";
                                    
                                    if(($modelo->REGISTRA_SALIDA_PUNTUAL==0 and ($model_reunion->ESTADO==2 or $model_reunion->ESTADO==4))
                                            and $modelo->REGISTRA_ATRASO==1)
                                    {
                                        $ASISTENCIA="Atrasado y fuga";
                                        $valor=$valor+$modelo->cODIGOREUNION->VALOR_FUGA;
                                    }
                                    else
                                    {
                                        if($modelo->REGISTRA_ATRASO==1)
                                        {
                                            $ASISTENCIA="Atrasado";
                                            $valor=$modelo->cODIGOREUNION->VALOR_ATRASO;
                                        }
                                        if($modelo->REGISTRA_SALIDA_PUNTUAL==0 and ($model_reunion->ESTADO==2 or $model_reunion->ESTADO==4))
                                        {
                                            $ASISTENCIA="Fuga";
                                            $valor=$valor+$modelo->cODIGOREUNION->VALOR_FUGA;
                                        }
                                    }
                                    echo '<td style="text-align:right;">'.$ASISTENCIA.'</td>';
                                    echo '<td style="text-align:right;">'.$valor.'</td>';                                   
                                 } // Fin si tiene asistencia
                                 if($bandera==0)
                                 {
                                     echo '<td style="text-align:right;">'.$contador++.'</td>';
                                        echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                        echo '<td>'.$modelo_socio->CI.'</td>';
                                        echo '<td style="text-align:right;">N/A</td>';
                                        echo '<td style="text-align:right;">N/A</td>';
                                      $valor=$valor+$model_reunion->VALOR_FALTA;
                                      echo '<td style="text-align:right;">Falta</td>';
                                    echo '<td style="text-align:right;">'.$valor.'</td>';
                                 }
                                  $valor_total=$valor_total+$valor; //Siempre suma
                                 echo "</tr>";
                             }
                             ?>  
                    <tr>
                        <td colspan="6" style="text-align:right;">TOTAL</td>
                        <td style="text-align:right;"><?php echo  $valor_total.' <b>USD</b>'; ?></td>
                    </tr>
                </table>
             
    
<br>
<br>

<br>
<br>

<div>
    <table width="100%" >
        <tr>
            <td align="center"> 
                -------------------------------------------
                <br>       <b> Responsable </b><br>
                <?php  echo Yii::app()->getSession()->get('nombre_usuario_sismedic'); ?>
            </td>        
            <td align="center"> 
                -------------------------------------------
                <br> <b> Presidente </b>
                <br>    Sr. Jorge Colcha
            </td>        
        </tr>
    </table>
</div>


</body>
</html> 