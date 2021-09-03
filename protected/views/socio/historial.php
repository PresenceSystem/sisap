<meta charset='utf-8'>

         <!-- <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php //echo'<center><img src="' . Yii::app()->baseUrl . '/images/pagina/gota_de_agua.jpg" alt="JURECH" width="50%"  align="center"/><center>';  ?></td>
        
         </tr></table> -->
<?php
$meses = array("N/A", "Diciembre", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre");
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
    $suma_consumos = 0;
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
    ?>


    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><center>
                        HISTORIAL DE CONSUMO MEDIDOR N°: <?php echo $conexion->iDMEDIDOR->NUMERO ?> GRUPO N°: <?php echo $conexion->iDMEDIDOR->iDGRUPO->DESCRIPCION ?>
                    </center></h3>
                <?php if ($conexion->INACTIVO == 1) { ?>
                <h4 class="alert-error text-center">Inactivo</h4>
                <?php } else { ?>
                <h4 class="alert-info text-center">Activo</h4>
                <?php } ?>
            </div>
            <div class="panel-body">    
                <table class="table table-bordered">

                    <tr class="badge-info">
    <?php
    foreach ($historial_facturas as $factura) {
        echo "<td>";
        echo $meses[$factura->MES_COBRO * 1] . " " . $factura->ANIO_COBRO;
        $meses_historial[$contador_meses++] = $meses[$factura->MES_COBRO * 1];
        if ($lista_mes == '')
            $lista_mes = $lista_mes . '"' . $meses[$factura->MES_COBRO * 1] . '"';
        else
            $lista_mes = $lista_mes . ', "' . $meses[$factura->MES_COBRO * 1] . '"';
        echo "</td>";
    }
    ?>
                    </tr>
                     <tr>
    <?php
    foreach ($historial_facturas as $factura) {
        echo "<td>";
        echo ''.$factura->CONSUMO_ACTUAL.'<br>-<br>'.$factura->CONSUMO_ANTERIOR . '';
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
        echo "</td>";
        $suma_consumos = $suma_consumos + $factura->CONSUMO_CALCULADO;
    }
    ?>
                    </tr>
                   

                </table> 
                <div>
                    <p><b>PROMEDIO DE <?= $contador_meses ?> CON UN CONSUMO DE 
            <?= $suma_consumos ?> m³, dando un:  </b><h2>Promedio = <?= $suma_consumos/$contador_consumos ?> m³</h2></p>
                </div>
            </div>
        </div>
    </div>
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

    <?php
//Fin de Varios medidores
}
//
?>
