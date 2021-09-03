<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Buscar'), 'icon' => 'list-alt', 'url' => array('buscarTicket')),
);
?>

<fieldset>
    <legend>CREAR TICKET</legend>
    <?php echo $this->renderPartial('_form_ticket', array('model' => $model)); ?>
</fieldset>