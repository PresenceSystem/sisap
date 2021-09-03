<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
//$this->breadcrumbs=array(
//	'Usuarios'=>array('index'),
//	$model->id,
//);
//
$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Usuario::label(2), 'icon' => 'list', 'url' => array('index')),
//  //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Usuario::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
// //   array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Usuario::label(); ?> <?php echo CHtml::encode($model) ?></legend>
    <?php
   
    if ($model->foto != null or $model->foto != '') {
        $foto = Yii:: app()->baseUrl . "/images/fotos/" . $model->foto;
    }
    else
    {
         $foto = Yii:: app()->baseUrl . "/images/iconos_del_sistema/usuario/usuario.png";
    }
    
    ?>
    <img src='<?php echo $foto; ?>' border=0 style="border:0;margin:0;padding:0" width="100px" /><br>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data' => $model,
        'attributes' => array(
        //    'id',
            'username',
      //      'password',
            'nombres',
            array(
                'name' => 'email',
                'type' => 'email'
            ),
            'telefono',
            'direccion',
           // 'foto',
           // 'id_referencia',
            array(
                'name' => 'Rol',
                'value' => ($model->rol !== null) ? CHtml::encode($model->rol, array('/rol/view', 'id_rol' => $model->rol->id_rol)) . ' ' : null,
                'type' => 'html',
            ),
          //  'codigo_barra',
          //  'descripcion',
        ),
    ));
    ?>
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