<?php
/** @var MovimientoCajaController $this */
/** @var MovimientoCaja $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.MovimientoCaja::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><center>MOVIMIENTO DE CAJA</center></h3>
                    </div>
                    <div class="panel-body">                    
    					<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    				</div>
				</div>
	</div>
</fieldset>