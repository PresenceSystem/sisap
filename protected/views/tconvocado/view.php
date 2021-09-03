<?php
/* @var $this TconvocadoController */
/* @var $model Tconvocado */

$this->breadcrumbs=array(
	'Tconvocados'=>array('index'),
	$model->COD_CONVOCADO,
);

$this->menu=array(
	array('label'=>'List Tconvocado', 'url'=>array('index')),
	array('label'=>'Create Tconvocado', 'url'=>array('create')),
	array('label'=>'Update Tconvocado', 'url'=>array('update', 'id'=>$model->COD_CONVOCADO)),
	array('label'=>'Delete Tconvocado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_CONVOCADO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tconvocado', 'url'=>array('admin')),
);
?>

<h1>View Tconvocado #<?php echo $model->COD_CONVOCADO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_CONVOCADO',
		'COD_CONVOCATORIA',
		'COD_SOCIO',
	),
)); ?>
