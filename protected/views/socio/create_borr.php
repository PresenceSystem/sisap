<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Socio::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <h3 class="btn-primary text-center">INGRESAR DATOS DEL SOCIO NUEVO </h3>
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</fieldset>