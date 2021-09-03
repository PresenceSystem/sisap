
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
$fecha_parametro_aux = $fecha_parametro;
if (isset($fecha_parametro)) {
    $fecha_parametro = explode('_', $fecha_parametro);
    //  echo "<br>MES: ".$fecha_parametro[0];
    //  echo "<br>AÑO:".$fecha_parametro[1];
}
?>

<fieldset>
    <div class="container-fluid alert-warning text-center col-md-3">
        <div class="alert-info h4 text-center">FECHAS DE COBRO</div>
        <?php
         $lista_detalles_del_mes = Detalle::model()->findAllBySql('SELECT 
  d.*
 FROM detalle AS d 
WHERE '
                            . ' d.ESTADO = 1 '
                            . ' AND YEAR(d.FECHA_COBRO) = ' . $fecha_parametro[1]*1
                            . ' AND MONTH(d.FECHA_COBRO) = ' . $fecha_parametro[0]*1
                            .' GROUP BY YEAR(d.FECHA_COBRO),MONTH(d.FECHA_COBRO),DAY(d.FECHA_COBRO)');
         foreach ($lista_detalles_del_mes as $dees) 
         {
             $fecha_de_cobro = explode('-', $dees->FECHA_COBRO);
             $dia_de_cobro = explode(' ', $fecha_de_cobro[2]);    
             $parametro_con_dia = $dia_de_cobro[0]."_".$fecha_de_cobro[1]."_".$fecha_de_cobro[0];
             //echo $parametro_con_dia;
            echo CHtml::link("<h5>".$dia_de_cobro[0]." de ".$meses[$fecha_de_cobro[1] * 1] . " del " . $fecha_de_cobro[0]."</h5>"
                    , array('subcuentaContable/lista_cobros_dia/',
            'fecha_parametro' => $parametro_con_dia));
         }
        ?>
    </div>
    <div class="container-fluid"> 
        <h3 class="btn-warning text-center"> Cobros <?= $meses[$fecha_parametro[0] * 1] ?> del <?= $fecha_parametro[1] ?></h3>
        <h3 class="text-info text-center"> FACTURA </h3>
        <table class="table table-condensed table-hover table-responsive table-bordered">
            <thead>
            <th>CÓDIGO</th>
            <th>SUBCUENTA CONTABLE</th>		
            <th>VALOR EN DEUDA</th>
            </thead>
            <tbody>
                <?php
                $lista_subcuentas = SubcuentaContable::model()->findAllBySql('Select * from subcuenta_contable ');
                $suma = 0;

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
                            . ' AND d.ESTADO = 1 AND r.TIPO = 1 '
                          //  . ' AND day(d.FECHA_COBRO) = ' . date('d')*1
                            . ' AND YEAR(d.FECHA_COBRO) = ' . $fecha_parametro[1]*1
                            . ' AND MONTH(d.FECHA_COBRO) = ' . $fecha_parametro[0]*1);
                    
                    echo "<tr>";
                    if ($lista_detalles_deuda->V_TOTAL) {
                        // Existe valores en deuda
                        echo "<td>" . $subcuenta->CODIGO . "</td>";
                        //echo "<td> " . $subcuenta->SUBCUENTA . "</td>";
                        $nuevo_parametro = $fecha_parametro_aux.'_'.$subcuenta->ID;
                        echo "<td>".CHtml::link($subcuenta->SUBCUENTA, array('subcuentaContable/ver/',
                            'fecha_parametro' => $nuevo_parametro))."</td>";
                        echo "<td>" . $lista_detalles_deuda->V_TOTAL . "</td>";
                    }
                    $suma = $suma + $lista_detalles_deuda->V_TOTAL;
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td><?= $suma ?></td>
                </tr>
            </tbody>
        </table>







        <h3 class="text-info text-center"> RECIBOS </h3>
        <table class="table table-condensed table-hover table-responsive table-bordered">
            <thead>
            <th>CÓDIGO</th>
            <th>SUBCUENTA CONTABLE</th>		
            <th>VALOR EN DEUDA</th>
            </thead>
            <tbody>
                <?php
                $lista_subcuentas = SubcuentaContable::model()->findAllBySql('Select * from subcuenta_contable ');
                $suma = 0;
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
WHERE r.ID_SUBCUENTA = ' . $subcuenta->ID .
                            ' AND d.ESTADO = 1 AND r.TIPO = 2 '
                           // . ' AND day(d.FECHA_COBRO) = ' . date('d')*1
                            . ' AND YEAR(d.FECHA_COBRO) = ' . $fecha_parametro[1]*1
                            . ' AND MONTH(d.FECHA_COBRO) = ' . $fecha_parametro[0]*1);
                    echo "<tr>";
                    if ($lista_detalles_deuda->V_TOTAL) {
                        // Existe valores en deuda
                        echo "<td>" . $subcuenta->CODIGO . "</td><td> " . $subcuenta->SUBCUENTA . "</td>";
                        echo "<td>" . $lista_detalles_deuda->V_TOTAL . "</td>";
                    }
                    $suma = $suma + $lista_detalles_deuda->V_TOTAL;
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td><?= $suma ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</fieldset>
<?php
date_default_timezone_set('America/Guayaquil'); //puedes cambiar Guayaquil por tu Ciudad
setlocale(LC_TIME, 'spanish');
$fecha = new DateTime(date('Y-m-d'));
//$fecha->setISODate(2016, 1, 1);
//$fecha->modify('-5 month');
//$aux_mes_anterior = ($fecha->format('m'));
?>
<div class="badge-warning text-center span12">
    HISTORIAL DE COBROS<BR>
    <?php
    $maximo = 6;
    $fecha->modify('-' . $maximo . ' month');
    for ($i = $maximo; $i > 0; $i--) {
        $fecha->modify('+1 month');
        $aux_mes_seleccionado = ($fecha->format('m'));
        $mes = $meses[$aux_mes_seleccionado * 1];
        $anio = $fecha->format('Y');
        $parametro = $aux_mes_seleccionado . '_' . $anio;
        echo CHtml::link($mes . ' ' . $anio . '   ...   ', array('subcuentaContable/lista_cobros_historico/',
            'fecha_parametro' => $parametro));
    }
    ?>
</div>