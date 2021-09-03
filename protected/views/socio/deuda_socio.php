<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs = array(
    'Socios' => array('index'),
    $model->CODIGO,
);


if (isset($model->CODIGO) && $model->CODIGO > 0)
{
?>

<fieldset>    
    <div class="row">
        <div class="  col-md-12">
            <center> 
                <?php
                if ($model->FOTO == NULL or $model->FOTO == "") {
                    $model->FOTO = "PS.png";
                }
                ?>

                <?php //echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotosSocios/' . $model->FOTO, "...", array("width" => '100px')); ?>  
            </center>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><center>DATOS PERSONALES</center></h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.TbDetailView', array(
                            'type' => 'bordered condensed',
                            'data' => $model,
                            'attributes' => array(
                                //   'CODIGO',
                                'CI',
                                'APELLIDO',
                                //  'GENERO',
                                array(
                                    'name' => 'COD_GRUPO',
                                    'value' => ($model->grupo !== null) ? CHtml::encode($model->grupo->GRUPO) . '' : null,
                                    'type' => 'html',
                                ),
                            /*   'DIRECCION',
                              'TELEFONO',
                              'CELULAR',
                              array(
                              'name' => 'EMAIL',
                              'type' => 'email'
                              ),
                              array(
                              'name' => 'PARTICIPA_COMUNIDAD',
                              'value' => ($model->PARTICIPA_COMUNIDAD == 1) ? '<h5 class="badge-success badge">Activo</h5>' : '<h5 class="badge-warning badge">Inactivo</h5>',
                              'type' => 'html',
                              ),
                              array(
                              'name' => 'USU_AGUA_POTABLE',
                              'value' => ($model->USU_AGUA_POTABLE == 1) ? '<h5 class="badge-info badge">✔</h5>' : '<h5 class="badge-warning badge">X</h5>',
                              'type' => 'html',
                              ),
                              array(
                              'name' => 'USU_ALCANTARILLADO',
                              'value' => ($model->USU_ALCANTARILLADO == 1) ? '<h5 class="badge-info badge">✔</h5>' : '<h5 class="badge-warning badge">X</h5>',
                              'type' => 'html',
                              ),
                              //                                array(
                              //                                    'name' => 'COD_USUARIO',
                              //                                    'value' => ($model->usuario !== null) ? CHtml::encode($model->usuario->nombres) . '' : null,
                              //                                    'type' => 'html',
                              //                                ),
                              'FECHA_ACTUALIZACION',
                              'ESTADO_CIVIL',
                              'NOMBRE_CONYUGE',
                              'FECHA_NACIMIENTO',
                              //	'ESTADO'
                             * 
                             */
//                                array(
//                                    'name' => 'ESTADO',
//                                    'value' => ($model->ESTADO == 1) ? '<h5 class="badge-success badge">Activo</h5>' : '<h5 class="badge-warning badge">Inactivo</h5>',
//                                    'type' => 'html',
//                                ),
                            // 'OBS',
                            )
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><center>DEUDAS PENDIENTES</center></h3>
        </div>
        <div class="panel-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
<!--                        <th>Estado</th>-->
                        <th>Número de medidor</th>
                        <th>Grupo</th>
                        <th>Consumo Inicial</th>
                        <th>Orden de recorrido</th>
                        <th>Vigente desde</th>
                        <th>Consumo actual</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $contador = 0;
                    foreach ($modelos_socio_medidor as $mod) {
                        $modelo_socio_medidor = new SocioMedidor();
                        $modelo_socio_medidor = $mod;


                        if (isset($modelo_socio_medidor->iDMEDIDOR)) {
                            ?>

                            <tr>
                                <?php $contador++; ?> 
                                <!--<td>  <?php // echo $modelo_socio_medidor->iDMEDIDOR->NUMERO;         ?></td>-->  
                                <!--<td>-->
                                <?php
//                                    if ($modelo_socio_medidor->INACTIVO == 0) {
//                                        
                                ?>
                                        <!--<img src="//<?php // echo Yii:: app()->baseUrl . '/images/semaforo/3.png'  ?>" width="75px"></img>-->                                
                                <?php
//                                    } else {
//                                        
                                ?>
                                        <!--<img src="//<?php // echo Yii:: app()->baseUrl . '/images/semaforo/2.png'  ?>" width="75px"></img>-->                                
                                <?php
//                                    }
                                ?>
                                </td>	
                                <td> <?php
                                    if ($modelo_socio_medidor->INACTIVO == 0) {
                                        echo CHtml::encode($modelo_socio_medidor->iDMEDIDOR->NUMERO, array('medidor/update',
                                            'id' => $modelo_socio_medidor->iDMEDIDOR->ID));
                                    } else
                                        echo $modelo_socio_medidor->iDMEDIDOR->NUMERO;
                                    ?> </td>													
                                <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->iDGRUPO->DESCRIPCION; ?>  </td>
                                <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->CONSUMO_INICIAL; ?>  </td>
                                <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO; ?>  </td>
                                <td> <?php echo $modelo_socio_medidor->FECHA_ACTUALIZACION; ?>  </td>
                                <td>
                                    <!-- CONSUMO ACTUAL -->
                                    <?php
                                    $model_factura_consumo = Factura::model()->findBySql('SELECT * FROM factura
	WHERE ID_MEDIDOR_SOCIO = 
	' . $modelo_socio_medidor->ID . ' AND TIPO = 1
	ORDER BY CONSUMO_ACTUAL DESC
	LIMIT 1;');
                                    if (isset($model_factura_consumo)) {
                                        echo $model_factura_consumo->CONSUMO_ACTUAL;
                                    } else {
                                        echo "0";
                                    }
                                    ?>

                                    <!-- FIN DE CONSUMO ACTUAL -->
                                </td>                            
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <?php
                                    $deudas = Detalle::model()->findAllBySql("SELECT 
			-- s.CODIGO AS CODIGO,
			-- f.`TIPO`, f.`CONSUMO_ANTERIOR`, f.`CONSUMO_ACTUAL`, f.`CONSUMO_CALCULADO`,f.ID AS FACTURA_ID, 
			r.`DESCRIPCION` AS COD_USUARIO, 
			d.ID AS DETALLE_ID ,
                        d.`CANTIDAD`,
                        d.`V_UNITARIO`,
			((d.`V_TOTAL`) - IFNULL((SELECT SUM(cuota.`ABONO`) FROM `cuota` WHERE `ID_DETALLE` = d.ID),0)
						) AS V_TOTAL,
			-- m.ID, m.NUMERO,
			d.ESTADO
			FROM medidor AS m
				INNER JOIN socio_medidor AS sm ON m.ID = sm.ID_MEDIDOR
				INNER JOIN socio AS s ON s.CODIGO = sm.CODIGO_SOCIO
				INNER JOIN factura AS f ON f.`ID_MEDIDOR_SOCIO` = sm.`ID`
				INNER JOIN detalle AS d ON d.`ID_FACTURA` = f.`ID`
				INNER JOIN rubro AS r ON r.`ID` = d.`ID_RUBRO`
				WHERE 
				-- sm.INACTIVO= 0  -- Este activo el socio_medidor
				-- AND 
				d.`ESTADO` != 1 -- Distinto de pagado	
				AND sm.CODIGO_SOCIO = " . $model->CODIGO
                                            . " AND m.NUMERO = '" . $modelo_socio_medidor->iDMEDIDOR->NUMERO . "'");
//                                echo "<br>".$model->CODIGO;
//                                echo "<br>".$modelo_socio_medidor->iDMEDIDOR->NUMERO;
//                                echo "<br> ____________";
                                    $contador = 1;
                                    $suma = 0;
                                    echo "<table class='table table-striped table-bordered table-condensed'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Cantidad</th>";
                                    echo "<th>Detalle</th>";
                                    echo "<th>Total</th>";
                                    echo "</tr>";
                                    echo "<t/head>";
                                    foreach ($deudas as $deuda) {
                                        $contador++;
                                        echo "<tr>";
                                        echo "<td style='text-align: left; color: blue; size:100px; face:impact'>" . $deuda->CANTIDAD . "</td>";
                                        echo "<td style='text-align: left; color: blue; size:100px; face:impact'>" . $deuda->COD_USUARIO . "</td>";
                                        echo "<td style='text-align: right; color: blue; size:100px; face:impact'>" . $deuda->V_TOTAL . " $</td>";
                                        echo "</tr>";
                                        $suma = $suma + $deuda->V_TOTAL;
                                    }
                                    echo "<tr>"
                                    . "<td colspan='2' style='text-align: right; color: red; size:100px; face:impact'>"
                                    . "TOTAL"
                                    . "</td><td style='text-align: right; color: red; size:100px; face:impact'>"
                                    . $suma
                                    . " $</td>"
                                    . "</tr>";
                                    echo "</table>";
                                    ?>                                     
                                </td>                                
                            </tr>
                            <?php
                        } //Un socio medidor
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>        
</div>


<?php 
}
else {
    echo "<h2>El usuario con el número de cédula "
    .Yii::app()->getSession()->get('cedula_socio_deuda')
            .' no existe, comuniquese con el administrador</h2>';
        
}
?>
<?php 
$this->widget('bootstrap.widgets.TbButton', array(
           // 'buttonType' => 'submit',
                    'type' => 'warning',
                    'icon' => 'icon-arrow-left',
            'label' => Yii::t('AweCrud.app', 'Volver'),
            'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
        ));
?>

