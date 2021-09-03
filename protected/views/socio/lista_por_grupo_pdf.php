<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
?>
<!DOCTYPE html>

<html lang="es">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/abound.css" />'; ?>
    </head>
    <body>
        <!--mpdf
         <htmlpageheader name="myheader">
         <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php echo'<center><img src="images/logo.jpg" alt="JURECH" width="100%"  align="center"/><center>'; ?></td>
        
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



                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
              <table border=1 width="100%">
                    <tr BGCOLOR="#81DAF5"  colspan="2">
                        <th>N°</th>                        
                        <th>SOCIO</th>
                        <th>CI</th>
                        <th>CELULAR</th>
                        <th>TELÉFONO</th>
                        <th>AGUA P.</th>
                        <th>ALCANT.</th>
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
                                    echo '<td>'.$modelo_socio->CI.'</td>';                                
                                    echo '<td>'.$modelo_socio->CELULAR.'</td>';     
                                    echo '<td>'.$modelo_socio->TELEFONO.'</td>';  
                                    IF ($modelo_socio->USU_AGUA_POTABLE==1)   
                                    { 
									echo'<td><center><img src="images/iconos/visto.jpg" alt="JURECH" width="10px"  align="center"/><center></td>';
									$contador_agua++;
									}
                                     else
                                         echo '<td> </td>'; 
									 
                                    IF ($modelo_socio->USU_ALCANTARILLADO==1)   
									{
										echo'<td><center><img src="images/iconos/visto.jpg" alt="JURECH" width="10px"  align="center"/><center></td>';
										$contador_alcantarillado++;
									}
                                     else
                                        echo '<td> </td>'; 
									
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
echo "<div class='badge badge-success'> <h3>".$suma_totalizado."</h3> SOCIOS DE LA ORGANIZACIÓN</div>";
echo "<div class='badge badge-info'> <h3> ".$suma_totalizado_agua."</h3> SOCIOS DE AGUA POTABLE</div>";
echo "<div class='badge badge-warning'> <h3>".$suma_totalizado_alcantarillado."</h3> SOCIOS DE ALCANTARILLADO</div>";
?>


</body>
</html>  