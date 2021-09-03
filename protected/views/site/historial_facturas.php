<meta charset='utf-8'>

         <!-- <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php //echo'<center><img src="' . Yii::app()->baseUrl . '/images/pagina/gota_de_agua.jpg" alt="JURECH" width="50%"  align="center"/><center>';       ?></td>
        
         </tr></table> -->
<div class="col-md-12">
<a href="<?= Yii::app()->homeUrl; ?>">
    <button type="button" class="btn btn-warning"> 
        <center><b> ← Volver</b> </center>
    </button>
</a>
</div>
             <?php
//$meses = array("N/A", "Diciembre", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
//    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre");

$meses = array("N/A", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>

<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><center>
                    SOCIO Nº <?php echo $model->CODIGO; ?>
                </center></h3>
        </div>
        <div class="panel-body">    
            <table width="100%" border="1">

                <tr>
                    <td ><b>Apellidos y Nombres</b></td>
                    <td><?php echo $model->APELLIDO; ?></td>
                </tr>
                <tr>
                    <td><b>CI.</b></td>
                    <td><?php echo $model->CI; ?></td>
                </tr>

            </table> 
        </div>
    </div>
</div>

<!-- HISTORIAL DE CONSUMO -->
<?php ?>

<?php
//Varios medidores
foreach ($socio_medidor as $conexion) {
    $contador_meses = 0;
    $contador_consumos = 0;
    $meses_historial = array();
    $consumo_historial = array();
    $lista_mes = '';
    $consumos = '';
//
//
//
    // historial de Facturas 6 meses atras

    $historial_facturas = Factura::model()->findAllBySql(
            'SELECT f.*
  FROM factura AS f              
  WHERE f.`ID_MEDIDOR_SOCIO` = ' . $conexion->ID . '     
  AND f.`ID` IN (SELECT fac.ID FROM factura AS fac INNER JOIN detalle AS det ON det.`ID_FACTURA` = fac.`ID` 
		WHERE fac.ID_MEDIDOR_SOCIO = ' . $conexion->ID . ' AND det.ESTADO = 1 AND fac.`TIPO` = 1)
  ORDER BY f.ID DESC LIMIT 10;
                ');

//    $historial_facturas = Factura::model()->findAllBySql(
//            'SELECT f.*
//                FROM factura AS f
//                INNER JOIN detalle AS d
//                ON f.`ID` = d.`ID_FACTURA`
//                WHERE f.`ID_MEDIDOR_SOCIO` = ' . $conexion->ID
//            . ' GROUP BY d.`FECHA_COBRO` 
//                ORDER BY d.FECHA_COBRO DESC;
//                ');
    // echo "<h3>" . $conexion->ID . "</h3>";
    ?>


    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><center>
                        HISTORIAL DE FACTURAS MEDIDOR N°: <?php echo $conexion->iDMEDIDOR->NUMERO ?> => <?php echo $conexion->iDMEDIDOR->iDGRUPO->DESCRIPCION ?>
                    </center></h3>
                <?php if ($conexion->INACTIVO == 1) { ?>
                    <h4 class="alert-error text-center">Inactivo</h4>
                <?php } else { ?>
                    <h4 class="alert-info text-center">Activo</h4>
                <?php } ?>
            </div>
            <div class="panel-body">   

                <?php
                foreach ($historial_facturas as $factura) {
                    ?>
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <b class="panel-title text-left"><center>


                                        <a onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"
                                           href='<?php echo Yii:: app()->baseUrl . "/index.php/factura/ver/" . $factura->ID ?>' >
                                            <i class="icon-eye-open"></i>
                                            Emisión N°: <?php echo $factura->ID ?> 
                                        </a>



                                        <br> MES Y ANIO DE COBRO: <?= $meses[$factura->MES_COBRO * 1] . " " . $factura->ANIO_COBRO; ?> 
                                        <br> Consumo de <?= $meses[$factura->MES_COBRO * 1] ?>  <?= $factura->CONSUMO_CALCULADO . ' m³'; ?>  ;  <?= $factura->CONSUMO_ACTUAL . ' m³'; ?> -  <?= $factura->CONSUMO_ANTERIOR . ' m³'; ?>
                                    </center></b>
                            </div>
                            <div class="panel-body"> 
                                <?php
//                                $detalles = Detalle::model()->findAllBySql(" SELECT d.*
//                                            FROM factura AS f
//                                            INNER JOIN detalle AS d
//                                            ON f.`ID` = d.`ID_FACTURA`
//                                            WHERE d.`FACTURA_COBRA` = " . $factura->ID
//                                        . " ORDER BY f.ID DESC; ");
                                $detalles = Detalle::model()->findAllBySql(" SELECT d.*
                                            FROM detalle AS d                                           
                                            WHERE d.`FACTURA_COBRA` = " . $factura->ID
                                        . " ORDER BY d.ID_RUBRO DESC; ");
                                ?>
                                <?php ?>
                                <table class="table table-bordered table-condense table-hover table-responsive table-striped">
                                    <tr class="h3 text-center">
                                        <td>N°</td>
                                        <td>Cantidad</td>
                                        <td>Detalle</td>
                                        <td>V.Unitario</td>
                                        <td>V.Total</td>
                                    </tr>
                                    <?php
                                    $cantidad = 1;
                                    $suma_total = 0;
                                    if ($detalles != "") {
                                        foreach ($detalles as $det) {
                                            ?>
                                            <tr>
                                                <td><?= $cantidad++ ?></td>
                                                <td><?= $det->CANTIDAD ?></td>
                                                <td><?= $det->iDRUBRO->DESCRIPCION ?></td>
                                                <td><?= $det->V_UNITARIO ?></td>
                                                <td><?= $det->V_TOTAL ?></td>
                                            </tr>
                                            <?php
                                            $suma_total = $suma_total + $det->V_TOTAL;
                                        }; // Fin de cada detalle 
                                    };
                                    ?>
                                    <tr>
                                        <td class="text-center h3" colspan="4">
                                            TOTAL
                                        </td>
                                        <td>
                                            <?= $suma_total ?>
                                        </td>
                                    </tr>
                                </table>
                                <b> FECHA DE COBRO: </b> <?= $det->FECHA_COBRO ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } // fin de cada factura
                ?>





                <table class="table table-bordered">

                    <tr class="badge-info">
                        <?php
                        foreach ($historial_facturas as $factura) {
                            //Menorar un mes a la fecha de cobro
                            $actual = strtotime($factura->ANIO_COBRO . '-' . $factura->MES_COBRO . '-' . '1');
                            $mes_un_mes_menos = date("m", strtotime("-1 month", $actual));
                            $anio_un_mes_menos = date("Y", strtotime("-1 month", $actual));



                            echo "<td>";
                          //  echo date('Y-M-d', $actual);
                            echo $meses[$mes_un_mes_menos * 1] . " " . $anio_un_mes_menos;
                            $meses_historial[$contador_meses++] = $meses[$mes_un_mes_menos * 1];
                            if ($lista_mes == '')
                                $lista_mes = $lista_mes . '"' . $meses[$mes_un_mes_menos * 1] . '"';
                            else
                                $lista_mes = $lista_mes . ', "' . $meses[$mes_un_mes_menos * 1] . '"';
                            echo "</td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                        foreach ($historial_facturas as $factura) {
                            echo "<td>";
                            echo $factura->CONSUMO_CALCULADO . ' m³';
                            $consumo_historial[$contador_consumos++] = $factura->CONSUMO_CALCULADO;
                            if ($consumos == '')
                                $consumos = $factura->CONSUMO_CALCULADO;
                            else
                                $consumos = $consumos . ', ' . $factura->CONSUMO_CALCULADO . '';
                        }
                        ?>
                    </tr>

                </table> 


                <?php
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => '{
	   "scripts" : {
      "highcharts-more",   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
      "modules/exporting", // adds Exporting button/menu to chart
      "themes/grid-light"        // applies global grid theme to all charts
	   },
      "title": { "text": "HISTORIAL DE CONSUMO" },
      "xAxis": {
         "categories": [' . $lista_mes . ']
      },
      "yAxis": {
         "title": { "text": "Consumo (m³)" }
      },
      "series": [       
         { "name": "Consumo", "data": [' . $consumos . '] }
      ]
   }'
                ));





                /*
                  $this->widget('ext.highcharts.HighchartsWidget', array(
                  'scripts' => array(
                  'modules/exporting',
                  'themes/grid-light',
                  ),
                  'options' => array(
                  'title' => array(
                  'text' => 'Combination chart',
                  ),
                  'xAxis' => array(
                  'categories' => $meses_historial,
                  ),
                  'labels' => array(
                  'items' => array(
                  array(
                  'html' => 'Total fruit consumption',
                  'style' => array(
                  'left' => '50px',
                  'top' => '18px',
                  'color' => 'js:(Highcharts.theme && Highcharts.theme.textColor) || \'black\'',
                  ),
                  ),
                  ),
                  ),
                  'series' => array(
                  array(
                  'type' => 'column',
                  'name' => 'Consumo',
                  'data' => array($consumos),
                  ),
                  array(
                  'type' => 'column',
                  'name' => 'John',
                  'data' => array(2, 3, 5, 7, 6),
                  ),
                  array(
                  'type' => 'column',
                  'name' => 'Joe',
                  'data' => array(4, 3, 3, 9, 0),
                  ),
                  array(
                  'type' => 'spline',
                  'name' => 'Average',
                  'data' => array(3, 2.67, 3, 6.33, 3.33),
                  'marker' => array(
                  'lineWidth' => 2,
                  'lineColor' => 'js:Highcharts.getOptions().colors[3]',
                  'fillColor' => 'white',
                  ),
                  ),
                  array(
                  'type' => 'pie',
                  'name' => 'Total consumption',
                  'data' => array(
                  array(
                  'name' => 'Jane',
                  'y' => 13,
                  'color' => 'js:Highcharts.getOptions().colors[0]', // Jane's color
                  ),
                  array(
                  'name' => 'John',
                  'y' => 23,
                  'color' => 'js:Highcharts.getOptions().colors[1]', // John's color
                  ),
                  array(
                  'name' => 'Joe',
                  'y' => 19,
                  'color' => 'js:Highcharts.getOptions().colors[2]', // Joe's color
                  ),
                  ),
                  'center' => array(100, 80),
                  'size' => 100,
                  'showInLegend' => false,
                  'dataLabels' => array(
                  'enabled' => false,
                  ),
                  ),
                  ),
                  )
                  )); */
                ?>
            </div>
        </div>
    </div>
    <?php
//Fin de Varios medidores
}
//
?>
<div class="col-md-12">
<a href="<?= Yii::app()->homeUrl; ?>">
    <button type="button" class="btn btn-warning"> 
        <center><b> ← Volver</b> </center>
    </button>
</a>
</div>