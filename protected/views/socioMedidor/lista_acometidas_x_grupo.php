<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
//$this->menu=array(   
//    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_acometidas_excel')),
//    array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_acometidas_word')),
//    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_acometidas_pdf')),
//);
?>

<?php 
$suma_totalizado=0;
$suma_totalizado_agua=0;
$suma_totalizado_alcantarillado=0;
$consumo_total_grupo=0;
$consumo_total=0;
$contador_total_grupos=0;
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
            LISTA DE ACOMETIDAS DE ALCANTARILLADO
        </div>
        <div class="panel-body">

                <!--LISTA DE SOCIOS QUE ASISTIERON-->
				
                
                <table class="table-hover table table-condensed table-bordered">
                    <thead class="badge-info">
                        <th>N°</th>
						<th>MEDIDOR ASOCIADO</th>
                        <th>RECORRIDO</th>                       
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
                                    
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td>'.$modelo_socio->CI.'</td>';         
								} // Fin si pertenece al grupo       									
                             } // Fin de cada socio                               
                                 echo "</tr>";	
								
                             ?>  
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            
		<?php  
														
								 $consumo_total = $consumo_total + $consumo_total_grupo;
                 $contador_total_grupos = $contador_total_grupos + $contador - 1;
               //  ECHO $consumo_total;
		?>
    </div>
</div>	

<?php
} 

//Termina foreach de cada grupo
echo "<div class='badge badge-info'> <h4>LA ORGANIZACIÓN CUENTA CON ".$contador_total_grupos." ACOMETIDAS DE ALCANTARILLADO</h4></div>";

?>