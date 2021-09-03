<?php
/* @var $this TconvocadoController */
/* @var $model Tconvocado */

$this->breadcrumbs=array(
	'Tconvocados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tconvocado', 'url'=>array('index')),
	array('label'=>'Manage Tconvocado', 'url'=>array('admin')),
);
?>

<h1 class="btn-info text-center">Create Tconvocado</h1>

<?php  echo $this->renderPartial('_form', array('model'=>$model)); // Solo socios activos ?>
<?php // echo $this->renderPartial('_form_todos_socios', array('model'=>$model)); // Todos los socios activos ?>
<?php
// LISTA DE CONVOCADOS
$convocatoria=Yii::app()->getSession()->get('ConvocatoriaSeleccionada');
if($convocatoria>0 and $convocatoria==$model->COD_CONVOCATORIA)
{
    echo "<h2 class=badget-info>LISTA DE SOCIOS CONVOCADOS</h2>";
    
      $connection = Yii::app()->db;
                $sql = "SELECT * FROM tconvocado WHERE COD_CONVOCATORIA=".$convocatoria." order by COD_CONVOCADO DESC";
                $command = $connection->createCommand($sql);
                $rows = $command->execute();
                $rows = $command->queryAll();
$contador=1;
                foreach ($rows as $row) {
                    $socio=$row['COD_SOCIO'];
                    $modelo=  Socio::model()->findByPk($socio);
                    echo $contador++ .".- ". $modelo->APELLIDO.'<br>';
                    }
  
}

?>