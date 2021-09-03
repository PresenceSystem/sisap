<?php
/** @var ReunionController $this */
/** @var Reunion $model */
$this->breadcrumbs=array(
	'Reunions'=>array('index'),
	$model->CODIGO_REUNION,
);


$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Reunion::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Reunion::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->CODIGO_REUNION)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->CODIGO_REUNION), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('pdf_lista_asistencia', 'id' => $model->CODIGO_REUNION)),
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('excel_lista_asistencia', 'id' => $model->CODIGO_REUNION)),
    array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('word_lista_asistencia', 'id' => $model->CODIGO_REUNION)),
    array('label' => Yii::t('AweCrud.app', 'Lista de faltantes .pdf'), 'icon' => 'pencil', 'url' => array('pdf_lista_faltas', 'id' => $model->CODIGO_REUNION)),
);
?>

<fieldset>    
    <table class="table-bordered table-responsive table-striped" width="100%">
        <tr>
            <td colspan="2">
                 <h3 class="text-info text-center ">
                    ASISTENCIA
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <div class="panel-body alert-info span form-actions">
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
                        echo "<br><span class='text-info'>TIEMPO MAXIMO DE ENTRADA PUNTUAL: ".$tiempo_maximo.'</span>';
                        echo "<br><span class='text-info'>TOTAL DE SOCIOS REGISTRADOS EN LA JUNTA: ".$cuenta_socios_activos.' socios</span>';
                        echo "<br><span class='text-warning'>".$cuenta_socios_asistentes_puntuales.' PUNTUALES <b>( '.round($cuenta_socios_asistentes_puntuales*100/$cuenta_socios_activos).' % )</b></span>';
                        echo "<br><span class='text-error'>".$cuenta_socios_asistentes_atrasados.' ATRASADOS <b>( '.round($cuenta_socios_asistentes_atrasados*100/$cuenta_socios_activos).' % )</b>';
                        ?>							
								<a class='btn' title="Aplicar multa" 
									href="<?php echo Yii:: app()->baseUrl.'/index.php/reunion/aplicar_atraso/'.$model_reunion->CODIGO_REUNION; ?>">
									APLICAR MULTA (Por atraso)
								</a>
						
							<?php
                        echo '</span>';
                        $presentes=$cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados;                        
                        echo "<br><span class='text-success'>PUNTUALES + ATRASADOS = ".$presentes.' PRESENTES <b>( '.round($presentes*100/$cuenta_socios_activos).' % )</b> </span>';
                        echo "<br><span class='text-info'> ".$faltantes.' FALTANTES <b>( '.round($faltantes*100/$cuenta_socios_activos).' %)</b>'
                                ?>							
								<a class='btn' title="Aplicar multa" 
									href="<?php echo Yii:: app()->baseUrl.'/index.php/reunion/aplicar_falta/'.$model_reunion->CODIGO_REUNION; ?>">
									APLICAR MULTA (Por falta)
								</a>
						
							<?php
						echo '</p>';
                        if($presentes != $cuenta_socios_fugados)
                        {
                            echo "<br><span class='text-success'>SOCIOS FUGADOS: ".$cuenta_socios_fugados.'</span>';
                        }
                        ?>
                </div>            
            </td>
            <td>
                <center>
               <?php  
$format_func = <<<EOD
js:function(label, series){
    return '<div style="font-size:25pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';}
EOD;
$this->widget('application.extensions.EFlot.EFlotGraphWidget', 
    array(
        'data'=>array(             
            array('label'=>'Puntuales', 'data'=>$cuenta_socios_asistentes_puntuales),           
            array('label'=>'FALTANTES', 'data'=>$cuenta_socios_activos-($cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados)),
            array('label'=>'Atrasados', 'data'=>$cuenta_socios_asistentes_atrasados),
            
                        
        ),
        'options'=>array(
            'series'=> array('pie'=>array(
                'show'=>true,
                'radius'=> 2/3, //3/4, // 3/4,
                'formatter'=> $format_func,
                ),
            ),
            'legend'=> array('show'=>false),
        ),
        'htmlOptions'=>array('style'=>'width:200px;height:200px;')
    )
);
?>
                    </center>
            </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table class="table-hover table table-condensed">
                    <thead class="badge-info">
                        <th>NUMERO</th>
                        <th>NOMBRE</th>
                        <th>CI</th>
                        <th>HORA DE INGRESO</th>
                        <th>HORA DE SALIDA</th>
                        <th>ASISTENCIA</th>
                        <th>DEUDA (USD)</th>
                    </thead>
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
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
    </table>
    
    
</fieldset>