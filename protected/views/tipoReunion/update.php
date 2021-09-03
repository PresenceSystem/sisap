<?php
/** @var TipoReunionController $this */
/** @var TipoReunion $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('app', $model->CODIGO_TIPO) => array('view', 'id'=>$model->CODIGO_TIPO),
	Yii::t('AweCrud.app', 'Update'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . TipoReunion::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . TipoReunion::label(), 'icon' => 'plus', 'url' => array('create')),
	//array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'url'=>array('view', 'id' => $model->CODIGO_TIPO)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->CODIGO_TIPO), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
	array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'Update') . ' ' . TipoReunion::label(); ?> <?php echo CHtml::encode($model) ?></legend>
    <?php echo $this->renderPartial('_form',array('model' => $model)); ?>
</fieldset>