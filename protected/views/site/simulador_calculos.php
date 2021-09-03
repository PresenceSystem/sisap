<?php echo $this->renderPartial('_form_simulador_calculos', array('model' => $model_parametro)); ?>

<?php
$connection_sisap = Yii::app()->db;
//                   -- 1.- Rangos de valores por consumo
$sql = "CALL listar_rangos_de_consumo();";
$command = $connection_sisap->createCommand($sql);
$rangos_consumo = $command->queryAll();
// 2.- calcular valor consumido en m3
$Consumo_Calculado = $Consumo_Actual - $Consumo_anterior; //Ejm: 100 m3
// 3.- calcula el valor a cancelar
$consumo_total = $model_parametro->VALOR; //Ejm: 100 m3    
$aux_consumo_total = $consumo_total;
$consumo_contador = 0; //Ejm: 0
$valor_calculado = 0;
echo "<h3 class=' alert-info text-light text-center'>VALOR POR CONSUMO DE AGUA POTABLE POR " . $consumo_total . ' m³</h3>';
$suma_consumos = 0;
echo "<table class='table table-condensed table-striped table-hover table-bordered'>";
echo "<tr><td><center><h4>Rango (m³)</h4></center></td><td><center><h4>Precio/m³</h4></center></td><td><center><h4>Cantidad (m³)</h4></center></td><td><center><h4>Total</h4></center></td></tr>";
foreach ($rangos_consumo as $rango) {
    if ($rango['TIPO_CALCULO'] == 2) {    //2.- Es un valor fijo                                             
        // $valor_calculado = $rango['VALOR'];
        // $consumo_total = $consumo_total - $rango['VALOR_MAX'];
        // echo "<br> - BASICO HASTA " . $rango['VALOR_MAX'] . ' m3 = ' . $valor_calculado;
    } else { // 1.- Es un valor calculado       
        $consumo_contador = ($rango['VALOR_MAX'] - $rango['VALOR_MIN']) + 1; // mas 1 para tomar en cuenta el valor minimo        
        if (($consumo_total >= $consumo_contador) && ( $rango['VALOR_MAX'] > 0)) {
            $valor_calculado = $valor_calculado + ($consumo_contador * $rango['VALOR']);
            echo "<tr><td>" . $rango['VALOR_MIN'] . " - " . $rango['VALOR_MAX'] . "</td>";
            echo "<td>" . $rango['VALOR'] . "</td>";
            echo "<td>" . $consumo_contador . "</td>";
            echo "<td>" . ($consumo_contador * $rango['VALOR']) . "</td></tr>";
            //echo "<br> POR " . $consumo_contador . ' m3 X ' . $rango['VALOR'] . ' = ' . ($consumo_contador * $rango['VALOR']);
            $consumo_total = $consumo_total - $consumo_contador;
            $suma_consumos = $suma_consumos + $consumo_contador;
        } else {
            if ($consumo_total != 0) {
                if ($consumo_total < 0)
                    $consumo_total = 0;
                $valor_calculado = $valor_calculado + ($consumo_total * $rango['VALOR']);
                echo "<tr><td>" . $rango['VALOR_MIN'] . " - " . $rango['VALOR_MAX'] . "</td>";
                echo "<td>" . $rango['VALOR'] . "</td>";
                echo "<td>" . $consumo_total . "</td>";
                echo "<td>" . ($consumo_total * $rango['VALOR']) . "</td></tr>";
                //echo "<br> POR " . $consumo_total . ' m3 X ' . $rango['VALOR'] . ' = ' . ($consumo_total * $rango['VALOR']);
                $suma_consumos = $suma_consumos + $consumo_total;
                $consumo_total = 0;
            }
        }
    }
}
$resto_metros = ($aux_consumo_total - $suma_consumos);
$valor_recalculado = $rango['VALOR'];
if ($resto_metros > 0) {
    for ($k = $suma_consumos + 1; $k <= $aux_consumo_total; $k++) {
        $valor_recalculado = $valor_recalculado + 0.20;
        echo "<tr><td>" . $k . " - " . $k . "</td>";
        echo "<td>" . $valor_recalculado . "</td>";
        echo "<td>1</td>";
        echo "<td>" . $valor_recalculado . "</td></tr>";
    }
}
echo "<tr><td colspan='2' style='text-align: right'><h4>TOTAL</h4></td><td><h4>" . $suma_consumos . " m³</h4></td><td><h4>" . $valor_calculado . "</h4></td></tr>";
echo "</table>";
?>
<a href="<?= Yii::app()->homeUrl; ?>">
    <button type="button" class="btn btn-warning"> 
        <center><b> ← Volver</b> </center>
    </button>
</a>