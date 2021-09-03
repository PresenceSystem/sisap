<?php
/** @var SocioMedidorController $this */
/** @var SocioMedidor $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.SocioMedidor::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>
<h3 class="btn-info text-center">TRASPASO DE PROPIETARIO DEL MEDIDOR</h3>
<div class="badge badge-info fondoLogin text-info col-md-12">
    <div class="col-md-3">
        CI : <?php echo $model_socioMedidor->cODIGOSOCIO->CI; ?> <br> 
    </div>    
       <div class="col-md-7">
           Propietario Actual : <?php echo $model_socioMedidor->cODIGOSOCIO->APELLIDO; ?> 
       </div>
       <div class="col-md-1">
           Medidor N° : <?php echo $model_socioMedidor->iDMEDIDOR->NUMERO; ?>
       </div>
    </div>
<fieldset>
    
     <div class="flash-error">
        <?php  echo Yii::app()->user->getFlash('Ya_tiene_medidor'); ?>
    </div>
     <div class="badge badge-info"> 
            NUEVO PROPIETARIO
        </div>
    <?php echo $this->renderPartial('_form_cambiar_propietario', array('model' => $model)); ?>
</fieldset>