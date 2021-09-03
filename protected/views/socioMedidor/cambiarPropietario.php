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
<h3 class="btn-info text-center col-md-12 span row">TRASPASO DE PROPIETARIO DEL MEDIDOR</h3>
<div class="badge badge-info fondoLogin text-info col-md-12 row">
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

<?php if (isset($model_aa->iDSOCIOMEDIDOR->cODIGOSOCIO->CI)){ ?>
<h5 class="btn-warning text-center col-md-12 span row">Se trasladará automáticamente el punto de alcantarillado</h5>
<div class="badge badge-warning fondoLogin text-info col-md-12 row">
    <div class="col-md-1">
        ESTADO : <?php echo $model_aa->ESTADO; ?> <br> 
    </div>    
       <div class="col-md-6">
           <?php echo $model_aa->DESCRIPCION; ?> 
       </div>
       <div class="col-md-3">
           Anexo al medidor N° : <?php echo $model_aa->iDSOCIOMEDIDOR->iDMEDIDOR->NUMERO; ?>
       </div>
    </div>
<?php }; // Fin existe acometida de alcantarillado ?>



<div class="span11 span row">
 <?php // if (Yii::app()->user->getFlash('Ya_tiene_medidor') != null) //Existe mensaje
  //{ ?>

     <div class="flash-error">
        <?php  echo Yii::app()->user->getFlash('Ya_tiene_medidor'); ?>
    </div>
    <?php 
//  }; // Fin de existe mensaje
    ?>
     <div class="badge badge-info"> 
            NUEVO PROPIETARIO
        </div>
    <?php echo $this->renderPartial('_form_cambiar_propietario', array('model' => $model)); ?>
</div>