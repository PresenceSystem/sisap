<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs = array(
    'Socios' => array('index'),
    $model->CODIGO,
);

$this->menu = array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Socio::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Agregar') . ' ' . Socio::label(), 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->CODIGO)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->CODIGO), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Listado Socios'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <h3 class="btn-info text-center">SOCIO N°: <?php echo $model->CODIGO; ?></h3>
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
                        <h3 class="panel-title"><center>INFORMACIÓN SOCIO</center></h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.TbDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                //   'CODIGO',
                                'CI',
                                'APELLIDO',
                                'GENERO',
                                array(
                                    'name' => 'COD_GRUPO',
                                    'value' => ($model->grupo !== null) ? CHtml::encode($model->grupo->GRUPO) . '' : null,
                                    'type' => 'html',
                                ),
                                'DIRECCION',
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
                                array(
                                    'name' => 'ESTADO',
                                    'value' => ($model->ESTADO == 1) ? '<h5 class="badge-success badge">Activo</h5>' : '<h5 class="badge-warning badge">Inactivo</h5>',
                                    'type' => 'html',
                                ),
                                'OBS',
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
            <h3 class="panel-title"><center>MEDIDOR DE AGUA</center></h3>
        </div>
        <div class="panel-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Socio medidor N°</th>
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
                                <!--<td>  <?php // echo $modelo_socio_medidor->iDMEDIDOR->NUMERO;       ?></td>-->  
                                <td>
                                    <?php
                                    if ($modelo_socio_medidor->INACTIVO == 0) {
                                        ?>
                                        <img src="<?php echo Yii:: app()->baseUrl . '/images/semaforo/3.png' ?>" width="75px"></img>                                
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo Yii:: app()->baseUrl . '/images/semaforo/2.png' ?>" width="75px"></img>                                
                                        <?php
                                    }
                                    ?>
                                </td>	
                                <td> <?php echo $modelo_socio_medidor->ID; ?>  </td>
                                <td> <?php
                                    if ($modelo_socio_medidor->INACTIVO == 0) {
                                        echo CHtml::link($modelo_socio_medidor->iDMEDIDOR->NUMERO, array('medidor/historial_propietarios',
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
                                    $model_factura_consumo = Factura::model()->findBySql('call consultar_consumo_actual(' . $modelo_socio_medidor->ID . ')');
                                    if (isset($model_factura_consumo)) {
                                        echo $model_factura_consumo->CONSUMO_ACTUAL;
                                    } else {
                                        echo "0";
                                    }
                                    ?>

                                    <!-- FIN DE CONSUMO ACTUAL -->
                                </td>
                                <td>
                                    <?php
                                    if ($modelo_socio_medidor->INACTIVO == 0) {
                                        ?>
                                        <a href="<?php echo Yii:: app()->baseUrl . '/index.php/medidor/view/' . $modelo_socio_medidor->iDMEDIDOR->ID ?>" class=" text-center btn-warning btn-mini btn" >  
                                            <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/buscar.png' ?>" width="30px"></img>                                
                                        </a>
                                        <a href="<?php echo Yii:: app()->baseUrl . '/index.php/medidor/update/' . $modelo_socio_medidor->iDMEDIDOR->ID ?>" class=" text-center btn-warning btn-mini btn" >  
                                            <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/editar.png' ?>" width="30px"></img>                                
                                        </a>
                                        <?php
                                    } else {
                                        
                                    }
                                    ?>
                                </td>
        <!--                            <td> <?php
                                // echo CHtml::encode($modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO, array('asignar_cultivo/recorrido',
//                            'id' => $modelo_socio_medidor->ID));
                                ?> </td>-->
                            </tr>
                            <?php
                        } //Un socio medidor
                    }
                    ?>
                <center>
                    <?php
                    if (!isset($modelo_socio_medidor->iDMEDIDOR))
                        echo CHtml::link('INGRESAR MEDIDOR', '', array('onclick' => '$("#mymodal").dialog("open");return false;', 'class' => 'badge'));
                    ?>
                </center>
                </tbody>
            </table>
        </div>
    </div>        
</div>

<!--Aumentado para ingresar nuevo medidor -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => 'Ingresar nuevo medidor',
        'width' => 600,
        'height' => 400,
        'autoOpen' => false,
        'resizable' => 'true',
        'modal' => 'true',
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.4'
        ),
    ),
));

