<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
$this->menu=array(   
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_socios_excel')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_socios_word')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_socios_pdf')),
);
?>

<?php 
$suma_totalizado=0;
$suma_totalizado_agua=0;
$suma_totalizado_alcantarillado=0;
$consumo_total_grupo=0;
$consumo_total=0;
foreach ($model_grupo as $grupo) {
    echo '<h3 class="btn-primary text-center">';
       echo '<b>GRUPO: '.$grupo->GRUPO.'</b>';
       if ($grupo->DESCRIPCION != '')
         echo ' "'.$grupo->DESCRIPCION.'"';
    echo "</h3>";
	$consumo_total_grupo = 0;
?>

<div class="panel panel-primary">
        <div class="panel-heading text-center">
            LISTA DE MEDIDORES
        </div>
        <div class="panel-body">

                <!--LISTA DE SOCIOS QUE ASISTIERON-->
				
                
                <table class="table-hover table table-condensed table-bordered">
                    <thead class="badge-info">
                        <th>N°</th>
						<th>MEDIDOR</th>
                        <th>RECORRIDO</th>
                        <th>LECTURA ACTUAL</th>
						<th>CONSUMO (m³)</th>
                        <th>SOCIO</th>
                        <th>CI</th>
                    </thead>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios as $modelo_socio) {
								 
								 if($modelo_socio->COD_GRUPO == $grupo->COD_GRUPO)
                                {
									
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
									echo '<td>'.$modelo_socio->OBS.'</td>'; // Numero de medidor
                                    echo '<td>'.$modelo_socio->COD_USUARIO.'</td>'; // Recorrido
                                    echo '<td>';                                     
                                          $model_factura_consumo = Factura::model()->findBySql('call consultar_consumo_actual('.$modelo_socio->COD_BARRA.')'); //ID de socio medidor
                                           if (isset($model_factura_consumo)) {
                                            echo $model_factura_consumo->CONSUMO_ACTUAL;
                                           }
                                           else
                                           {
                                            echo "0";
                                           }
                                            
                                    echo '</td>';
									//Último consumo
									echo '<td>';                                     
                                          $model_factura_consumo = Factura::model()->findBySql('call consultar_consumo_actual('.$modelo_socio->COD_BARRA.')'); //ID de socio medidor
                                           if (isset($model_factura_consumo)) {
                                            echo $model_factura_consumo->CONSUMO_CALCULADO;
											$consumo_total_grupo = $consumo_total_grupo + $model_factura_consumo->CONSUMO_CALCULADO;
                                           }
                                           else
                                           {
                                            echo "0";
                                           }
                                            
                                    echo '</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td>'.$modelo_socio->CI.'</td>';         
								} // Fin si pertenece al grupo       									
                             } // Fin de cada socio                               
                                 echo "</tr>";	
								 echo "<tr class='text-info'>";	
									echo "<td colspan='4'>";	
										echo "CONSUMO TOTAL DEL GRUPO ".$grupo->GRUPO.": ";
										echo "</td>";	
										echo "<td>";	
									 echo "<b>".$consumo_total_grupo." m³</b>";										 
									echo "</td>";	
								 echo "</tr>";	
                             ?>  
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            
		<?php  
														
								 $consumo_total = $consumo_total + $consumo_total_grupo;
		?>
    </div>
</div>	

<?php
} 

//Termina foreach de cada grupo
echo "<div class='badge badge-success'> <h3>CONSUMO TOTAL DE LA ORGANIZACIÓN: ".$consumo_total." m³</h3></div>";

?>