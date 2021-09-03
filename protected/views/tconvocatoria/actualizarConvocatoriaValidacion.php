<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('app', $model->COD_CONVOCATORIA) => array('view', 'id'=>$model->COD_CONVOCATORIA),
	Yii::t('AweCrud.app', 'Update'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Tconvocatoria::label(), 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'url'=>array('verConvocatoriaValidacion', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->COD_CONVOCATORIA), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend>        
        <?php echo CHtml::encode($model) ?>        
    </legend>
    <?php echo $this->renderPartial('_formConvocatoriaValidacion',array('model' => $model)); ?>
</fieldset>