echo $this->renderPartial('/medidor/_form_flotante', array(
    'model' => $nuevo_medidor
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<!-- Fin de aumentado para ingreso flotante-->



<!--***************************************************************************************-->
<!--LISTA DE ACOMETIDAS DE ALCANTARILLADO-->

<div class="col-md-12">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"><center>LISTA DE ACOMETIDAS DE ALCANTARILLADO</center></h3>
        </div>
        <div class="panel-body">

            <table class="table table-bordered">

                <tr class="alert-warning text-info">
                    <th>Estado</th>
                    <th>Socio acometida N°</th>
                    <th>Medidor (agua potable) asociado</th>
                    <th>Descripción</th>
                    <th>Grupo</th>
                    <th>Vigente desde</th>
                    <th></th>
                </tr>

                <tbody>

                    <?php
                    $contador = 0;
                    foreach ($modelo_acometida_alcantarillado as $mod) {
                        $modelo_socio_medidor = new SocioMedidor();
                        $modelo_socio_medidor = $mod;


                        if (isset($mod->iDSOCIOMEDIDOR->iDMEDIDOR->NUMERO)) {
                            ?>

                            <tr>
                                <?php $contador++; ?> 
                                <!--<td>  <?php // echo $mod->iDMEDIDOR->NUMERO;       ?></td>-->  
                                <td>
                                    <?php
                                    if ($mod->INACTIVO == 0) {
                                        ?>
                                        <img src="<?php echo Yii:: app()->baseUrl . '/images/semaforo/3.png' ?>" width="75px"></img>                                
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo Yii:: app()->baseUrl . '/images/semaforo/2.png' ?>" width="75px"></img>                                
                                        <?php
                                    }
                                    ?>
                                </td>	
                                <td> <?php echo $mod->iDSOCIOMEDIDOR->ID; ?>  </td>
                                <td> <?php
                                    if ($mod->INACTIVO == 0) {
                                        echo CHtml::link($mod->iDSOCIOMEDIDOR->iDMEDIDOR->NUMERO, array('medidor/actualizar',
                                            'id' => $mod->iDSOCIOMEDIDOR->iDMEDIDOR->ID));
                                    } else
                                        echo $mod->iDSOCIOMEDIDOR->iDMEDIDOR->NUMERO;
                                    ?> 
                                </td>	
                                <td>
                                    <?= '<h5 class="text-info text-center">' . $mod->ESTADO . '</h5>'; ?>
                                    <?= $mod->DESCRIPCION; ?>
                                </td>
                                <td> <?php echo $mod->iDSOCIOMEDIDOR->iDMEDIDOR->iDGRUPO->DESCRIPCION; ?>  
                                </td>
                                <td> <?php echo $mod->FECHA_INGRESO; ?>  </td>
                                <td>
                                    <?php
//                                    if ($mod->INACTIVO == 0) {
                                    ?>
                                    <?php /*   <a href="<?php echo Yii:: app()->baseUrl . '/index.php/medidor/view/' . $mod->iDSOCIOMEDIDOR->iDMEDIDOR->ID ?>" class=" text-center btn-warning btn-mini btn" >  
                                      <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/buscar.png' ?>" width="20px"></img>
                                      </a> */ ?>
                                    <a href="<?php echo Yii:: app()->baseUrl . '/index.php/acometidaAlcantarillado/update/' . $mod->ID ?>" class=" text-center btn-warning btn-mini btn" >  
                                        <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/editar.png' ?>" width="30px"></img>                                
                                    </a>
                                    <?php
//                                    } else {
//                                        
//                                    }
                                    ?>
                                </td>
        <!--                            <td> <?php
                                // echo CHtml::encode($modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO, array('asignar_cultivo/recorrido',
//                            'id' => $modelo_socio_medidor->ID));
                                ?> </td>-->
                            </tr>
                            <?php
                        } //Un socio medidor
                    }
                    ?>
<!--                <center>
                    <?php
//                    if (!isset($modelo_socio_medidor->iDMEDIDOR))
//                        echo CHtml::link('NUEVO MEDIDOR', '', array('onclick' => '$("#mymodal").dialog("open");return false;', 'class' => 'badge'));
                    ?>
</center>-->
                </tbody>
            </table>
        </div>
    </div>        
</div>