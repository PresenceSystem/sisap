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

<fieldset>
    <legend>
        <div class="badge badge-info"> 
            TRASPASO DE PROPIETARIO DEL MEDIDOR N°:<b> <?php echo $model_socioMedidor->iDMEDIDOR->NUMERO; ?> </b>
        </div>
    </legend>
    <div class="badge-success fondoLogin text-warning">
        <b> Propietario actual:</b> <?php echo $model_socioMedidor->cODIGOSOCIO->APELLIDO; ?> 
       <br><b> CI:</b> <?php echo $model_socioMedidor->cODIGOSOCIO->CI; ?> 
    </div>
   
     <div class="flash-error">
        <?php  echo Yii::app()->user->getFlash('Ya_tiene_medidor'); ?>
    </div>
     <div class="badge badge-info"> 
            NUEVO PROPIETARIO
        </div>
    <?php echo $this->renderPartial('_form_cambiar_propietario', array('model' => $model)); ?>
</fieldset>