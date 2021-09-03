
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
    <!--
    .xl65
    {mso-style-parent:style0;
     mso-number-format:"\@";
     text-align:right}

    -->
</style>



<table class="table-bordered table-responsive " width="100%">
    <tr>
        <td colspan="2">
            <h3 class="btn-primary text-center ">
                MESES EN MORA
            </h3>
        </td>
    </tr>
    <tr>        
        <td colspan="2">
            <!--LISTA DE SOCIOS QUE ASISTIERON-->

            <table class="table-hover table table-condensed" BORDER=1>
                <thead bgcolor="#FBD35E">
                <th style="text-align:center;">N°</th>
                <!--<th>GRUPO</th>-->
                <th style="text-align:center;">MEDIDOR</th>
                <th style="text-align:center;">SOCIO</th>
                <th style="text-align:center;">CI</th>
                <th style="text-align:center;">MESES EN MORA</th>
                <th style="text-align:center;">DEUDA</th>                                
                <th style="text-align:center;">FECHA_NACIMIENTO</th>
                <th style="text-align:center;">EDAD</th>
                </thead>
                <?php
                $contador = 1;
                $valor_total = 0;
                $suma_votantes=0;
                $suma_no_votantes=0;
                $bandera_socio_anterior=0;
                foreach ($model_socios as $modelo_socio) {
                    $bandera_vota = 1;
                    /*   $query = 'UPDATE `socio_medidor`
                      SET
                      `INACTIVO` = 1
                      WHERE `ID` =  '.$modelo_socio->FECHA_ACTUALIZACION;
                      $command = Yii::app()->db->createCommand($query);
                      $rowCount=$command->execute(); */
                    if ($modelo_socio->COD_USUARIO > 2) {
                        echo "<tr bgcolor='#FBD35E'>";
                        $bandera_vota = 0;
                    } else {
                        echo "<tr>";                        
                    }
                    if ($bandera_socio_anterior === $modelo_socio->CODIGO){
                    echo '<td bgcolor="aqua" style="text-align:right;">' . $contador++ . '</td>';
                    } else {
                        echo '<td style="text-align:right;">' . $contador++ . '</td>';
                    }
                    //echo '<td>' . $modelo_socio->COD_GRUPO . '</td>';
                    echo '<td class=xl65>' . $modelo_socio->OBS . '</td>'; //Numero de medidor
                    echo '<td>' . $modelo_socio->APELLIDO . '</td>';
                    echo '<td class=xl65>' . $modelo_socio->CI . '</td>';
                    echo '<td>' . $modelo_socio->COD_USUARIO . '</td>';   // Meses en mora 
                    echo '<td>' . $modelo_socio->FOTO . '</td>';   // Deuda                    
                    echo '<td class=xl65>' . $modelo_socio->FECHA_NACIMIENTO . '</td>';  
                    $edad = $modelo_socio->FECHA_SALIDA; //Edad del socio
                    if ($edad < 18){
                    echo '<td bgcolor="#FBD35E">' . $edad . '</td>';   
                    $bandera_vota = 0;
                    } else {
                        echo '<td>' . $edad . '</td>';   
                    }
                    $valor_total = $valor_total + $modelo_socio->FOTO;
                    echo "</tr>";
                    if ($bandera_vota == 1 and $bandera_socio_anterior != $modelo_socio->CODIGO){
                        $suma_votantes++;
                    } else {
                        if ($bandera_socio_anterior != $modelo_socio->CODIGO)
                        { $suma_no_votantes++; }
                    }
                    $bandera_socio_anterior = $modelo_socio->CODIGO;
                };
                ?>  
                <tr>
                    <td colspan="5" class="text-right">
                        <b>TOTAL</b>
                    </td>
                    <td><?= $valor_total ?></td>
                </tr>
            </table>
            <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
        </td>
    </tr>
</table>
<div class="panel-info">
    El padrón electoral cuenta con <?= $suma_votantes ?> socios votantes y <?= $suma_no_votantes ?> no votantes.
    <br> Dando un total de <?= $suma_votantes + $suma_no_votantes ?> socios
</div>