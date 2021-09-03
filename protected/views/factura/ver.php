<?php
/** @var FacturaController $this */
/** @var Factura $model */
$this->breadcrumbs = array(
    'Facturas' => array('index'),
    $model->ID,
);

$this->menu = array(
        //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Factura::label(2), 'icon' => 'list', 'url' => array('index')),
        //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Factura::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
        //array('label' => Yii::t('AweCrud.app', 'Anular'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('anular', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Seguro para anular?'))),
        //   array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>
<div class="container">
    <fieldset>
        <legend> <div class="badge-celeste-claro"> <center>  <?php echo $model->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO . '<br> <b> EMISIÓN Nº:</b> ' . CHtml::encode($model) ?></center>
                <?php echo '<!-- <b> EMISIÓN Nº:</b> ' . CHtml::encode($model) . '--!><br> <b>MES/ANIO del cobro:<b> ' . $model->MES_COBRO . '/' . $model->ANIO_COBRO ?>    </div>      
        </legend>
        <br> <b>FACTURA FÍSICA N°:</b> <?= $model->NUMERO_FACTURA ?>

        <?php
        $suma_total_cobrado = 0;
        ?>
    </fieldset>

    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><center>COBRO EN FACTURA</center></h3>
            </div>
            <div class="panel-body">



                <?php
                $contador = 0;
                $suma = 0;
                $fecha_cobro = '';
                ?>   

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cant.</th>
                            <th>Desc</th>
                            <th>V.U.</th>
                            <th>V.T.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($modelo_detalles as $mod) {
                            $fecha_cobro = $mod->FECHA_COBRO;
                            if ($mod->iDFACTURA->TIPO == 1) { // FACTURA 
                                ?>
                                <tr>

                                    <td> <?php echo $mod->CANTIDAD; ?>  </td>
                                    <td> <?php echo $mod->iDRUBRO->DESCRIPCION; ?>  </td>
                                    <td> <?php echo $mod->V_UNITARIO; ?>  </td>
                                    <td> <?php echo $mod->V_TOTAL; ?>  </td>

                                </tr>
                                <?php
                                $suma = $suma + $mod->V_TOTAL;
                            } // FIN DE FACTURA						
                        }
                        ?>
                        <tr>
                            <td colspan = '3'>
                                TOTAL
                            </td>
                            <td>
                                <?php
                                echo $suma;
                                $suma_total_cobrado = $suma_total_cobrado + $suma;
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><center>COBRO EN RECIBO</center></h3>
            </div>
            <div class="panel-body">



                <?php
                $contador = 0;
                $suma = 0;
                ?>   

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cant.</th>
                            <th>Desc</th>
                            <th>V.U.</th>
                            <th>V.T.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($modelo_detalles as $mod) {
                            if ($mod->iDFACTURA->TIPO == 2) { // FACTURA 
                                ?>
                                <tr>

                                    <td> <?php echo $mod->CANTIDAD; ?>  </td>
                                    <td> <?php echo $mod->iDRUBRO->DESCRIPCION; ?>  </td>
                                    <td> <?php echo $mod->V_UNITARIO; ?>  </td>
                                    <td> <?php echo $mod->V_TOTAL; ?>  </td>

                                </tr>
                                <?php
                                $suma = $suma + $mod->V_TOTAL;
                            } // FIN DE FACTURA						
                        }
                        ?>
                        <tr>
                            <td colspan = '3' class="">
                                TOTAL
                            </td>
                            <td>
                                <?php
                                echo $suma;
                                $suma_total_cobrado = $suma_total_cobrado + $suma;
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>	
    </div>
    <?php echo '<h3 class="text-warning text-success text-center"> TOTAL: ' . $suma_total_cobrado . ' USD </h3>' ?>	
    <?php echo '<br>FECHA DEL COBRO: '; ?>
    <?php
//    echo $model->MES_COBRO;
//    echo "<br>".$fecha_cobro."<br>";
    $fech = explode("-", $fecha_cobro);
    if (isset($fech[1]) && isset($model->MES_COBRO)) {
        if ($fech[1] == $model->MES_COBRO)
            echo $fecha_cobro;
        else{
            if ($fech[1] > $model->MES_COBRO) // Se cobra el mes anterior antes de generar valores del mes
            {
                echo " Cobrando valores de meses anteriores el: ".$fecha_cobro;    
            } else {
                 ECHO 'No registrado';
            }
        }           
    }
    ?>

</div>



