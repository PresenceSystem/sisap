<?php
/* @var $this TconvocadoController */
/* @var $model Tconvocado */

$this->breadcrumbs=array(
	'Tconvocados'=>array('index'),
	$model->COD_CONVOCADO=>array('view','id'=>$model->COD_CONVOCADO),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tconvocado', 'url'=>array('index')),
	array('label'=>'Create Tconvocado', 'url'=>array('create')),
	array('label'=>'View Tconvocado', 'url'=>array('view', 'id'=>$model->COD_CONVOCADO)),
	array('label'=>'Manage Tconvocado', 'url'=>array('admin')),
);
?>

<h1>Update Tconvocado <?php echo $model->COD_CONVOCADO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>