
<?php
/** @var ClaseContableController $this */
/** @var ClaseContable $model */
$this->menu = array(
        //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . ClaseContable::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . ClaseContable::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);

$meses = array("N/A", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>

<table class="table table-condensed table-hover table-responsive table-bordered">
    <thead>
    <th>MES</th>
    <th>AÑO</th>            
    <th>DETALLES DE ALCANTARILLADO</th>
    <th>VALOR</th>
</thead>
<tbody>
    <?php
    $fechaInicio = strtotime("01-11-2019");
    $fechaFin = strtotime("10-04-2021");
    $aux_mes = 0;
    $aux_anio = 0;
    $suma_total = 0;
    for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {

        if ($aux_anio != date("Y", $i) || $aux_mes != date("m", $i)) { // Inicia un ciclo de un mes
            //echo date("m_Y", $i)."<br>";
            $aux_anio = date("Y", $i);
            $aux_mes = date("m", $i) * 1;
            // echo '<br>'.$aux_mes.'_'.$aux_anio;
            // **********************************************************************
            // **********************************************************************    
            // Inicia con cada mes de cobro

            $fecha_parametro_aux = $aux_mes . '_' . $aux_anio;
            $fecha_parametro = $aux_mes . '_' . $aux_anio;
            if (isset($fecha_parametro)) {
                $fecha_parametro = explode('_', $fecha_parametro);
                //  echo "<br>MES: ".$fecha_parametro[0];
                //  echo "<br>AÑO:".$fecha_parametro[1];
            }


            $lista_subcuentas = SubcuentaContable::model()->findAllBySql('Select * from subcuenta_contable where SUBCUENTA like "%alcantarillado%"');
            $suma = 0;
            ?>
            <tr>                
                <td><?= $meses[$fecha_parametro[0] * 1] ?> </td> <!--Mes-->
                <td><?= $fecha_parametro[1] ?></td> <!--Año-->
                <td>
                    <table class="table table-condensed table-hover table-responsive table-bordered">
<!--                        <thead>
                        <th>CÓDIGO</th>
                        <th>SUBCUENTA CONTABLE</th>		
                        <th>VALOR</th>
                        </thead>-->
                        <tbody>
        <?php
        foreach ($lista_subcuentas as $subcuenta) {
            $lista_detalles_deuda = Detalle::model()->findBySql('SELECT 
  d.`ID`,
  d.`ID_FACTURA`,
  d.`ID_RUBRO`,
  d.`CANTIDAD`,
  d.`V_UNITARIO`,
  SUM(d.`V_TOTAL`) AS V_TOTAL,
  d.`IVA`,
  d.`PORC_MORA`,
  d.`VALOR_MORA`,
  d.`FECHA`,
  d.`FECHA_COBRO`,
  d.`ESTADO`,
  d.`COD_USUARIO`,
  d.`FECHA_ACTUALIZACION`,
  d.`FACTURA_COBRA`
 FROM detalle AS d 
INNER JOIN rubro AS r
ON r.`ID` = d.`ID_RUBRO`
WHERE r.ID_SUBCUENTA = ' . $subcuenta->ID
                    . ' AND d.ESTADO = 1 '
                    . ' AND YEAR(d.FECHA_COBRO) = ' . $fecha_parametro[1]
                    . ' AND MONTH(d.FECHA_COBRO) = ' . $fecha_parametro[0]);

            echo "<tr>";
            if ($lista_detalles_deuda->V_TOTAL) {
                // Existe valores en deuda
//                echo "<td>" . $subcuenta->CODIGO . "</td>";
                //echo "<td> " . $subcuenta->SUBCUENTA . "</td>";
                $nuevo_parametro = $fecha_parametro_aux . '_' . $subcuenta->ID;
                echo "<td>" . CHtml::link($subcuenta->SUBCUENTA, array('subcuentaContable/ver/',
                    'fecha_parametro' => $nuevo_parametro)) . "</td>";
                echo "<td>" . $lista_detalles_deuda->V_TOTAL . "</td>";
            }
            $suma = $suma + $lista_detalles_deuda->V_TOTAL;
            echo "</tr>";
        }
        ?>
                            <!--<tr>-->
                                <!--<td colspan="2" style="text-align: right;">TOTAL</td>-->
                                <!--<td><?php // echo $suma ?></td>-->
                                <?php $suma_total = $suma_total + $suma; ?>
                            <!--</tr>-->
                        </tbody>
                    </table>
                </td>
                <td><?= $suma ?></td>
            </tr>

        <?php
        // Termina con el mes de cobros
        // **********************************************************************
        // **********************************************************************
    } //Fin de un ciclo de un mes   
} // Fin del ciclo de cada día
 echo "<tr>";
    echo "<td colspan='3'>TOTAL</td>";
    echo "<td>".$suma_total."</td>";
    echo "</tr>";
?>

</tbody>
</table>

