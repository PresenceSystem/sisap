<?php
/** @var MedidorController $this */
/** @var Medidor $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Medidor::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
   <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                   		<h3 class="panel-title"><center>UBICACIÓN DE LA ACOMETIDA DE ALCANTARILLADO</center></h3>                    
                   		<b>PROPIETARIO: </b><?php echo $model_socio->APELLIDO; ?>
                                
                      <?php  if(Yii::app()->user->hasFlash('Buscar')) 
                      { ?>
                        <div class="flash-notice">
                            <?php  echo Yii::app()->user->getFlash('Buscar'); ?>
                        </div>
                        <?php }; ?>
                    </div>
                    <div class="panel-body">  
    					<?php 
                                        echo $this->renderPartial('_form_solo_alcantarillado', array('model' => $model)); ?>
    				</div>
    		 	</div>
    </div>
</fieldset>