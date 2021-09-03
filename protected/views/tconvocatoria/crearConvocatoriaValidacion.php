<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List').' '.Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'Create') . ' ' . Tconvocatoria::label(); ?></legend>
    <?php echo $this->renderPartial('_formConvocatoriaValidacion', array('model' => $model)); ?>
</fieldset>