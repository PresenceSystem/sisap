<?php
/** @var RubroController $this */
/** @var Rubro $model */
$this->breadcrumbs = array(
    'Rubros' => array('index'),
    $model->ID,
);

$this->menu = array(
   // array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Rubro::label(2), 'icon' => 'list', 'url' => array('index')),
    //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Rubro::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'EDITAR'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
    array('label' => Yii::t('AweCrud.app', '_______________'), 'icon' => 'list-alt', 'url' => array('#')),
    array('label' => Yii::t('AweCrud.app', '_______________'), 'icon' => 'list-alt', 'url' => array('#')),
    array('label' => Yii::t('AweCrud.app', '_______________'), 'icon' => 'list-alt', 'url' => array('#')),
    array('label' => 'APLICAR A TODOS ', 'icon' => 'icon-ok', 'url' => array('aplicar_a_todos', 'id' => $model->ID)),
    array('label' => 'QUITAR A TODOS ', 'icon' => 'icon-ok', 'url' => array('quitar_a_todos', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', '_______________'), 'icon' => 'list-alt', 'url' => array('admin')),
    array('label' => Yii::t('AweCrud.app', '_______________'), 'icon' => 'list-alt', 'url' => array('admin')),
    array('label' => 'APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('aplicar_a', 'id' => $model->ID)),
    array('label' => 'NO APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('no_aplicar_a', 'id' => $model->ID)),
);
?>

<fieldset>
    <legend class="text-center badge-info text-warning"> <?php echo CHtml::encode($model) ?></legend>


</fieldset>
<?php
if (isset($model_detalles)) {
    $descripcion_compara = $model->DESCRIPCION;
    $descripcion_base_compara = "CONSUMO DE AGUA POTABLE";
    $posicion_encontrada = strpos($descripcion_compara, $descripcion_base_compara);
    //echo $posicion_encontrada;
    if (($posicion_encontrada !== false) and $posicion_encontrada == 0) { //consumo de agua potable ...... ....
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                //   'ID',                
                // 'DESCRIPCION',
                // 'V_UNITARIO',
                // 'PORCEN',
                'FEC_CREACION',
//            'TIPO',
            ),
        ));
        ?>
        <table class="table table-condensed table-hover table-responsive table-bordered">
            <thead>
            <th>N°</th>
            <th>ID DETALLE</th>
            <th>APELLIDOS Y NOMBRES</th>
            <!--<th>CANTIDAD DE TERRENOS</th>-->
            <!--<th>CANTIDAD TOTAL</th>-->
            <th>Anterior</th>
            <th>Actual</th>
            <th>Consumo</th>
            <th>VALOR A PAGAR</th>
            <th>ESTADO</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            $suma_valor = 0;
            $sumador_consumo = 0;

            foreach ($model_detalles as $detalle) {
                if ($detalle->ESTADO == 1) {
                    echo '<tr>';
                    $estado = 'PAGADO';
                } else {
                    echo '<tr bgcolor="#f9e9b0">';
                    $estado = 'EN DEUDA';
                }

                echo "<td> " . $contador++ . ' </td>  ';
                if ($detalle->ESTADO == 0) {
                    echo "<td> " . CHtml::link($detalle->ID, array('detalle/update/',
                        'id' => $detalle->ID)) . "</td>";
                } else {
                    echo "<td> " . CHtml::encode($detalle->ID, array('detalle/update/',
                        'id' => $detalle->ID)) . "</td>";
                }
                echo "<td> " . $detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO . ' </td>  ';
                echo "<td> " . $detalle->iDFACTURA->CONSUMO_ANTERIOR . ' </td>  ';
                echo "<td> " . $detalle->iDFACTURA->CONSUMO_ACTUAL . ' </td>  ';
                echo "<td> " . $detalle->iDFACTURA->CONSUMO_CALCULADO . ' m³ </td>  ';
                echo "<td> " . $detalle->V_TOTAL . ' </td>  ';
                echo "<td> " . $estado . ' </td>  ';
                ;
                $suma_valor = $suma_valor + $detalle->V_TOTAL;
                $sumador_consumo = $sumador_consumo + $detalle->iDFACTURA->CONSUMO_CALCULADO;
                
                
                
                echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="4">TOTAL</td>
                <td><?php echo $sumador_consumo . '' ?></td>
                <td><?php echo $suma_valor . '' ?></td>                
            </tr>
        </tbody>
        </table>
        <?php
    } //Fin consumo de agua potable
    else { // Inicia para otros rubros excepto consumo de agua potable
        // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        $descripcion_compara = $model->DESCRIPCION;
        $descripcion_base_compara = "MORA";
        $posicion_encontrada = strpos($descripcion_compara, $descripcion_base_compara);
        //echo $posicion_encontrada;
        if (($posicion_encontrada !== false) and $posicion_encontrada == 0) { //Mora...... ....
            ?>
            <a href="<?php echo Yii:: app()->baseUrl . '/index.php/rubro/anular_interes/' . $model->ID; ?>" class="btn btn-warning" >
                ANULAR INTERES
            </a>
        <?php } // Fin de rubros de mora 
        // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        ?>


        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                //   'ID',
                // 'DESCRIPCION',                
                array(	
                        'name'=>'ID_SUBCUENTA',
			'value'=>($model->iDSUBCUENTA !== null) ? CHtml::encode($model->iDSUBCUENTA.' '.$model->iDSUBCUENTA->SUBCUENTA, array('/subcuentaContable/view/'. $model->iDSUBCUENTA->ID)).' ' : null,
			'type'=>'html',
		),
                'V_UNITARIO',
                //  'PORCEN',
                'FEC_CREACION',
//            'TIPO',
            ),
        ));
        ?>
        <table class="table table-condensed table-hover table-responsive table-bordered">
            <thead>
            <th>N°</th>
            <th>ID DETALLE</th>

            <th>APELLIDOS Y NOMBRES</th>
            <!--<th>CANTIDAD DE TERRENOS</th>-->
            <!--<th>CANTIDAD TOTAL</th>-->
            <th>VALOR ($)</th>
            <th>ESTADO</th>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            $suma_valor = 0;

            foreach ($model_detalles as $detalle) {
                if ($detalle->ESTADO == 1) {
                    echo '<tr>';
                    $estado = 'PAGADO';
                } else {
                    echo '<tr bgcolor="#f9e9b0">';
                    $estado = 'EN DEUDA';
                }

                echo "<td> " . $contador++ . ' </td>  ';
                if ($detalle->ESTADO == 0) {
                    echo "<td> " . CHtml::link($detalle->ID, array('detalle/update/',
                        'id' => $detalle->ID)) . "</td>";
                } else {
                    echo "<td> " . CHtml::encode($detalle->ID, array('detalle/update/',
                        'id' => $detalle->ID)) . "</td>";
                }

                echo "<td> " . $detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO . ' </td>  ';
                echo "<td> " . $detalle->V_TOTAL . ' </td>  ';
                echo "<td> " . $estado . ' </td>  ';
                ;

                $suma_valor = $suma_valor + $detalle->V_TOTAL;
                 //******************************************
                echo '<td>';
                $cont_aplicados=0;
                foreach ($model_detalles as $det_aux) {
                    if ($detalle->ID_FACTURA  == $det_aux->ID_FACTURA){
                       $cont_aplicados++;
                    }
                }
                if ($cont_aplicados>1){
                 echo "VERIFICAR";
                }
                echo '</td>';
                //*********************************************
                echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="3">TOTAL</td>
                <td><?php echo $suma_valor . '' ?></td>

            </tr>
        </tbody>
        </table>
        <?php
    } //Fin para otros rubros excepto consumo de agua potable
}; // FIN si existen aplicados al rubro
?>

<br><br><br>
<a href="<?php echo Yii:: app()->baseUrl . '/index.php/rubro/ver_grupo/' . $model->ID; ?>" class="btn btn-success span" >                   
    VER CON GRUPOS
</a>