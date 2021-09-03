 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css">
<!--
.xl65
 {mso-style-parent:style0;
 mso-number-format:"\@";
 text-align:right}

-->
</style>

<table>
        <tr>
            <td>
               <h3 class="btn-primary text-center ">
                   <center>    Cobros pendientes hasta el mes de <?php echo gmdate('M Y'); ?> </center>
                   </h3>
            </td>
        </tr>
		<tr>
            <td>
               <h4 class="btn-success text-center ">
                  <center>            Junta Administradora de Agua Potable y Alcantarillado San Vicente de Lacas
                  </center> </h4>
            </td>
        </tr>
        <tr>        
            <td>
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table border='1px'>
                    <tr bgcolor="#E0FDFD">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">DEUDA</th>
                        
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios as $modelo_socio) {
                                
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td class=xl65> '.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td class=xl65> '.$modelo_socio->CI.'</td>';   
									$valor = $modelo_socio->COD_USUARIO;
										$valor = number_format($valor, 2, ',', '.');
                                    echo '<td style="text-align:right;">'.$valor.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                  $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                               <tr class="text-info">
                                 <td colspan="4"  style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td  style="text-align:right;">
                                    <b> <?php echo number_format($valor_total, 2, ',', '.'); ?> </b>
                                 </td>
                             </tr>
                </table>              
            </td>
        </tr>
		
		
		<tr>
            <td>
               <h4 class="btn-success text-center ">
                  <center>            Comunidad San Vicente de Lacas
                  </center> </h4>
            </td>
        </tr>
        <tr>        
            <td>
                <table border='1px'>
                    <tr bgcolor="#F7FAA1">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">DEUDA</th>
                        
                    </tr>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios_comunidad as $modelo_socio) {
                                
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td class=xl65> '.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td class=xl65> '.$modelo_socio->CI.'</td>';   
									$valor = $modelo_socio->COD_USUARIO;
										$valor = number_format($valor, 2, ',', '.');
                                    echo '<td style="text-align:right;">'.$valor.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                  $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                               <tr class="text-info">
                                 <td colspan="4"  style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td  style="text-align:right;">
                                    <b> <?php echo number_format($valor_total, 2, ',', '.'); ?> </b>
                                 </td>
                             </tr>
                </table>
            </td>
        </tr>
    </table>
