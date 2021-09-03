<?php

function nombremes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 0, 2000)); 
 return $nombre;
} 


/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
$this->menu=array(   
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_socios_excel')),
    // array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_socios_word')),
    // array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_socios_pdf')),
);
$lista_mes='';
$datos = ''

?>

<div class="collapse" id="Acordion">
<table class="table-bordered table-responsive table-striped" width="100%">
        <tr>
            <td colspan="2">
               <h3 class="btn-primary text-center ">
                      HISTORIAL DE CONSUMO
                   </h3>
            </td>
        </tr>
        <tr>        
            <td colspan="2">
             
                <?php  $grupo = Grupo::model()->findAllBySql('SELECT * 
									FROM grupo
									WHERE COD_GRUPO >0 and DESCRIPCION != "N/A"');
									foreach ($grupo as $gru)
									{
										echo $gru->DESCRIPCION;
										?>
				 
                <table class="table-hover table table-condensed">
                    <thead class="badge-info">
                        <th>N°</th>
                        <th>MEDIDOR</th>
                        <th>HISTORIAL DE CONSUMO</th>
                        <th>SOCIO</th>
                        <th>CI</th>
                        <th>CELULAR</th>
                        <th>TELÉFONO</th>
                    </thead>
                             <?php 
                             $contador=1;
                             $valor_total=0;
							
                             foreach ($model_socios as $modelo_socio) {
								 $consumos='';
								 if ($gru->COD_GRUPO == $modelo_socio->COD_GRUPO)
								 {
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td>'.$modelo_socio->OBS.'</td>'; // Numero de medidor
                                     echo '<td style="text-align:right;">'; 
                                   // echo $modelo_socio->COD_BARRA.'<br>';
                                          $model_factura_consumo = Factura::model()->findAllBySql('call consultar_historial_consumo('.$modelo_socio->COD_BARRA.')'); //ID de socio medidor
                                           if (isset($model_factura_consumo)) {                                     
										   echo '<table>';
										   echo '<tr>';
										   $promedio = 0;
                                            foreach ($model_factura_consumo as $fac)
                                            {
												echo '<td style="text-align:right;">'; 
													echo nombremes($fac->MES_COBRO).' '.$fac->ANIO_COBRO.' '.' = </td><td><b>'.$fac->CONSUMO_CALCULADO."</b></td><td> <i>m³</i><br>";													
													///////////////////////////////////
													if ($lista_mes == '')
														$lista_mes= $lista_mes.'"'.nombremes($fac->MES_COBRO)." ".$fac->ANIO_COBRO.'"';
													else
														$lista_mes= $lista_mes.', "'.nombremes($fac->MES_COBRO)." ".$fac->ANIO_COBRO.'"';
													
													if ($consumos == '')
														$consumos= $fac->CONSUMO_CALCULADO;
													else
														$consumos= $consumos.', '.$fac->CONSUMO_CALCULADO.'';
													///////////////////////////////////
													
												echo '</td>';
												if ($promedio == 0 )
													$promedio = $fac->CONSUMO_CALCULADO;
												if ($fac->CONSUMO_CALCULADO > 0)
													$promedio = round((($promedio + $fac->CONSUMO_CALCULADO)/2),2);
                                            }
											//Cargando datos
											
											if ($promedio > 50)
											{
												if ($datos == '')
												  $datos = '{ "name": "'.$modelo_socio->APELLIDO.'", "data": ['.$consumos.'] }';
												else
												{ $datos = $datos .', { "name": "'.$modelo_socio->APELLIDO.'", "data": ['.$consumos.'] }';
												}
											}
                                           }
                                           else
                                           {
											echo '<td style="text-align:right;">'; 
												echo "0";
											echo '</td>';
                                           }
                                           echo '</tr>';
										echo '</table>';										   
                                    echo '</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td>'.$modelo_socio->CI.'</td>';                                
                                    echo '<td>'.$modelo_socio->CELULAR.'</td>';     
                                    echo '<td>'.$modelo_socio->TELEFONO.'</td>';     
                                					 
									
                                 echo "</tr>";
							 } // Fin  si pertenece al grupo
							  } // Fin de todos los socios	
                             ?>  
                </table>
									<?php } // Fin de cada grupo
									?>
            </td>
        </tr>
    </table>
	</div>
	
	 <a class="" data-toggle="collapse" href="#Acordion" aria-expanded="false" aria-controls="Acordion">
        VER MAS DETALLES
    </a>
	
	
	
    <?php 
   /* echo "<br>".$lista_mes;
    echo "<br>"."________________";
    echo "<br>".$datos; */
	
	 $this->Widget('ext.highcharts.HighchartsWidget', array(  
   'options' => '{
	   "scripts" : {
      "highcharts-more",   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
      "modules/exporting", // adds Exporting button/menu to chart
      "themes/grid-light"        // applies global grid theme to all charts
	   },
      "title": { "text": "HISTORIAL DE CONSUMO > 50 m³" },
      "xAxis": {
         "categories": ['.$lista_mes.']
      },
      "yAxis": {
         "title": { "text": "Consumo (m³)" }
      },
      "series": [   '    
       .$datos  
      .' ]
   }'
));
  ?>