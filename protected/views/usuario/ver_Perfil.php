<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Usuario::label(2), 'icon' => 'list', 'url' => array('index')),
  //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Usuario::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update')." Perfil", 'icon' => 'pencil', 'url' => array('modificar_Perfil', 'id' => $model->id)),
  //  array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
 //   array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php //echo Yii::t('AweCrud.app', 'View') . ' ' . Usuario::label(); ?> <?php //echo CHtml::encode($model) ?></legend>

    <?php 
    if ($model->foto == NULL or $model->foto == "")
    {
     $model->foto="usuario.png";   
    }    
    echo '<center>'.CHtml::image(Yii::app()->request->baseUrl . '/images/fotosUsuarios/' . $model->foto, "...", array("width" => 100)).'</center>'; ?>  
   

<?php 
echo "<br><b><div class='text-warning text-center'></b> ".$model->rol->Rol."</div><br>";
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        //'id',
        'username',
      //  'password',
        'nombres',
        array(
                'name'=>'email',
                'type'=>'email'
            ),
        'telefono',
        'direccion',
//        'foto',
       // 'id_referencia',
//        array(
//			'name'=>'Rol',
//			'value'=>($model->rol !== null) ? CHtml::link($model->rol, array('/rol/view', 'id_rol' => $model->rol->id_rol)).' ' : null,
//			'type'=>'html',
//		),
        'codigo_barra',
        'descripcion',
	),
)); ?>
</fieldset>

<?php
//      $this->widget(
//    'bootstrap.widgets.TbButton',
//    array(
//    'label' => 'Prestar libro',
//    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
//        'url' => array('prestamo/createLibroEstudiante', 'id' => $model->id),
//        'icon'=>'book',
//    )
//    );


?>