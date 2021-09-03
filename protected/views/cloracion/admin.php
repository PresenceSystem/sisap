<?php
/** @var CloracionController $this */
/** @var Cloracion $model */
$this->breadcrumbs=array(
	'Cloracions'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Cloracion::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Cloracion::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cloracion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend  class="btn-info text-center">
    ADMINISTRAR DATOS DE CLORACIÓN    
    </legend>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'cloracion-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'CODIGO',
        'LLAVET1',
        'LLAVET2',
        'TANQUE1',
        'TANQUE2',
        'TANQUE3',
        /*
        'VALVULA_CL',
        'F_CL',
        'PH',
        'LLAVE_DISTRIBUCION',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>