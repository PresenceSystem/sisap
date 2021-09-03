<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 

?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
.xl65
 {mso-style-parent:style0;
 mso-number-format:"\@";
 text-align:right}
</style>
<?php 
$suma_totalizado=0;
$suma_totalizado_agua=0;
$suma_totalizado_alcantarillado=0;
foreach ($model_grupo as $grupo) {
    echo '<h3 class="btn-primary text-center">';
       echo '<b>GRUPO: '.$grupo->GRUPO.'</b>';
       if ($grupo->DESCRIPCION != '')
         echo ' "'.$grupo->DESCRIPCION.'"';
    echo "</h3>";

?>



                
                <table border=1 width="100%">
                    <tr BGCOLOR="#81DAF5"  colspan="2">
                        <th>N°</th>                      
                        <th>SOCIO</th>
                        <th>CI</th>
                        <th>CELULAR</th>
                        <th>TELÉFONO</th>
                        <th>AGUA POTABLE</th>
                        <th>ALCANTARILLADO</th>
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             $contador_agua=0;
                             $contador_alcantarillado=0;
                             foreach ($model_socios as $modelo_socio) {
                                if($modelo_socio->COD_GRUPO == $grupo->COD_GRUPO)
                                {
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';                                 
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->CI.'</td>';                                
                                    echo '<td class=xl65>'.$modelo_socio->CELULAR.'</td>';     
                                    echo '<td class=xl65>'.$modelo_socio->TELEFONO.'</td>';  
                                    IF ($modelo_socio->USU_AGUA_POTABLE==1)   
                                    { $AGUA='✔'; $contador_agua++;
									}
                                     else
                                        $AGUA='';
                                    echo '<td>'.$AGUA.'</td>'; 
                                    IF ($modelo_socio->USU_ALCANTARILLADO==1)   
									{$ALCANTARILLADO='✔'; $contador_alcantarillado++;
									}
                                     else
                                        $ALCANTARILLADO='';  
                                    echo '<td>'.$ALCANTARILLADO.'</td>';                                       
                                 } // Fin si pertenece al grupo                                 
                               
                                 echo "</tr>";
                             } //Fin de cada socio
							     echo '<tr>';
									echo "<td colspan='5'> <h4>TOTAL</h4></td>";											
									echo '<td><h4>'.$contador_agua."</h4></td>";
									echo "<td><h4>".$contador_alcantarillado."</h4></td>";
								 echo "</tr>";
								 $suma_totalizado = $suma_totalizado + $contador;
								 $suma_totalizado_agua = $suma_totalizado_agua + $contador_agua;
								 $suma_totalizado_alcantarillado = $suma_totalizado_alcantarillado + $contador_alcantarillado;   	
                             ?>  
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
          

<?php
} //Termina foreach de cada grupo
echo "<div class='badge badge-success'> <b>".$suma_totalizado."</b> SOCIOS DE LA ORGANIZACIÓN</div>";
echo "<div class='badge badge-info'> <b> ".$suma_totalizado_agua."</b> SOCIOS DE AGUA POTABLE</div>";
echo "<div class='badge badge-warning'> <b>".$suma_totalizado_alcantarillado."</b> SOCIOS DE ALCANTARILLADO</div>";
?>