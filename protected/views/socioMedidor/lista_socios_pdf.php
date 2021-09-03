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
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/abound.css" />'; ?>
    </head>
    <body>
        <!--mpdf
         <htmlpageheader name="myheader">
         <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php echo'<center><img src="images/logo.jpg" alt="JURECH" width="50%"  align="center"/><center>'; ?></td>
        
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

        
        

                <div  class="panel-body alert-info span form-actions" >
                    <h3 class="text-info text-center ">
                       SOCIOS ACTIVOS
                   </h3>
                </div>
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table border=1 width="100%">
                    <tr BGCOLOR="#81DAF5"  colspan="2">
                        <td>N°</td>
                        <td>MEDIDOR</td>
                        <td>SOCIO</td>
                        <td>CI</td>
                        <td>CELULAR</td>
                        <td>TELÉFONO</td>
                    </tr>
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
   

</body>
</html>  