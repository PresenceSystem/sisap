<?php
$this->menu = array(
        //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Factura::label(2), 'icon' => 'list', 'url' => array('index')),
        //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Factura::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
        //array('label' => Yii::t('AweCrud.app', 'Anular'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('anular', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Seguro para anular?'))),
        //   array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
$ano = (date('Y')) * 1;
$mes = (date('m')) * 1;
$dia = (date('d')) * 1;
$diasemana = date('w');
$diassemanaN = array("Domingo", "Lunes", "Martes", "Miércoles",
    "Jueves", "Viernes", "Sábado");
$mesesN = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano" . date('H:i:s');


$ultima_factura_fisica = Factura::model()->findBySql('SELECT IF (MAX(`NUMERO_FACTURA`) IS NULL,0, MAX(`NUMERO_FACTURA`))+1 AS NUMERO_FACTURA
FROM factura');
        $toca_factura_fisica = $ultima_factura_fisica->NUMERO_FACTURA;
?>

<fieldset>
    <legend> FACTURAS EMITIDAS HASTA EL : <?php echo $fecha_formateada ?></legend>
</fieldset>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><center>COBROS REALIZADOS</center></h3>
    </div>
    <div class="panel-body">



        <?php
        $contador = 1;
        //  $suma = 0;
        ?>   

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N°.</th>
                    <th>Emisión N°.</th>
                    <th>Usuario</th>
                    <th>Emitido</th>
                    <th>Factura Física N°</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($modelo_facturas as $mod) {
                    ?>
                    <tr>
                        <td> <?= $contador++; ?>  </td>
                        <td> <?php echo $mod->ID; ?>  </td>
                        <td> <?php echo $mod->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO; ?>  </td>
                        <td> <?php echo $mod->MES_COBRO; ?>  </td>
                        <?php
//                                                 $modelo_detalle = Detalle::model()->findBySql('SELECT SUM(d1.V_TOTAL) as V_TOTAL'
//                                                         . ' FROM detalle AS d1 '
//                                                         . 'WHERE d1.FACTURA_COBRA = '.$mod->ID.' AND d1.`ESTADO`= 1');
                        ?>
                        <td> <?php echo $mod->NUMERO_FACTURA; ?>  </td>
                        <td>
                            <center>
                            <a href="<?php echo Yii:: app()->baseUrl . '/index.php/factura/' . $mod->ID ?>" class=" text-center btn-primary btn-mini btn" title="Ver los detalles, y posterior puede anular la factura" >  
                                <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/buscar.png' ?>" width="20px"></img>                                
                                <h5> VER FACTURA</h5>								
                            </a>
                            </center>
                        </td>
                        <td>
                            <center>
                            <a href="<?php echo Yii:: app()->baseUrl . '/index.php/socioMedidor/reimprimir/' . $mod->ID ?>" class=" text-center btn-warning btn-mini btn" title="Reimprimir en la factura física N°: <?= $toca_factura_fisica?>" >  
                                <img src="<?php echo Yii:: app()->baseUrl . '/images/imprimir.png' ?>" width="30px"></img>                                
                                <h5> REIMPRIMIR</h5>								
                            </a>
                            </center>
                        </td>
                </tr>
                <?php
                // $suma = $suma + $mod->ANIO_COBRO;
            }
            ?>
<!--            <tr>
<td colspan = '3'>
    TOTAL
</td>
<td>
            <?php //echo $suma;
            ?>
</td>
</tr>-->
            </tbody>
        </table>
    </div>
</div>
<center>
    <a href="<?php echo Yii:: app()->baseUrl . '/index.php/socioMedidor/factura' ?>" class=" text-center btn-warning btn-mini btn" title="Cancelar y volver a continuar facturando" >                                  
        <h5> CANCELAR</h5>								
    </a>
</center>

