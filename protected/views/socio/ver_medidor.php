<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs = array(
    'Socios' => array('index'),
    $model->CODIGO,
); 

$this->menu = array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Socio::label(2), 'icon' => 'list', 'url' => array('index')),
 //   array('label' => Yii::t('AweCrud.app', 'Agregar') . ' ' . Socio::label(), 'icon' => 'plus', 'url' => array('create')),
    //array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('medidor/update', 'id' => $nuevo_medidor->ID)),
 //   array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('medidor/delete', 'id' => $nuevo_medidor->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
  //  array('label' => Yii::t('AweCrud.app', 'Listado Socios'), 'icon' => 'list-alt', 'url' => array('admin')),
     array('label' => 'Lista de usuarios con derecho de agua', 'icon' => 'pencil', 'url' => array('socioMedidor/derecho_agua')),
);

?>
<h3 class="btn-info text-center">MEDIDOR ASIGNADO CORRECTAMENTE</h3>

        <div class="span text-center">
            <center> 
                <?php
                if ($model->FOTO == NULL or $model->FOTO == "") {
                    $model->FOTO = "PS.png";
                }
                ?>

                <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotosSocios/' . $model->FOTO, "...", array("width" => '100px')); ?>  

 
            </center>


            <div class="row">
                <div class="span4">
                    
                    <div>
                        <?php
                        $this->widget('bootstrap.widgets.TbDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                //   'CODIGO',
                                'CI',
                                'APELLIDO',
                                'GENERO',
                            //'ESTADO_CIVIL',
                            //'NOMBRE_CONYUGE',
                            //'FECHA_NACIMIENTO'
                            )
                        ));
                        ?>
                    </div>
                </div>
                <div class="span4">
                    
                    <div>
                        <?php
                        $this->widget('bootstrap.widgets.TbDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'DIRECCION',
                                'TELEFONO',
                                'CELULAR',
                                array(
                                    'name' => 'EMAIL',
                                    'type' => 'email'
                                )
                            )
                        ));
                        ?>
                    </div>
                </div>
                
            </div>
        </div>




<div class="jumbotron">
    <div class="container text-center">
        <h3>MEDIDOR DE AGUA</h3>        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Número de medidor</th>
                        <th>Grupo</th>
                        <th>Consumo Inicial</th>
                        <th>Orden de recorrido</th>
                        <th>Vigente desde</th>
                        <th>Consumo actual</th>
                        <th></th>
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
                            <!--<td>  <?php // echo $modelo_socio_medidor->iDMEDIDOR->NUMERO;  ?></td>-->  
                            <td> <?php
                                echo CHtml::encode($modelo_socio_medidor->iDMEDIDOR->NUMERO, array('medidor/update',
                                    'id' => $modelo_socio_medidor->iDMEDIDOR->ID));
                                ?> </td>
                                <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->iDGRUPO->DESCRIPCION; ?>  </td>

                            <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->CONSUMO_INICIAL; ?>  </td>
                            <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO; ?>  </td>
                            <td> <?php echo $modelo_socio_medidor->FECHA_ACTUALIZACION; ?>  </td>
                            <td>
                                <!-- CONSUMO ACTUAL -->
                             <?php    
                                  $model_factura_consumo = Factura::model()->findBySql('call consultar_consumo_actual('.$modelo_socio_medidor->ID.')');
                                   if (isset($model_factura_consumo)) {
                                    echo $model_factura_consumo->CONSUMO_ACTUAL;
                                   }
                                   else
                                   {
                                    echo "0";
                                   }
                                    ?>

                                <!-- FIN DE CONSUMO ACTUAL -->
                            </td>
    <!--                            <td> <?php
                            // echo CHtml::encode($modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO, array('asignar_cultivo/recorrido',
//                            'id' => $modelo_socio_medidor->ID));
                            ?> </td>-->
                            <td>
                                <a href="<?php echo Yii:: app()->baseUrl . '/index.php/medidor/update/'.$modelo_socio_medidor->iDMEDIDOR->ID; ?>" class=" text-center btn-warning btn-mini btn" >  
                                <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/editar.png' ?>" width="20px"></img>
                                <!--<h4>SIGUIENTE <?php ?></h4>-->
                                </a>
                                <a href="<?php echo Yii:: app()->baseUrl . '/index.php/medidor/'.$modelo_socio_medidor->iDMEDIDOR->ID ?>" class=" text-center btn-warning btn-mini btn" >  
                                <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/buscar.png' ?>" width="20px"></img>
                                <!--<h4>SIGUIENTE <?php ?></h4>-->
                                </a>
                            </td>
                        </tr>
                    <?php } //Un socio medidor
                    } 
                    ?>
                </tbody>
            </table>

        </div>  


<!--    <p><a class="btn btn-primary btn-lg" role="button">Leer más</a></p>-->
        <p>
            <?php
            if (!isset($modelo_socio_medidor->iDMEDIDOR))
                echo CHtml::link('NUEVO MEDIDOR', '', array('onclick' => '$("#mymodal").dialog("open");return false;', 'class' => 'badge'));
            ?>
        </p>
    </div>
</div>

<!--Aumentado para ingresar nuevo medidor -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => 'Ingresar nuevo medidor',
        'width' => 400,
        'height' => 400,
        'autoOpen' => false,
        'resizable' => 'true',
        'modal' => 'true',
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.3'
        ),
    ),
));

echo $this->renderPartial('/medidor/_form_flotante', array(
    'model' => $nuevo_medidor
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<!-- Fin de aumentado para ingreso flotante-->



<?php 

?>