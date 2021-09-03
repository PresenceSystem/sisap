<?php
/** @var CajaController $this */
/** @var Caja $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Caja::label(2), 'icon' => 'list', 'url' => array('index')),
   // array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><h3 class="btn-info text-center">APERTURA DE CAJA </h3></legend>
    <?php echo $this->renderPartial('_form_abrir', array('model' => $model)); ?>
</fieldset>