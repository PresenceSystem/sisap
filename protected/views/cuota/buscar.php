<?php
/** @var CuotaController $this */
/** @var Cuota $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List').' '.Cuota::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend> <h4 class="btn-primary text-center">BUSCAR USUARIO PARA REALIZAR EL PAGO PARCIAL</h4>
    </legend>
    <?php echo $this->renderPartial('_form_buscar', array('model' => $model)); ?>
    <?php //echo $this->renderPartial('_form', array('model' => $model)); ?>
</fieldset>