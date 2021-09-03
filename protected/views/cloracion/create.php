<?php
/** @var CloracionController $this */
/** @var Cloracion $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Cloracion::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>    
    <h3 class="btn-info text-center">INGRESAR DATOS DE FILTRACIÓN Y CLORACIÓN </h3>
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</fieldset>