<?php
/** @var CajaController $this */
/** @var Caja $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('app', $model->ID) => array('view', 'id'=>$model->ID),
	Yii::t('AweCrud.app', 'Update'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Caja::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Caja::label(), 'icon' => 'plus', 'url' => array('create')),
	//array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'url'=>array('view', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
	array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><h3 class="btn-info text-center">CIERRE DE CAJA </h3></legend>
    <p>
        A continuación puede utilizar la herramienta para 
	    <?php 
	    echo CHtml::link('Recuento', '', array('onclick' => '$("#mymodal").dialog("open");return false;', 'class' => 'btn-primary '));
	    ?>  
         caso contrario ingrese el valor en efectivo.
        </p>
    <?php echo $this->renderPartial('_form_cerrar',array('model' => $model)); ?>
</fieldset>


<!--Aumentado para recuento -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => 'Recuento',
        'width' => 800,
        'height' => 600,
        'autoOpen' => false,
        'resizable' => 'true',
        'modal' => 'true',
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.4'
        ),
    ),
));

echo $this->renderPartial('/recuento/_form_flotante', array(
    'model' => $nuevo_recuento
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<!-- Fin de aumentado para recuento-->