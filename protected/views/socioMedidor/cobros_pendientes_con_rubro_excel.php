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
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table border='1px'>
                    <tr bgcolor="#FBD35E">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
						<th style="text-align:center;">DETALLES</th>
                        <th style="text-align:center;">PENDIENTE DE COBRO</th>
                        
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
										$detalles =  explode( ';', $modelo_socio->FOTO );
									echo '<td>';									
									for($i = 0; $i < count($detalles); ++$i) {
										echo "<li>".$detalles[$i].'</li>';
									}
									echo '</td>';  
									$valor = $modelo_socio->COD_USUARIO;
										$valor = number_format($valor, 2, ',', '.');
                                    echo '<td style="text-align:right;">'.$valor.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                  $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                               <tr class="text-info">
                                 <td colspan="5"  style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td  style="text-align:right;">
                                    <b> <?php echo number_format($valor_total, 2, ',', '.'); ?> </b>
                                 </td>
                             </tr>
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
    </table>
