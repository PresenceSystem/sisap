
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
    <!--
    .xl65
    {mso-style-parent:style0;
     mso-number-format:"\@";
     text-align:right}

    -->
</style>
<table class="table-bordered table-responsive table-striped">
    <tr>
        <td colspan="2">
    <center>  <h3 class="btn-primary text-center ">
            CORTE DEL SERVICIO DE AGUA POTABLE AL <?php echo date('d/m/Y'); ?>
        </h3>
        </cetner>
        </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS QUE ASISTIERON-->

                <table BORDER=1>
                    <tr bgcolor="#FBD35E">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">GRUPO</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">MESES EN MORA</th>
                        <th style="text-align:center;">DEUDA</th>
                    </tr>
                    <?php
                    $contador = 1;
                    $valor_total = 0;
                    foreach ($model_socios as $modelo_socio) {
                    // $cadena_de_texto = $modelo_socio->OBS;
                    // $cadena_buscada = 'Sin agua potable';
                    // $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
                    // if ($modelo_socio->COD_USUARIO >= 3 and $posicion_coincidencia === false) {
                    if ($modelo_socio->COD_USUARIO >= 3 AND $modelo_socio->ESTADO == 0) {  // El estado es el campo inactivo de socio medidor
                            /*   $query = 'UPDATE `socio_medidor`
                              SET
                              `INACTIVO` = 1
                              WHERE `ID` =  '.$modelo_socio->FECHA_ACTUALIZACION;
                              $command = Yii::app()->db->createCommand($query);
                              $rowCount=$command->execute(); */
                            echo "<tr>";
                            echo '<td style="text-align:right;">' . $contador++ . '</td>';
                            echo '<td class=xl65>' . $modelo_socio->COD_GRUPO . '</td>';
                            echo '<td class=xl65>' . $modelo_socio->OBS . '</td>';
                            echo '<td>' . $modelo_socio->APELLIDO . '</td>';
                            echo '<td class=xl65>' . $modelo_socio->CI . '</td>';
                            // &&&&&&&&&&&&& BUSCAR SI TIENE MEDIDORES INACTIVOS CON DEUDA &&&&&&&&&&
                        $meses_en_deuda = $modelo_socio->COD_USUARIO; // Meses en mora 
                        $valor_en_deuda = $modelo_socio->FOTO; // Deuda
                        foreach ($model_socios as $socio_inactivo) {
                            if ($socio_inactivo->ESTADO == 1
                            AND $modelo_socio->APELLIDO == $socio_inactivo->APELLIDO
                            AND $modelo_socio->CI == $socio_inactivo->CI) {
                                $meses_en_deuda = $meses_en_deuda + $socio_inactivo->COD_USUARIO;
                                $valor_en_deuda = $valor_en_deuda + $socio_inactivo->FOTO;
                            }
                        }
                        // &&&&&&&&& FIN DE BUSCAR SI TIENE MEDIDORES INACTIVOS CON DEUDA &&&&&&&
                        echo '<td>' . $meses_en_deuda . '</td>';   // Meses en mora 
                        echo '<td>' . $valor_en_deuda . '</td>';   // Deuda
                        $valor_total = $valor_total + $valor_en_deuda;
                            //echo '<td style="text-align:right;">' . $modelo_socio->COD_USUARIO . '</td>';   // Meses en mora 
                            //echo '<td style="text-align:right;">' . $modelo_socio->FOTO . '</td>';   // Deuda                                    
                        } // Fin si tiene asistencia                               
                        echo "</tr>";
                    };
                    ?> 
                    <tr bgcolor="#FBD35E">
                        <td colspan="6" class="text-right text-warning h2">
                            TOTAL
                        </td>
                        <td class="text-warning h2">
                            <?= $valor_total ?>
                        </td>
                    </tr>
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
</table>
