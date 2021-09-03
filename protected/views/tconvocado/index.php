<?php
/* @var $this TconvocadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tconvocados',
);

$this->menu=array(
	array('label'=>'Create Tconvocado', 'url'=>array('create')),
	array('label'=>'Manage Tconvocado', 'url'=>array('admin')),
);
?>

<h1>Tconvocados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
