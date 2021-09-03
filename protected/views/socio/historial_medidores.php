<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs = array(
    'Socios' => array('index'),
    $model->CODIGO,
);

//$this->menu = array(
//    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Socio::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Socio::label(), 'icon' => 'plus', 'url' => array('create')),
//    array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->CODIGO)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->CODIGO), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend class="badge badge-info">SOCIO N°: <?php echo $model->CODIGO; ?> </legend>
    <div class="row">
        <div class="  col-md-9">
            <center> 
                <?php
//                if ($model->FOTO == NULL or $model->FOTO == "") {
//                    $model->FOTO = "PS.png";
//                }
                ?>

                <?php // echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotosSocios/' . $model->FOTO, "...", array("width" => '100px')); ?>  


            </center>


            <div class="row">
                <div class="col-md-6">
                    <div class="heading badge-success">

                    </div>
                    <div>
                        <?php
                        $this->widget('bootstrap.widgets.TbDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                //   'CODIGO',
                                'CI',
                                'APELLIDO',
//                                'GENERO',
//                                'ESTADO_CIVIL',
//                                'NOMBRE_CONYUGE',
//                                'FECHA_NACIMIENTO'
                            )
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="heading badge-success">

                    </div>
                    <div>
                        <?php
//                        $this->widget('bootstrap.widgets.TbDetailView', array(
//                            'data' => $model,
//                            'attributes' => array(
//                                'DIRECCION',
//                                'TELEFONO',
//                                'CELULAR',
//                                array(
//                                    'name' => 'EMAIL',
//                                    'type' => 'email'
//                                )
//                            )
//                        ));
                        ?>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="heading badge-info text-center">
                        <!--VIGENCIA DEL USUARIO DE AGUA-->
                    </div>
                    <div>
                        <?php
//                        $this->widget('bootstrap.widgets.TbDetailView', array(
//                            'data' => $model,
//                            'attributes' => array(
//                                'FECHA_INGRESO',
//                                'FECHA_SALIDA',
//                            )
//                        ));
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <?php
//        $this->widget('bootstrap.widgets.TbDetailView', array(
//            'data' => $model,
//            'attributes' => array(
//                array(
//                    'name' => 'COD_USUARIO',
//                    'value' => ($model->usuario !== null) ? CHtml::encode($model->usuario->nombres) . '' : null,
//                    'type' => 'html',
//                ),
//                'FECHA_ACTUALIZACION',
//            ),
//        ));
        ?>
    </div>
</fieldset>
<div class="jumbotron">
    <div class="container text-center">
        <h3>HISTORIAL MEDIDOR DE AGUA</h3>        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Número de medidor</th>
                        <th>Consumo Inicial</th>
                        <th>Orden de recorrido</th>
                        <th>Vigente desde</th>
                        <th>Consumo actual</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $contador = 0;
                    foreach ($modelos_socio_medidor as $modelo_socio_medidor)                    
                    {
                    ?>
                        <tr>
                             <?php  $contador++; ?> 
                            <!--<td>  <?php // echo $modelo_socio_medidor->iDMEDIDOR->NUMERO; ?></td>-->  
                            <td> <?php  echo CHtml::link($modelo_socio_medidor->iDMEDIDOR->NUMERO, array('medidor/update',
                            'id' => $modelo_socio_medidor->iDMEDIDOR->ID));
                            ?> </td>
                            <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->CONSUMO_INICIAL; ?>  </td>
                            <td> <?php echo $modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO; ?>  </td>
                            <td> <?php echo $modelo_socio_medidor->FECHA_ACTUALIZACION; ?>  </td>
                            <td>...</td>
                            <td>
                                <?php if ($modelo_socio_medidor->INACTIVO==1) 
                                         echo "CAMBIADO";
                                    else
                                        echo 'ACTIVO';
                                    ?>
                            </td>
<!--                            <td> <?php // echo CHtml::encode($modelo_socio_medidor->iDMEDIDOR->ORDEN_RECORIDO, array('asignar_cultivo/recorrido',
//                            'id' => $modelo_socio_medidor->ID));
                            ?> </td>-->
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>

        </div>  
        

<!--    <p><a class="btn btn-primary btn-lg" role="button">Leer más</a></p>-->
        <p>
<?php 
//if (!isset($modelo_socio_medidor->iDMEDIDOR))
//echo CHtml::link('NUEVO MEDIDOR', '', array('onclick' => '$("#mymodal").dialog("open");return false;','class'=>'badge')); 
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