
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
        $fecha_actual = new DateTime(date('Y-m-d'));
        $fecha_proximo_mes = new DateTime(date('Y-m-d'));
        //$fecha->setISODate(2016, 1, 1);
        $fecha_proximo_mes->modify('+1 month');
        $aux_mes_actual = ($fecha_actual->format('m'));
        $aux_mes_siguiente = ($fecha_proximo_mes->format('m'));
        $meses = array("N/A", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        ?>
<?php
$contador = 1;
$valor_total = 0;
foreach ($model_socios as $modelo_socio) {
    if ($modelo_socio->COD_USUARIO >= 3 AND $modelo_socio->ESTADO == 0) {  // El estado es el campo inactivo de socio medidor
//                            echo "<tr>";
//                            echo '<td style="text-align:right;">' . $contador++ . '</td>';
//                            echo '<td class=xl65>' . $modelo_socio->COD_GRUPO . '</td>';
//                            echo '<td class=xl65>' . $modelo_socio->OBS . '</td>';
//                            echo '<td>' . $modelo_socio->APELLIDO . '</td>';
//                            echo '<td class=xl65>' . $modelo_socio->CI . '</td>';
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
        $valor_total = $valor_total + $valor_en_deuda;
        //echo '<td style="text-align:right;">' . $modelo_socio->COD_USUARIO . '</td>';   // Meses en mora 
        //echo '<td style="text-align:right;">' . $modelo_socio->FOTO . '</td>';   // Deuda                                    
        ?>

        <table width="100%">
            <tr>
                <td>
            <center><img src="C:\xampp_2014\htdocs\sisapv_V_2.0\images\doc\encabezado2021.jpg" alt="JAAPS 2021" width="100px"  align="center"/><center> 
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <?= $meses[$aux_mes_actual * 1].' '.$fecha_actual->format('d').', '.$fecha_actual->format('Y') ?>
                            <br>
                            <br><b>Socio:</b> <?= $modelo_socio->APELLIDO ?>
                            <br><b>CI:</b> <?= $modelo_socio->CI ?>
                            <br><b>Grupo:</b> <?= $modelo_socio->COD_GRUPO ?>
                            <br><b>Medidor:</b> <?= $modelo_socio->OBS ?>
                            <br>
                            <br><b>PROPÓSITO: NOTIFICACIÓN POR PAGO ATRASADO</b>
                            <hr>
                            <br><b>Estimado</b> <?= $modelo_socio->APELLIDO ?>;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="text-align: justify">
                            <br>Nuestros informes indican que usted adeuda un pago por la suma de <b><?= $valor_en_deuda ?></b>
                            correspondientes a <b><?= $meses_en_deuda ?></b> meses. 
                            Le agradecemos que el pago lo realice a más tardar el segundo domingo del mes de <?= $meses[$aux_mes_siguiente * 1] ?>  del <?= $fecha_proximo_mes->format('Y') ?> 
                            de 8h00 a 12h00.</p>
                            
                            <p style="text-align: justify">
                            Tenga en cuenta que al incumplir 3 meses de pago se recarga 15 dólares adicionales, 
                            y al incumplir 6 meses se recarga 30 dólares adicionales y el corte del servicio; 
                            estipulado en el Art. 8 del reglamento interno de la Junta administradora de agua potable y saneamiento San Vicente de Lacas.
                            </p>
                            <br>
                            <p>Gracias por su cooperación al respecto.</p>
                            <br>
                             <br>
                            <br>                            
                            <p>Atentamente,</p>
                        </td>
                    </tr>
                    <tr>
                        <td>                                                                 
                            <br>
                            <br> 
                            <p style="text-align: center">______________________ &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; ______________________</p>
                            <p style="text-align: center">Sr. Angel Gunsha &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; Sr. Enrique Moyon</p>
                            <p style="text-align: center"><b>PRESIDENTE</b> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; <b>SECRETARIO</b></p>
                            <br>
                            <br>
                            <br>
                            <p style="text-align: center">______________________ </p>
                            <p style="text-align: center"><?= $modelo_socio->APELLIDO ?></p>
                            <p style="text-align: center"><b>SOCIO</b></p>

                        </td>
                    </tr>
                    </table>

                    <?php
                } // Fin si tiene deuda mas de 3 meses
            } //Fin de cada socio que esta con deuda
            ?> 
                    <!--<tr bgcolor="#FBD35E">-->
                        <!--<td colspan="6" class="text-right text-warning h2">-->
            <!--TOTAL-->
            <!--</td>-->
            <!--<td class="text-warning h2">-->
            <?php //echo $valor_total  ?>
            <!--</td>-->
            <!--</tr>-->

