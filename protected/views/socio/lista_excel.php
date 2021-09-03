<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
    .xl65
    {mso-style-parent:style0;
     mso-number-format:"\@";
     text-align:right}
    </style>
    <?php
    $ano = (date('Y')) * 1;
    $mes = (date('m')) * 1;
    $dia = (date('d')) * 1;
    $diasemana = date('w');
    $diassemanaN = array("Domingo", "Lunes", "Martes", "Miércoles",
        "Jueves", "Viernes", "Sábado");
    $mesesN = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano       " . date('H:i:s');
    ?>


    <table>
        <tr>
            <td colspan='8'>
                Socios de la JAAPA San Vicente de Lacas al <?php echo $fecha_formateada ?>
            </td>
        </tr>
    </table>

    <table border=1>
        <thead class="badge-info">
    <th>N°</th>
    <th>SOCIO</th>
    <th>CI</th>
    <th>CELULAR</th>
    <th>TELÉFONO</th>
  <!--  <th>ESTADO DEL SOCIO</th> -->
    <th>AGUA POTABLE</th>
    <th>ALCANTARILLADO</th>
    <th>MEDIDOR</th>
</thead>
<?php
$contador = 1;
$valor_total = 0;
$contador_agua = 0;
$contador_alcantarillado = 0;
$contador_medidores_agua = 0;
$contador_acometida_alcantarillado = 0;
foreach ($model_socios as $modelo_socio) {
    echo "<tr>";
    echo '<td style="text-align:right;">' . $contador++ . '</td>';
    //   echo '<td>'.$modelo_socio->OBS.'</td>'; // Numero de medidor
    //   echo '<td>';  
    // echo $modelo_socio->COD_BARRA.'<br>';
    /*       $model_factura_consumo = Factura::model()->findBySql('call consultar_consumo_actual('.$modelo_socio->COD_BARRA.')'); //ID de socio medidor
      if (isset($model_factura_consumo)) {
      echo $model_factura_consumo->CONSUMO_ACTUAL;
      }
      else
      {
      echo "0";
      } */

    //  echo '</td>';
    echo '<td>' . $modelo_socio->APELLIDO . '</td>';
    echo '<td class=xl65>' . $modelo_socio->CI . '</td>';
    echo '<td class=xl65>' . $modelo_socio->CELULAR . '</td>';
    echo '<td class=xl65>' . $modelo_socio->TELEFONO . '</td>';
    // echo '<td>'.$modelo_socio->ESTADO.'</td>';   
    $model_socio_medidor = SocioMedidor::model()->findAllBySql('select * from socio_medidor 
									where CODIGO_SOCIO = ' . $modelo_socio->CODIGO . ' AND INACTIVO = 0');
    //Pertenece al agua o alcantarillado
    IF ($modelo_socio->USU_AGUA_POTABLE == 1) {
        IF (count($model_socio_medidor) > 0) {
            $AGUA = '✔';
            $contador_agua++;
        } ELSE {
            $AGUA = '<DIV CLASS="TEXT-warning">✔</DIV>';
        }
    } else
        $AGUA = '';
    echo '<td>' . $AGUA . '</td>';
    IF ($modelo_socio->USU_ALCANTARILLADO == 1) {
        IF (isset($model_acometida_alcantarillado) && COUNT($model_acometida_alcantarillado) > 0) {
            $ALCANTARILLADO = '✔';
            $contador_alcantarillado++;
        } else {
            $ALCANTARILLADO = '<DIV CLASS="TEXT-warning">✔</DIV>';
        }
    } else
        $ALCANTARILLADO = '';
    echo '<td>';

    foreach ($model_socio_medidor as $socio_medidor) {
        $contador_medidores_agua++;
        echo '<p><b>' . $socio_medidor->iDMEDIDOR->iDGRUPO->DESCRIPCION . ': </b>' . $socio_medidor->iDMEDIDOR->NUMERO . '</p>';
    }
    echo '</td>';
    echo '<td>' . $ALCANTARILLADO . '</td>';
    //***************************************************************
    echo '<td>';
    if (isset($model_acometida_alcantarillado)) {
        foreach ($model_acometida_alcantarillado as $alcantarillado) {
            $contador_acometida_alcantarillado++;
            echo '<p><b>' . $alcantarillado->iDSOCIOMEDIDOR->iDMEDIDOR->iDGRUPO->DESCRIPCION . ': </b>' . $alcantarillado->iDSOCIOMEDIDOR->iDMEDIDOR->NUMERO . '</p>';
        }
    }
    //  echo '<br>=== '.$contador_acometida_alcantarillado;
    echo '</td>';
} // Fin socio

echo "</tr>";
echo '<tr>';
echo "<td colspan='5'> <h4>TOTAL</h4></td>";
echo '<td><h4>' . $contador_agua . "</h4></td>";
echo "<td><h4>" . $contador_alcantarillado . "</h4></td>";
echo "</tr>";
?>  
</table>

