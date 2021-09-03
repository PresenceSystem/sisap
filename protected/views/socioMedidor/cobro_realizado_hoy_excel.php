 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css">
<!--
.xl65
 {mso-style-parent:style0;
 mso-number-format:"\@";
 text-align:right}

-->
</style>
<?php 
 date_default_timezone_set('America/Guayaquil'); //puedes cambiar Guayaquil por tu Ciudad
                                            setlocale(LC_TIME, 'spanish');
                                            $fecha = new DateTime(date('Y-m-d'));
                                            //$fecha->setISODate(2016, 1, 1);
                                            $fecha->modify('-1 month');
                                            $meses = array("N/A","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                                                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
												$aux_mes_anterior = ($fecha->format('m'));
?>
<table>
        <tr>
            <td colspan="2">
               <h3 class="btn-primary text-center ">
                  <center>            Cobro realizado por consumo <?php echo $meses[$aux_mes_anterior * 1] . ' del ' . $fecha->format('Y');  ?>
                  </center> </h3>
            </td>
        </tr>
		<tr>
            <td colspan="2">
               <h4 class="btn-primary text-center ">
                  <center>            Cobro en FACTURA para la Junta Administradora de Agua Potable y Alcantarillado San Vicente de Lacas
                  </center> </h4>
            </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS FACTURA-->
                
                <table border='1px'>
                    <tr bgcolor="#E0FDFD">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">FACTURA N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">VALOR RECAUDADO</th>                       
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios_factura as $modelo_socio) {
                                
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->FOTO.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->CI.'</td>';           
                                    echo '<td style="text-align:right;">'.$modelo_socio->COD_USUARIO.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                 $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                             <tr class="text-info">
                                 <td colspan="5" style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td style="text-align:right;">
                                    <b> <?php echo $valor_total; ?> </b>
                                 </td>
                             </tr>
                </table>
                <!--FIN LISTA DE SOCIOS FACTURA-->
            </td>
        </tr>

        <tr>
            <td colspan="2">
               <h4 class="btn-primary text-center ">
                  <center>            Cobro en RECIBO para la Junta Administradora de Agua Potable y Alcantarillado San Vicente de Lacas
                  </center> </h4>
            </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS RECIBO-->
                
                <table border='1px'>
                    <tr bgcolor="#E0FDFD">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">VALOR RECAUDADO</th>                       
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios_recibo as $modelo_socio) {
                                
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->CI.'</td>';           
                                    echo '<td style="text-align:right;">'.$modelo_socio->COD_USUARIO.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                 $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                             <tr class="text-info">
                                 <td colspan="4" style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td style="text-align:right;">
                                    <b> <?php echo $valor_total; ?> </b>
                                 </td>
                             </tr>
                </table>
                <!--FIN LISTA DE SOCIOS RECIBO-->
            </td>
        </tr>
		
		
		
		<tr>
            <td colspan="2">
               <h4 class="btn-primary text-center ">
                  <center>            Cobro para la comunidad San Vicente de Lacas
                  </center> </h4>
            </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table border='1px'>
                    <tr bgcolor="#F7FAA1">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">VALOR RECAUDADO</th>                       
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios_comunidad as $modelo_socio) {
                                
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td class=xl65>'.$modelo_socio->CI.'</td>';           
                                    echo '<td style="text-align:right;">'.$modelo_socio->COD_USUARIO.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                 $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                             <tr class="text-info">
                                 <td colspan="4" style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td style="text-align:right;">
                                    <b> <?php echo $valor_total; ?> </b>
                                 </td>
                             </tr>
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
    </table>
