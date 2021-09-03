<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


                <div  class="panel-body alert-info span form-actions" >
                    <h3 class="text-info text-center ">
                       SOCIOS ACTIVOS
                   </h3>
                </div>
           
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table border="2px" width="100%" bgcolor="#FFCC88">
                    <thead class="badge-info">
                        <td>N°</td>
                        <td>MEDIDOR</td>
                        <td>SOCIO</td>
                        <th>CI</th>
                        <th>CELULAR</th>
                        <th>TELÉFONO</th>
                    </thead>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios as $modelo_socio) {
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td>'.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td>'.$modelo_socio->CI.'</td>';                                
                                    echo '<td>'.$modelo_socio->CELULAR.'</td>';     
                                    echo '<td>'.$modelo_socio->TELEFONO.'</td>';     
                                 } // Fin si tiene asistencia
                               
                                 echo "</tr>";
                             ?>  
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
   