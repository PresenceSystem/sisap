<?php
/** @var AcometidaAlcantarilladoController $this */
/** @var AcometidaAlcantarillado $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.AcometidaAlcantarillado::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend class="btn-warning text-center">INGRESAR ACOMETIDA DE ALCANTARILLADO</legend>
    <?php echo $this->renderPartial('_form_ingresar_solo_alcantarillado', array('model' => $model, 'sql' => $sql, 'id' => $id)); ?>
</fieldset>