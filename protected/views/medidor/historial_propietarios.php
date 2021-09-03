<?php
/** @var MedidorController $this */
/** @var Medidor $model */
$this->breadcrumbs=array(
	'Medidors'=>array('index'),
	$model->ID,
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Medidor::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Medidor::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend class="badge badge-info">
       <H4> HISTORIAL DE PROPIETARIOS </H4>
    </legend>
<?php  if(Yii::app()->user->hasFlash('traspaso')) 
                      { ?>
     <div class="flash-error">
        <?php  
        
        echo Yii::app()->user->getFlash('traspaso'); 

        ?>
    </div>

    <?php 
  }; // Fin de existe mensaje
    ?>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
       // 'ID',
        'NUMERO',
        'CONSUMO_INICIAL',
        'ORDEN_RECORIDO',
	),
)); ?>
</fieldset>

<div class="container text-center">
        <h3>HISTORIAL MEDIDOR DE AGUA</h3>        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Propietario</th>  
                        <th>CI</th>  
                        <th>Modificado el</th>                       
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $contador = 0;
                    foreach ($socios_medidor as $modelo_socio_medidor)                    
                    {
                    ?>
                        <tr>
                             <?php  $contador++; ?> 
                            <!--<td>  <?php // echo $modelo_socio_medidor->iDMEDIDOR->NUMERO; ?></td>-->  
                          
                            <td> <?php echo $modelo_socio_medidor->cODIGOSOCIO->APELLIDO; ?>  </td>
                            <td> <?php echo $modelo_socio_medidor->cODIGOSOCIO->CI; ?>  </td>
                            <td> <?php echo $modelo_socio_medidor->FECHA_ACTUALIZACION; ?>  </td>
                            <td>...</td>
                            <td>
                                <?php if ($modelo_socio_medidor->INACTIVO==1) 
                                         echo "CAMBIADO";
                                    else
                                        echo 'ACTIVO';
                                    ?>
                            </td>
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>

        </div>  
  
    </div>